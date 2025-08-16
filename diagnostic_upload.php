<?php

// Script de diagnostic pour les uploads d'images de catégories

echo "=== DIAGNOSTIC UPLOAD IMAGES CATEGORIES ===\n\n";

// 1. Vérification des dossiers
echo "1. VERIFICATION DES DOSSIERS:\n";
$storagePath = storage_path('app/public/categories');
$publicStoragePath = public_path('storage/categories');

echo "- storage/app/public/categories existe: " . (is_dir($storagePath) ? 'OUI' : 'NON') . "\n";
echo "- public/storage/categories accessible: " . (is_dir($publicStoragePath) ? 'OUI' : 'NON') . "\n";
echo "- Permissions storage: " . substr(sprintf('%o', fileperms($storagePath)), -4) . "\n";
echo "- Permissions public/storage: " . (is_dir($publicStoragePath) ? substr(sprintf('%o', fileperms($publicStoragePath)), -4) : 'N/A') . "\n\n";

// 2. Test d'écriture
echo "2. TEST D'ECRITURE:\n";
$testFile = $storagePath . '/test_write.txt';
$writeResult = file_put_contents($testFile, 'Test écriture ' . date('Y-m-d H:i:s'));
echo "- Ecriture dans storage: " . ($writeResult ? 'OK' : 'ECHEC') . "\n";

if ($writeResult && file_exists($testFile)) {
    unlink($testFile);
    echo "- Suppression test: OK\n";
}

// 3. Configuration PHP
echo "\n3. CONFIGURATION PHP:\n";
echo "- upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "- post_max_size: " . ini_get('post_max_size') . "\n";
echo "- max_file_uploads: " . ini_get('max_file_uploads') . "\n";
echo "- memory_limit: " . ini_get('memory_limit') . "\n";
echo "- file_uploads enabled: " . (ini_get('file_uploads') ? 'OUI' : 'NON') . "\n";

// 4. Extensions PHP
echo "\n4. EXTENSIONS PHP:\n";
echo "- GD extension: " . (extension_loaded('gd') ? 'OK' : 'MANQUANTE') . "\n";
echo "- Fileinfo extension: " . (extension_loaded('fileinfo') ? 'OK' : 'MANQUANTE') . "\n";

// 5. Laravel Storage
echo "\n5. LARAVEL STORAGE:\n";
try {
    $disk = \Storage::disk('public');
    echo "- Disk public accessible: OUI\n";
    
    // Test d'écriture avec Storage
    $testContent = 'Test Laravel Storage ' . time();
    $disk->put('categories/test_laravel.txt', $testContent);
    $readContent = $disk->get('categories/test_laravel.txt');
    echo "- Test écriture Storage: " . ($readContent === $testContent ? 'OK' : 'ECHEC') . "\n";
    
    $disk->delete('categories/test_laravel.txt');
    echo "- Test suppression Storage: OK\n";
    
} catch (Exception $e) {
    echo "- Erreur Storage: " . $e->getMessage() . "\n";
}

echo "\n=== FIN DU DIAGNOSTIC ===\n";
