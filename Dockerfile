FROM php:8.2-apache

# Install system dependencies & PHP extensions required by Laravel 11 + MySQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure Apache DocumentRoot to Laravel's /public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && printf '<Directory /var/www/html/public>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>\nServerName localhost\n' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files first for layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy application source
COPY . .

# Run Laravel package discovery and prepare writable directories
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache \
    && php artisan package:discover --ansi || true \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod +x /var/www/html/docker/entrypoint.sh

# Safe defaults (can be overridden anytime in Railway Variables)
ENV APP_NAME=HomeService \
    APP_ENV=production \
    APP_DEBUG=false \
    APP_KEY=base64:UdR3Z5NkETpK+h4R8KG9uDnPL9k191QudI913o5LhYg= \
    LOG_CHANNEL=stderr \
    SESSION_DRIVER=file \
    CACHE_DRIVER=file \
    FILESYSTEM_DISK=local

EXPOSE 8080

CMD ["/var/www/html/docker/entrypoint.sh"]
