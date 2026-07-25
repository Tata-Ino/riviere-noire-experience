#!/bin/bash
set -e

echo "=== Riviere Noire Experience - Demarrage ==="

php artisan key:generate --force
php artisan storage:link --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Execution des migrations..."
php artisan migrate --force

echo "Execution des seeders..."
php artisan db:seed --force

echo "Demarrage du serveur..."
exec php artisan serve --host=0.0.0.0 --port=8000
