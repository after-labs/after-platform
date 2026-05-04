FROM php:8.4-cli

# System deps + PHP extensions (added mbstring, xml)
RUN apt-get update && apt-get install -y \
  git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev nodejs npm \
  && docker-php-ext-install pdo pdo_mysql zip mbstring xml

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy entire Laravel project (excluding .dockerignore files)
COPY . .

# Install PHP deps (vendor will be created inside container)
RUN composer install --no-dev --optimize-autoloader

# Install Node deps & build assets (node_modules inside container)
RUN npm install && npm run build

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 8080

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]