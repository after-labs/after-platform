FROM php:8.4-cli

# System deps
RUN apt-get update && apt-get install -y \
  git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev nodejs npm \
  && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project
COPY ./src .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Install frontend
RUN npm install && npm run build

# Laravel setup
RUN php artisan config:cache && php artisan route:cache

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080