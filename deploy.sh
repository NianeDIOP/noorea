#!/bin/bash

# Script de déploiement pour noorea.sn
# Nouvelle approche sans liens symboliques pour résoudre les erreurs 403

set -e  # Arrêter le script en cas d'erreur

echo "🚀 DÉPLOIEMENT NOOREA.SN - NOUVELLE APPROCHE IMAGES"
echo "=================================================="

# Variables
APP_DIR="/home/noorea/noorea.sn"
BACKUP_DIR="/home/noorea/backups/$(date +%Y%m%d_%H%M%S)"

echo "📁 Répertoire de l'application: $APP_DIR"
echo "💾 Sauvegarde: $BACKUP_DIR"
echo ""

# 1. Créer le répertoire de sauvegarde
echo "1️⃣  Création du répertoire de sauvegarde..."
mkdir -p "$BACKUP_DIR"

# 2. Sauvegarder les fichiers critiques
echo "2️⃣  Sauvegarde des fichiers critiques..."
if [ -f "$APP_DIR/.env" ]; then
    cp "$APP_DIR/.env" "$BACKUP_DIR/.env.backup"
    echo "   ✅ .env sauvegardé"
fi

if [ -d "$APP_DIR/storage" ]; then
    cp -r "$APP_DIR/storage" "$BACKUP_DIR/storage_backup"
    echo "   ✅ Dossier storage sauvegardé"
fi

if [ -d "$APP_DIR/public/images" ]; then
    cp -r "$APP_DIR/public/images" "$BACKUP_DIR/public_images_backup"
    echo "   ✅ Images publiques sauvegardées"
fi

# 3. Mettre à jour le code via Git
echo ""
echo "3️⃣  Mise à jour du code..."
cd "$APP_DIR"
git fetch origin
git reset --hard origin/main
echo "   ✅ Code mis à jour depuis Git"

# 4. Copier le fichier de configuration de production
echo ""
echo "4️⃣  Configuration de l'environnement de production..."
if [ -f ".env.noorea.sn" ]; then
    cp ".env.noorea.sn" ".env"
    echo "   ✅ Configuration de production appliquée"
else
    echo "   ⚠️  Fichier .env.noorea.sn introuvable"
fi

# 5. Mettre à jour les dépendances
echo ""
echo "5️⃣  Mise à jour des dépendances..."
composer install --no-dev --optimize-autoloader
echo "   ✅ Dépendances Composer installées"

# 6. Migration des images vers public/images
echo ""
echo "6️⃣  Migration des images vers public/images..."
php migrate_images.php
echo "   ✅ Images migrées vers public/images"

# 7. Mise à jour des chemins dans la base de données
echo ""
echo "7️⃣  Mise à jour de la base de données..."
php update_image_paths.php
echo "   ✅ Chemins d'images mis à jour en base"

# 8. Optimisations Laravel
echo ""
echo "8️⃣  Optimisations Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "   ✅ Cache Laravel optimisé"

# 9. Permissions
echo ""
echo "9️⃣  Configuration des permissions..."
chmod -R 755 "$APP_DIR/public"
chmod -R 755 "$APP_DIR/storage"
find "$APP_DIR/public/images" -type f -exec chmod 644 {} \;
echo "   ✅ Permissions configurées"

# 10. Vérification finale
echo ""
echo "🔍 VÉRIFICATION FINALE..."
if [ -d "$APP_DIR/public/images/categories" ]; then
    cat_count=$(find "$APP_DIR/public/images/categories" -type f | wc -l)
    echo "   📂 Categories: $cat_count images"
fi

if [ -d "$APP_DIR/public/images/products" ]; then
    prod_count=$(find "$APP_DIR/public/images/products" -type f | wc -l)
    echo "   📂 Products: $prod_count images"
fi

if [ -d "$APP_DIR/public/images/brands" ]; then
    brand_count=$(find "$APP_DIR/public/images/brands" -type f | wc -l)
    echo "   � Brands: $brand_count images"
fi

echo ""
echo "✅ DÉPLOIEMENT TERMINÉ AVEC SUCCÈS !"
echo ""
echo "🎯 TESTS À EFFECTUER :"
echo "- Vérifier que les images s'affichent : https://noorea.sn/images/categories/"
echo "- Tester l'upload de nouvelles images depuis l'admin"
echo "- Vérifier qu'il n'y a plus d'erreurs 403"
echo ""
echo "💡 Les images sont maintenant servies directement depuis public/images/"
echo "   Plus de problèmes de liens symboliques !"
