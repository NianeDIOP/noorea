# Script de remplacement des images externes par images locales
Write-Host "=== REMPLACEMENT DES IMAGES EXTERNES ===" -ForegroundColor Green

# Créer les fichiers de placeholder en attendant vos vraies images
\ = @(
    'public/images/hero/home-bg-1.jpg',
    'public/images/hero/home-bg-2.jpg', 
    'public/images/hero/home-bg-3.jpg',
    'public/images/products/cream-1.jpg',
    'public/images/products/serum-1.jpg',
    'public/images/products/oil-1.jpg',
    'public/images/products/perfume-1.jpg',
    'public/images/categories/skincare.jpg',
    'public/images/categories/makeup.jpg',
    'public/images/categories/perfumes.jpg',
    'public/images/categories/haircare.jpg',
    'public/images/backgrounds/section-bg-1.jpg',
    'public/images/backgrounds/section-bg-2.jpg'
)

foreach(\ in \) {
    if (-not (Test-Path \)) {
        New-Item -Path \ -ItemType File -Force | Out-Null
        Write-Host "✅ Créé: \" -ForegroundColor Yellow
    }
}

Write-Host "
📋 GUIDE DE REMPLACEMENT:" -ForegroundColor Cyan
Write-Host "1. Téléchargez vos images de qualité depuis:" -ForegroundColor White
Write-Host "   - Unsplash.com (licence libre)" -ForegroundColor Gray
Write-Host "   - Pexels.com (licence libre)" -ForegroundColor Gray  
Write-Host "   - Vos propres photos de produits" -ForegroundColor Gray
Write-Host "2. Renommez-les selon le guide README.md" -ForegroundColor White
Write-Host "3. Placez-les dans les dossiers appropriés" -ForegroundColor White
