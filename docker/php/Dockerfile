FROM php:8.4-fpm

# System deps
RUN apt-get update && apt-get install -y \
  git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
  && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www