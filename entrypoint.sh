#!/bin/bash
echo "=== Demarrage ==="

php artisan key:generate --force 2>&1 || true
php artisan storage:link --force 2>&1 || true
php artisan route:cache 2>&1 || true
php artisan view:cache 2>&1 || true

echo "Migration..."
php artisan migrate --force 2>&1 || true

echo "Serveur demarre sur port ${PORT:-8000}"
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
