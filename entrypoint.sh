#!/bin/bash
set -e

echo "=== Riviere Noire Experience - Demarrage ==="

php artisan key:generate --force
php artisan storage:link --force

php artisan route:cache
php artisan view:cache

echo "Attente de MySQL..."
for i in $(seq 1 30); do
  php artisan db:show > /dev/null 2>&1 && break
  echo "MySQL pas encore prête... ($i/30)"
  sleep 2
done

echo "Execution des migrations..."
php artisan migrate --force

echo "Execution des seeders..."
php artisan db:seed --force

echo "Demarrage du serveur..."
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
