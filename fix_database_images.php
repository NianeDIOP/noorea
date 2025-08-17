<?php
/**
 * Script SIMPLE pour corriger les chemins d'images dans la base
 */

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

echo "🔧 CORRECTION DES CHEMINS D'IMAGES EN BASE\n";
echo "==========================================\n";

// 1. Corriger les catégories
echo "📁 Correction catégories...\n";
$categories = DB::table('categories')->whereNotNull('image')->get();
foreach ($categories as $cat) {
    $oldPath = $cat->image;
    
    // Si ça commence par /images/ ou images/, on enlève le / au début
    if (str_starts_with($oldPath, '/images/')) {
        $newPath = substr($oldPath, 1); // Enlever le / au début
    } elseif (str_starts_with($oldPath, 'images/')) {
        $newPath = $oldPath; // Déjà bon
    } elseif (str_starts_with($oldPath, 'categories/')) {
        $newPath = 'images/' . $oldPath;
    } else {
        // Probablement juste le nom du fichier
        $newPath = 'images/categories/' . basename($oldPath);
    }
    
    if ($newPath !== $oldPath) {
        DB::table('categories')->where('id', $cat->id)->update(['image' => $newPath]);
        echo "   ✅ ID {$cat->id}: {$oldPath} → {$newPath}\n";
    }
}

// 2. Corriger les produits
echo "📁 Correction produits...\n";
$products = DB::table('products')->whereNotNull('images')->get();
foreach ($products as $prod) {
    $images = json_decode($prod->images, true);
    if (!is_array($images)) continue;
    
    $newImages = [];
    $changed = false;
    
    foreach ($images as $img) {
        if (str_starts_with($img, '/images/')) {
            $newImages[] = substr($img, 1);
            $changed = true;
        } elseif (str_starts_with($img, 'images/')) {
            $newImages[] = $img;
        } elseif (str_starts_with($img, 'products/')) {
            $newImages[] = 'images/' . $img;
            $changed = true;
        } else {
            $newImages[] = 'images/products/' . basename($img);
            $changed = true;
        }
    }
    
    if ($changed) {
        DB::table('products')->where('id', $prod->id)->update(['images' => json_encode($newImages)]);
        echo "   ✅ ID {$prod->id}: images corrigées\n";
    }
}

// 3. Corriger les marques
echo "📁 Correction marques...\n";
$brands = DB::table('brands')->whereNotNull('logo')->get();
foreach ($brands as $brand) {
    $oldPath = $brand->logo;
    
    if (str_starts_with($oldPath, '/images/')) {
        $newPath = substr($oldPath, 1);
    } elseif (str_starts_with($oldPath, 'images/')) {
        $newPath = $oldPath;
    } elseif (str_starts_with($oldPath, 'brands/')) {
        $newPath = 'images/' . $oldPath;
    } else {
        $newPath = 'images/brands/' . basename($oldPath);
    }
    
    if ($newPath !== $oldPath) {
        DB::table('brands')->where('id', $brand->id)->update(['logo' => $newPath]);
        echo "   ✅ ID {$brand->id}: {$oldPath} → {$newPath}\n";
    }
}

echo "\n✅ TERMINÉ ! Les images devraient maintenant s'afficher.\n";
?>
