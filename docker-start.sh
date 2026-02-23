#!/usr/bin/env bash
set -e

# Run migrations
php artisan migrate --force

# Execute the CMD
exec "$@"
