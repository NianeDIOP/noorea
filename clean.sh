#!/bin/bash

# ==============================================
# 🧹 SCRIPT DE NETTOYAGE PROFESSIONNEL NOOREA
# ==============================================
# Supprime les fichiers inutiles et cache Laravel
# Utilisation: ./clean.sh

echo "🧹 Nettoyage du projet Noorea..."

# Supprimer les fichiers de test et debug
echo "📁 Suppression des fichiers de test/debug..."
rm -f debug_*.html
rm -f diagnostic*.php
rm -f diagnostic*.html  
rm -f test_*.html
rm -f test_*.php
rm -f migrate_*.php
rm -f sync_*.php
rm -f update_*.php
rm -f fix_*.php
rm -f public/diagnostic.html
rm -f public/test*.html

# Nettoyer le cache Laravel
echo "🗑️  Nettoyage cache Laravel..."
php artisan cache:clear --quiet
php artisan config:clear --quiet
php artisan route:clear --quiet
php artisan view:clear --quiet

# Supprimer les vues compilées
echo "🗃️  Suppression vues compilées..."
rm -f storage/framework/views/*.php

# Nettoyer les logs volumineux
echo "📜 Nettoyage logs..."
find storage/logs -name "*.log" -size +10M -delete 2>/dev/null

# Nettoyer node_modules cache (optionnel)
if [ -d "node_modules" ]; then
    echo "📦 Nettoyage cache npm..."
    npm cache clean --force --silent 2>/dev/null
fi

echo "✅ Nettoyage terminé ! Projet optimisé."
echo "📊 Espace libéré: $(du -sh . 2>/dev/null | cut -f1)"
