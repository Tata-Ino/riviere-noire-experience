#!/bin/bash
set -e

echo "=== Rivière Noire Experience - Démarrage ==="

# Générer la clé APP si elle n'existe pas
php artisan key:generate --force

# Créer le lien de stockage
php artisan storage:link --force

# Vider le cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Exécuter les migrations
echo "Exécution des migrations..."
php artisan migrate --force

# Exécuter les seeders
echo "Exécution des seeders..."
php artisan db:seed --force

# Lancer le serveur
echo "Démarrage du serveur sur le port 8000..."
exec php artisan serve --host=0.0.0.0 --port=8000
