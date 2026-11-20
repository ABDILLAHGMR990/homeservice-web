#!/bin/bash

cd /var/www/html

echo "=== HomeService Container Starting ==="

# Ensure .env file exists so Laravel dotenv & artisan never complain
if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
fi

# Support Railway's built-in MYSQL* variables automatically if DB_* aren't set
if [ -z "$DB_HOST" ] && [ -n "$MYSQLHOST" ]; then
    export DB_CONNECTION=mysql
    export DB_HOST="$MYSQLHOST"
    export DB_PORT="${MYSQLPORT:-3306}"
    export DB_DATABASE="${MYSQLDATABASE:-railway}"
    export DB_USERNAME="${MYSQLUSER:-root}"
    export DB_PASSWORD="$MYSQLPASSWORD"
fi

# Prevent crash if SESSION_DRIVER was set to database (no sessions table in migrations)
if [ "$SESSION_DRIVER" = "database" ]; then
    export SESSION_DRIVER=file
fi

# Ensure writable storage & cache directories exist
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache

# Clear any stale cached files before running artisan commands
rm -f bootstrap/cache/config.php bootstrap/cache/routes-*.php bootstrap/cache/services.php bootstrap/cache/packages.php || true
php artisan package:discover --ansi || true

# Create public storage symlink if missing
php artisan storage:link --force || true

# Run pending database migrations safely
echo "Running database migrations..."
php artisan migrate --force || true

# Seed initial demo data ONLY if users table is completely empty
USER_COUNT=$(php -r "
require 'vendor/autoload.php';
\$app = require_once 'bootstrap/app.php';
\$kernel = \$app->make(Illuminate\Contracts\Console\Kernel::class);
\$kernel->bootstrap();
try {
    echo \App\Models\User::count();
} catch (\Throwable \$e) {
    echo 'err';
}
" 2>/dev/null || echo "err")

if [ "$USER_COUNT" = "0" ]; then
    echo "Database is empty — seeding initial HomeService data..."
    php artisan db:seed --force || true
fi

# Set Apache permissions after artisan CLI commands
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Listen on 80, 8080, AND Cloud assigned $PORT so Railway target port always matches
PORT="${PORT:-8080}"
echo "Configuring Apache to listen on ports 80, 8080, and $PORT..."
{
    echo "Listen 80"
    if [ "$PORT" != "80" ]; then
        echo "Listen 8080"
        if [ "$PORT" != "8080" ]; then
            echo "Listen $PORT"
        fi
    fi
} > /etc/apache2/ports.conf

sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:*/" /etc/apache2/sites-available/000-default.conf

# Ensure ONLY mpm_prefork is loaded for mod_php (fixes AH00534: More than one MPM loaded)
a2dismod mpm_event mpm_worker >/dev/null 2>&1 || true
rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.* || true
a2enmod mpm_prefork >/dev/null 2>&1 || true

echo "Starting Apache web server for HomeService..."
exec apache2-foreground
