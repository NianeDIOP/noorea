# ==============================================
# 🧹 SCRIPT DE NETTOYAGE PROFESSIONNEL NOOREA
# ==============================================
# Supprime les fichiers inutiles et cache Laravel
# Utilisation: .\clean.ps1

Write-Host "🧹 Nettoyage du projet Noorea..." -ForegroundColor Green

# Supprimer les fichiers de test et debug
Write-Host "📁 Suppression des fichiers de test/debug..." -ForegroundColor Yellow
Get-ChildItem -Path . -Filter "debug_*.html" | Remove-Item -Force -ErrorAction SilentlyContinue
Get-ChildItem -Path . -Filter "diagnostic*.php" | Remove-Item -Force -ErrorAction SilentlyContinue
Get-ChildItem -Path . -Filter "diagnostic*.html" | Remove-Item -Force -ErrorAction SilentlyContinue
Get-ChildItem -Path . -Filter "test_*.html" | Remove-Item -Force -ErrorAction SilentlyContinue
Get-ChildItem -Path . -Filter "test_*.php" | Remove-Item -Force -ErrorAction SilentlyContinue
Get-ChildItem -Path . -Filter "migrate_*.php" | Remove-Item -Force -ErrorAction SilentlyContinue
Get-ChildItem -Path . -Filter "sync_*.php" | Remove-Item -Force -ErrorAction SilentlyContinue
Get-ChildItem -Path . -Filter "update_*.php" | Remove-Item -Force -ErrorAction SilentlyContinue
Get-ChildItem -Path . -Filter "fix_*.php" | Remove-Item -Force -ErrorAction SilentlyContinue
Remove-Item -Path "public\diagnostic.html" -Force -ErrorAction SilentlyContinue
Get-ChildItem -Path "public" -Filter "test*.html" | Remove-Item -Force -ErrorAction SilentlyContinue

# Nettoyer le cache Laravel
Write-Host "🗑️  Nettoyage cache Laravel..." -ForegroundColor Yellow
php artisan cache:clear | Out-Null
php artisan config:clear | Out-Null
php artisan route:clear | Out-Null
php artisan view:clear | Out-Null

# Supprimer les vues compilées
Write-Host "🗃️  Suppression vues compilées..." -ForegroundColor Yellow
Get-ChildItem -Path "storage\framework\views" -Filter "*.php" | Remove-Item -Force -ErrorAction SilentlyContinue

# Nettoyer les logs volumineux (> 10MB)
Write-Host "📜 Nettoyage logs volumineux..." -ForegroundColor Yellow
Get-ChildItem -Path "storage\logs" -Filter "*.log" | Where-Object { $_.Length -gt 10MB } | Remove-Item -Force -ErrorAction SilentlyContinue

# Nettoyer node_modules cache (optionnel)
if (Test-Path "node_modules") {
    Write-Host "📦 Nettoyage cache npm..." -ForegroundColor Yellow
    npm cache clean --force 2>$null | Out-Null
}

Write-Host "✅ Nettoyage terminé ! Projet optimisé." -ForegroundColor Green
Write-Host "📊 Le projet est maintenant propre et optimisé." -ForegroundColor Cyan
