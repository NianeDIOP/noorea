# Script de nettoyage automatique pour le projet Noorea
# Utilisation: ./clean-project.ps1

Write-Host "🧹 Nettoyage du projet Noorea..." -ForegroundColor Green

# Nettoyer les caches Laravel
Write-Host "📦 Nettoyage des caches Laravel..." -ForegroundColor Yellow
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Supprimer les fichiers compilés et cache
Write-Host "🗑️ Suppression des fichiers temporaires..." -ForegroundColor Yellow

# Supprimer les logs
if (Test-Path "storage\logs\*.log") {
    Remove-Item "storage\logs\*.log" -Force -ErrorAction SilentlyContinue
    Write-Host "✅ Logs supprimés" -ForegroundColor Green
}

# Supprimer les vues compilées
if (Test-Path "storage\framework\views\*.php") {
    Remove-Item "storage\framework\views\*.php" -Force -ErrorAction SilentlyContinue
    Write-Host "✅ Vues compilées supprimées" -ForegroundColor Green
}

# Supprimer les sessions (sauf .gitignore)
Get-ChildItem "storage\framework\sessions\" -Exclude ".gitignore" | Remove-Item -Force -ErrorAction SilentlyContinue
Write-Host "✅ Sessions supprimées" -ForegroundColor Green

# Supprimer les caches Bootstrap
if (Test-Path "bootstrap\cache\*.php") {
    Remove-Item "bootstrap\cache\*.php" -Force -ErrorAction SilentlyContinue
    Write-Host "✅ Cache Bootstrap supprimé" -ForegroundColor Green
}

# Optimiser l'autoloader
Write-Host "⚡ Optimisation de l'autoloader..." -ForegroundColor Yellow
composer dump-autoload --optimize --no-dev --quiet

# Recompiler les assets si nécessaire
if (Test-Path "package.json") {
    Write-Host "🎨 Recompilation des assets..." -ForegroundColor Yellow
    npm run build --silent
}

Write-Host "🎉 Nettoyage terminé avec succès!" -ForegroundColor Green
Write-Host "📊 Espace disque libéré et performances optimisées." -ForegroundColor Cyan
