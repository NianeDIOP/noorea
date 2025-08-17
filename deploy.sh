#!/bin/bash

# Script de déploiement pour noorea.sn
# À exécuter sur le serveur après chaque pull GitHub

echo "🚀 Déploiement noorea.sn - Configuration des images"

# 1. Créer les dossiers de stockage s'ils n'existent pas
echo "📁 Création des dossiers de stockage..."
mkdir -p storage/app/public/{categories,products,brands,avatars}
mkdir -p public/storage

# 2. Créer le lien symbolique
echo "🔗 Création du lien symbolique..."
if [ -L "public/storage" ]; then
    echo "   Suppression de l'ancien lien..."
    rm public/storage
fi
php artisan storage:link

# 3. Permissions correctes
echo "🔐 Configuration des permissions..."
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/
sudo chown -R www-data:www-data public/storage
sudo chmod -R 775 storage/
sudo chmod -R 775 bootstrap/cache/
sudo chmod -R 775 public/storage

# 4. Cache Laravel
echo "🧹 Nettoyage du cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 5. Optimisation pour la production
echo "⚡ Optimisation production..."
php artisan config:cache
php artisan route:cache

# 6. Vérification
echo "✅ Vérification de la configuration..."
if [ -L "public/storage" ] && [ -d "storage/app/public" ]; then
    echo "   ✓ Lien symbolique OK"
else
    echo "   ❌ Problème avec le lien symbolique"
    exit 1
fi

if [ -w "storage/app/public" ]; then
    echo "   ✓ Permissions d'écriture OK"
else
    echo "   ❌ Problème de permissions"
    exit 1
fi

echo "🎉 Déploiement terminé avec succès!"
echo ""
echo "📋 Points à vérifier manuellement:"
echo "   - Fichier .env avec FILESYSTEM_DISK=public"
echo "   - APP_URL=https://noorea.sn"
echo "   - Tester l'upload d'images dans l'admin"
echo ""
