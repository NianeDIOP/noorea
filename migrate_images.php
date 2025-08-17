<?php
/**
 * Script de migration des images vers public/images
 * Cette solution contourne complètement les problèmes de liens symboliques
 */

class ImageMigrator
{
    private $migrations = [];
    private $basePath;
    
    public function __construct()
    {
        $this->basePath = __DIR__;
    }
    
    public function migrate()
    {
        echo "=== MIGRATION DES IMAGES VERS PUBLIC/IMAGES ===\n";
        echo "Cette migration résout les problèmes 403 Forbidden\n";
        echo "================================================\n\n";
        
        // Migrer chaque type d'images
        $this->migrateModelImages('categories');
        $this->migrateModelImages('products');
        $this->migrateModelImages('brands');
        
        // Migrer les images du dossier /images/categories/ existant
        $this->migrateExistingPublicImages();
        
        // Afficher le résumé
        $this->showMigrationSummary();
        
        echo "\n🎯 PROCHAINES ÉTAPES:\n";
        echo "1. Déployez ce code sur noorea.sn\n";
        echo "2. Exécutez ce script sur le serveur: php migrate_images.php\n";
        echo "3. Mettez à jour la base de données si nécessaire\n";
    }
    
    private function migrateModelImages($modelType)
    {
        echo "📁 Migration des images {$modelType}...\n";
        
        $sourceDir = $this->basePath . "/storage/app/public/{$modelType}";
        $destDir = $this->basePath . "/public/images/{$modelType}";
        
        $count = $this->copyDirectory($sourceDir, $destDir);
        
        if ($count > 0) {
            echo "   ✅ {$count} images migrées depuis storage/app/public/{$modelType}\n";
            $this->migrations[$modelType]['storage'] = $count;
        } else {
            echo "   ℹ️  Aucune image trouvée dans storage/app/public/{$modelType}\n";
        }
    }
    
    private function migrateExistingPublicImages()
    {
        echo "📁 Migration des images publiques existantes...\n";
        
        // Vérifier s'il y a des images dans public/images/categories (ancien système)
        $oldCategoriesDir = $this->basePath . '/public/images/categories';
        
        if (is_dir($oldCategoriesDir)) {
            $count = count(array_filter(glob($oldCategoriesDir . '/*'), 'is_file'));
            if ($count > 0) {
                echo "   ✅ {$count} images de catégories déjà présentes\n";
            }
        }
    }
    
    private function copyDirectory($sourceDir, $destDir)
    {
        if (!is_dir($sourceDir)) {
            return 0;
        }
        
        if (!is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }
        
        $count = 0;
        $files = scandir($sourceDir);
        
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $sourcePath = $sourceDir . '/' . $file;
                $destPath = $destDir . '/' . $file;
                
                if (is_file($sourcePath)) {
                    if (!file_exists($destPath) || filemtime($sourcePath) > filemtime($destPath)) {
                        copy($sourcePath, $destPath);
                        chmod($destPath, 0644);
                        $count++;
                        echo "     → {$file}\n";
                    }
                } elseif (is_dir($sourcePath)) {
                    $count += $this->copyDirectory($sourcePath, $destPath);
                }
            }
        }
        
        return $count;
    }
    
    private function showMigrationSummary()
    {
        echo "\n📊 RÉSUMÉ DE LA MIGRATION:\n";
        echo "========================\n";
        
        $directories = ['categories', 'products', 'brands'];
        $totalFiles = 0;
        
        foreach ($directories as $dir) {
            $publicPath = $this->basePath . "/public/images/{$dir}";
            if (is_dir($publicPath)) {
                $files = glob($publicPath . '/*');
                $count = count(array_filter($files, 'is_file'));
                $totalFiles += $count;
                
                echo "📂 {$dir}: {$count} images disponibles\n";
                echo "   URL: https://noorea.sn/images/{$dir}/\n";
            } else {
                echo "📂 {$dir}: dossier non créé\n";
            }
        }
        
        echo "\n🎉 Total: {$totalFiles} images prêtes pour noorea.sn\n";
        echo "💡 Les images seront maintenant accessibles directement via:\n";
        echo "   https://noorea.sn/images/categories/[nom-fichier]\n";
        echo "   https://noorea.sn/images/products/[nom-fichier]\n";
        echo "   https://noorea.sn/images/brands/[nom-fichier]\n";
    }
}

// Exécuter la migration
$migrator = new ImageMigrator();
$migrator->migrate();
