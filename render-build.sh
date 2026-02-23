#!/usr/bin/env bash
# exit on error
set -o errexit

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Set a dummy APP_KEY for build if not present
export APP_KEY=${APP_KEY:-base64:$(openssl rand -base64 32)}

# Install Node dependencies and build assets
npm install
npm run build

# Run migrations (force for production) 
# The DB will be available during deploy on Render
php artisan migrate --force
