<?php
/**
 * Script de mise à jour des chemins d'images dans la base de données
 * Convertit les chemins storage vers les nouveaux chemins public/images
 */

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseImagePathUpdater
{
    public function updateAllPaths()
    {
        echo "=== MISE À JOUR DES CHEMINS D'IMAGES DANS LA BASE ===\n";
        echo "Conversion storage/* vers images/*\n";
        echo "====================================================\n\n";
        
        $this->updateCategoriesImages();
        $this->updateProductsImages();
        $this->updateBrandsImages();
        
        echo "\n✅ Mise à jour terminée !\n";
        echo "Les images utilisent maintenant les chemins public/images/*\n";
    }
    
    private function updateCategoriesImages()
    {
        echo "📁 Mise à jour des images de catégories...\n";
        
        $categories = DB::table('categories')
                       ->whereNotNull('image')
                       ->where('image', '!=', '')
                       ->where('image', 'not like', 'images/%')
                       ->where('image', 'not like', 'http%')
                       ->get();
                       
        $updated = 0;
        foreach ($categories as $category) {
            $oldPath = $category->image;
            $newPath = $this->convertStoragePathToPublicPath($oldPath, 'categories');
            
            if ($newPath !== $oldPath) {
                DB::table('categories')
                  ->where('id', $category->id)
                  ->update(['image' => $newPath]);
                
                echo "   → ID {$category->id}: {$oldPath} → {$newPath}\n";
                $updated++;
            }
        }
        
        echo "   ✅ {$updated} catégories mises à jour\n\n";
    }
    
    private function updateProductsImages()
    {
        echo "📁 Mise à jour des images de produits...\n";
        
        $products = DB::table('products')
                     ->whereNotNull('images')
                     ->where('images', '!=', '')
                     ->where('images', 'not like', '["images/%')
                     ->where('images', 'not like', '["http%')
                     ->get();
                     
        $updated = 0;
        foreach ($products as $product) {
            $oldImages = json_decode($product->images, true);
            if (!is_array($oldImages)) continue;
            
            $newImages = [];
            $hasChanges = false;
            
            foreach ($oldImages as $imagePath) {
                $newPath = $this->convertStoragePathToPublicPath($imagePath, 'products');
                $newImages[] = $newPath;
                
                if ($newPath !== $imagePath) {
                    $hasChanges = true;
                }
            }
            
            if ($hasChanges) {
                DB::table('products')
                  ->where('id', $product->id)
                  ->update(['images' => json_encode($newImages)]);
                
                echo "   → ID {$product->id}: " . count($newImages) . " images mises à jour\n";
                $updated++;
            }
        }
        
        echo "   ✅ {$updated} produits mis à jour\n\n";
    }
    
    private function updateBrandsImages()
    {
        echo "📁 Mise à jour des logos de marques...\n";
        
        $brands = DB::table('brands')
                   ->whereNotNull('logo')
                   ->where('logo', '!=', '')
                   ->where('logo', 'not like', 'images/%')
                   ->where('logo', 'not like', 'http%')
                   ->get();
                   
        $updated = 0;
        foreach ($brands as $brand) {
            $oldPath = $brand->logo;
            $newPath = $this->convertStoragePathToPublicPath($oldPath, 'brands');
            
            if ($newPath !== $oldPath) {
                DB::table('brands')
                  ->where('id', $brand->id)
                  ->update(['logo' => $newPath]);
                
                echo "   → ID {$brand->id}: {$oldPath} → {$newPath}\n";
                $updated++;
            }
        }
        
        echo "   ✅ {$updated} marques mises à jour\n\n";
    }
    
    private function convertStoragePathToPublicPath($path, $type)
    {
        // Si c'est déjà une URL externe ou un chemin images/, ne pas changer
        if (filter_var($path, FILTER_VALIDATE_URL) || str_starts_with($path, 'images/')) {
            return $path;
        }
        
        // Convertir les chemins storage vers images
        if (str_starts_with($path, 'categories/')) {
            return 'images/' . $path;
        }
        
        if (str_starts_with($path, 'products/')) {
            return 'images/' . $path;
        }
        
        if (str_starts_with($path, 'brands/')) {
            return 'images/' . $path;
        }
        
        // Si le chemin contient déjà le type, l'utiliser
        if (str_contains($path, $type)) {
            $filename = basename($path);
            return "images/{$type}/{$filename}";
        }
        
        // Par défaut, assumer que c'est juste le nom de fichier
        $filename = basename($path);
        return "images/{$type}/{$filename}";
    }
}

// Exécuter la mise à jour
$updater = new DatabaseImagePathUpdater();
$updater->updateAllPaths();
