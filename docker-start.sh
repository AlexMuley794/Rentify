#!/usr/bin/env bash
set -e

# Map Render URL to Laravel APP_URL if not set
if [ -n "$RENDER_EXTERNAL_URL" ] && [ -z "$APP_URL" ]; then
    export APP_URL=$RENDER_EXTERNAL_URL
fi

# Run migrations
php artisan migrate --force

# Execute the CMD
exec "$@"
