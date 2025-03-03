FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    mariadb-client \
    libmariadb-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage

EXPOSE 9000
