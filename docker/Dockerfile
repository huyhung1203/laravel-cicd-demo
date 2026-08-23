FROM php:8.4-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install \
    pdo_pgsql \
    bcmath \
    zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Chỉ copy 2 file dependency để tận dụng layer cache
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# Copy toàn bộ source sau khi đã cài xong dependency
COPY . .

# Chạy các script sau khi đã có đầy đủ artisan + source
RUN composer run-script post-autoload-dump --ansi

RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

CMD ["php-fpm"]
