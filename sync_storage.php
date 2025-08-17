<?php
/**
 * Script de synchronisation des images existantes
 * À exécuter une seule fois pour copier toutes les images existantes
 */

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class StorageSync
{
    private function recursiveCopy($source, $destination)
    {
        if (!is_dir($source)) {
            return false;
        }

        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $files = scandir($source);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $srcFile = $source . DIRECTORY_SEPARATOR . $file;
                $destFile = $destination . DIRECTORY_SEPARATOR . $file;

                if (is_dir($srcFile)) {
                    $this->recursiveCopy($srcFile, $destFile);
                } else {
                    copy($srcFile, $destFile);
                    echo "Copié: $srcFile -> $destFile\n";
                }
            }
        }
        return true;
    }

    public function syncAllStorageToPublic()
    {
        $storagePath = storage_path('app/public');
        $publicPath = public_path('storage');

        echo "Synchronisation de $storagePath vers $publicPath\n";
        echo "=====================================\n";

        // Créer le dossier public/storage s'il n'existe pas
        if (!is_dir($publicPath)) {
            mkdir($publicPath, 0755, true);
            echo "Dossier $publicPath créé\n";
        }

        // Copier récursivement tous les fichiers
        if ($this->recursiveCopy($storagePath, $publicPath)) {
            echo "\n✅ Synchronisation terminée avec succès!\n";
            
            // Afficher un résumé
            $this->showSummary($publicPath);
        } else {
            echo "\n❌ Erreur lors de la synchronisation\n";
        }
    }

    private function showSummary($publicPath)
    {
        echo "\nRésumé des dossiers synchronisés:\n";
        echo "==================================\n";
        
        $directories = ['categories', 'products', 'brands', 'images'];
        
        foreach ($directories as $dir) {
            $fullPath = $publicPath . DIRECTORY_SEPARATOR . $dir;
            if (is_dir($fullPath)) {
                $count = count(glob($fullPath . '/*'));
                echo "📁 $dir: $count fichiers\n";
            } else {
                echo "📁 $dir: dossier inexistant\n";
            }
        }
    }
}

// Exécuter la synchronisation
$sync = new StorageSync();
$sync->syncAllStorageToPublic();

echo "\n🚀 Script terminé. Vous pouvez maintenant déployer sur le serveur.\n";
