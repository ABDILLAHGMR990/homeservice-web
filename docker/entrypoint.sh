#!/bin/bash
set -e

# Ensure storage directories exist
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Create public storage symlink if missing
php artisan storage:link --force || true

# Run pending database migrations safely
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

# Clear stale caches & start server on Cloud assigned $PORT
php artisan config:clear || true
php artisan view:clear || true
php artisan route:clear || true

PORT="${PORT:-8080}"
echo "Starting HomeService on 0.0.0.0:$PORT..."
exec php artisan serve --host=0.0.0.0 --port="$PORT"
