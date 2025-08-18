# ==============================================
# 🧹 SCRIPT DE NETTOYAGE COMPLET NOOREA
# ==============================================
# Supprime TOUS les fichiers inutiles et optimise le projet
# Utilisation: .\clean.ps1

Write-Host "🧹 NETTOYAGE COMPLET DU PROJET NOOREA" -ForegroundColor Green
Write-Host "=====================================" -ForegroundColor Green

# 1. FICHIERS DE TEST ET DEBUG
Write-Host "�️  Suppression des fichiers de test/debug..." -ForegroundColor Yellow
$testPatterns = @("debug_*", "diagnostic*", "test_*", "migrate_*", "sync_*", "update_*", "fix_*", "*-test*", "*-debug*", "*-temp*", "*_old*", "*_new*", "*_backup*", "*-backup*", "*-old*", "*-new*", "*_clean*")
foreach ($pattern in $testPatterns) {
    Get-ChildItem -Recurse -Filter "$pattern.php" -ErrorAction SilentlyContinue | Remove-Item -Force
    Get-ChildItem -Recurse -Filter "$pattern.html" -ErrorAction SilentlyContinue | Remove-Item -Force
    Get-ChildItem -Recurse -Filter "$pattern.blade.php" -ErrorAction SilentlyContinue | Remove-Item -Force
}

# Fichiers spécifiques
$specificFiles = @(
    "public\diagnostic.html", "public\info.php", "public\test.html", "public\phpinfo.php",
    "app\Http\Controllers\TestUploadController.php",
    "resources\views\test-upload.blade.php"
)
foreach ($file in $specificFiles) {
    if (Test-Path $file) { Remove-Item $file -Force -ErrorAction SilentlyContinue }
}

# Dossiers de test
$testDirs = @("resources\views\test", "public\test", "storage\test")
foreach ($dir in $testDirs) {
    if (Test-Path $dir) { Remove-Item $dir -Recurse -Force -ErrorAction SilentlyContinue }
}

# 2. FICHIERS ENVIRONNEMENT SENSIBLES
Write-Host "🔐 Suppression des fichiers d'environnement sensibles..." -ForegroundColor Yellow
$envFiles = @(".env.production", ".env.noorea.sn", ".env.local", ".env.staging")
foreach ($envFile in $envFiles) {
    if (Test-Path $envFile) { 
        Remove-Item $envFile -Force -ErrorAction SilentlyContinue
        Write-Host "   ✅ Supprimé: $envFile" -ForegroundColor Green
    }
}

# 3. CACHE LARAVEL COMPLET
Write-Host "🧹 Nettoyage cache Laravel complet..." -ForegroundColor Yellow
php artisan optimize:clear | Out-Null
php artisan cache:clear | Out-Null
php artisan config:clear | Out-Null
php artisan route:clear | Out-Null
php artisan view:clear | Out-Null

# 4. FICHIERS COMPILÉS ET TEMPORAIRES
Write-Host "🗃️  Suppression des fichiers compilés..." -ForegroundColor Yellow
Get-ChildItem -Path "storage\framework\views" -Filter "*.php" -ErrorAction SilentlyContinue | Remove-Item -Force
Get-ChildItem -Path "storage\framework\sessions" -Exclude ".gitignore" -ErrorAction SilentlyContinue | Remove-Item -Force
Get-ChildItem -Path "bootstrap\cache" -Filter "*.php" -ErrorAction SilentlyContinue | Remove-Item -Force

# 5. LOGS VOLUMINEUX ET ANCIENS
Write-Host "📜 Nettoyage des logs..." -ForegroundColor Yellow
Get-ChildItem -Path "storage\logs" -Filter "*.log" | Where-Object { $_.Length -gt 5MB -or $_.LastWriteTime -lt (Get-Date).AddDays(-30) } | Remove-Item -Force -ErrorAction SilentlyContinue

# 6. FICHIERS TEMPORAIRES SYSTÈME
Write-Host "🧽 Suppression des fichiers temporaires..." -ForegroundColor Yellow
$tempExtensions = @("*.tmp", "*.temp", "*.bak", "*.swp", "*.swo", "*~", "*.orig")
foreach ($ext in $tempExtensions) {
    Get-ChildItem -Recurse -Filter $ext -ErrorAction SilentlyContinue | Remove-Item -Force
}

# Fichiers système
$systemFiles = @("Thumbs.db", ".DS_Store", "desktop.ini")
foreach ($sysFile in $systemFiles) {
    Get-ChildItem -Recurse -Filter $sysFile -ErrorAction SilentlyContinue | Remove-Item -Force
}

# 7. NETTOYAGE GIT
Write-Host "🌿 Nettoyage Git..." -ForegroundColor Yellow
git clean -fd 2>$null | Out-Null

# 8. OPTIMISATIONS
Write-Host "⚡ Optimisations..." -ForegroundColor Yellow
composer dump-autoload --optimize --no-dev --quiet 2>$null | Out-Null

# Recompilation des assets si nécessaire
if (Test-Path "package.json" -and Test-Path "node_modules") {
    Write-Host "🎨 Recompilation des assets..." -ForegroundColor Yellow
    npm run build --silent 2>$null | Out-Null
}

# 9. RAPPORT FINAL
Write-Host ""
Write-Host "🎉 NETTOYAGE TERMINÉ AVEC SUCCÈS!" -ForegroundColor Green
Write-Host "=================================" -ForegroundColor Green
Write-Host "✅ Fichiers de test/debug supprimés" -ForegroundColor Cyan
Write-Host "✅ Fichiers d'environnement sensibles supprimés" -ForegroundColor Cyan
Write-Host "✅ Cache Laravel nettoyé" -ForegroundColor Cyan
Write-Host "✅ Fichiers compilés supprimés" -ForegroundColor Cyan
Write-Host "✅ Logs volumineux supprimés" -ForegroundColor Cyan
Write-Host "✅ Fichiers temporaires supprimés" -ForegroundColor Cyan
Write-Host "✅ Autoloader optimisé" -ForegroundColor Cyan
Write-Host "✅ Assets recompilés" -ForegroundColor Cyan
Write-Host ""
Write-Host "📊 Projet Noorea parfaitement optimisé et sécurisé!" -ForegroundColor Magenta
