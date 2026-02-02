#!/bin/bash
set -e

echo "Deploying application..."

# Enter the project directory
cd /var/www/petmart2

# Turn on maintenance mode
php artisan down || true

# Pull the latest changes from the git repository
# git reset --hard origin/main
git pull origin main

# Install/update composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run database migrations
php artisan migrate --force

# Clear caches
php artisan optimize
php artisan view:clear
php artisan route:clear
php artisan config:clear

# Recreate cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Install node dependencies and build assets (optional, if you commit build assets you can skip this)
# npm install
# npm run build

# Turn off maintenance mode
php artisan up

echo "Deployment finished!"
