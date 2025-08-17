<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

echo "=== DIAGNOSTIC SYSTÈME D'IMAGES ===\n\n";

// 1. Vérifier les dossiers
echo "1. VÉRIFICATION DES DOSSIERS:\n";
$dirs = [
    'public/images/categories',
    'public/images/products', 
    'public/images/brands',
    'storage/app/public/categories',
    'storage/app/public/products',
    'storage/app/public/brands'
];

foreach ($dirs as $dir) {
    $path = __DIR__ . '/' . $dir;
    $exists = is_dir($path);
    $count = $exists ? count(array_filter(scandir($path), function($f) use ($path) { 
        return is_file($path . '/' . $f); 
    })) : 0;
    
    echo "  $dir: " . ($exists ? "✅ ($count fichiers)" : "❌ inexistant") . "\n";
}

// 2. Vérifier la base de données
echo "\n2. VÉRIFICATION BASE DE DONNÉES:\n";
try {
    $categories = \Illuminate\Support\Facades\DB::table('categories')->whereNotNull('image')->get();
    echo "  Categories avec images: " . $categories->count() . "\n";
    
    foreach ($categories->take(3) as $cat) {
        $imagePath = $cat->image;
        $fileExists = false;
        
        // Vérifier si le fichier existe
        if (str_starts_with($imagePath, 'images/')) {
            $fileExists = file_exists(public_path($imagePath));
        } elseif (str_starts_with($imagePath, 'categories/')) {
            $fileExists = file_exists(public_path('images/' . $imagePath)) || 
                         file_exists(public_path('storage/' . $imagePath));
        }
        
        echo "    - $cat->name: $imagePath " . ($fileExists ? "✅" : "❌") . "\n";
    }
    
    $products = \Illuminate\Support\Facades\DB::table('products')->whereNotNull('images')->get();
    echo "  Products avec images: " . $products->count() . "\n";
    
    $brands = \Illuminate\Support\Facades\DB::table('brands')->whereNotNull('logo')->get();
    echo "  Brands avec logos: " . $brands->count() . "\n";
    
} catch (Exception $e) {
    echo "  ❌ Erreur DB: " . $e->getMessage() . "\n";
}

// 3. Test trait
echo "\n3. TEST DU TRAIT SimpleImageUpload:\n";
try {
    $trait = new class {
        use App\Traits\SimpleImageUpload;
        
        public function getModelType() {
            return 'categories';
        }
    };
    echo "  ✅ Trait chargé avec succès\n";
    echo "  Type de modèle: " . $trait->getModelType() . "\n";
} catch (Exception $e) {
    echo "  ❌ Erreur trait: " . $e->getMessage() . "\n";
}

echo "\n=== FIN DIAGNOSTIC ===\n";
