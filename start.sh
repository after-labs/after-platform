#!/bin/sh

set -e

echo "Installing PHP dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "Installing Node dependencies..."
npm install

echo "Building assets..."
npm run build

echo "Generating app key..."
php artisan key:generate --force

echo "Running migrations..."
php artisan migrate --force

echo "Starting server..."
php artisan serve --host=0.0.0.0 --port=${PORT}