<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait SimpleImageUpload
{
    /**
     * Gère l'upload d'image directement dans public/images
     * Cette approche évite complètement les problèmes de liens symboliques
     */
    public function handleSimpleImageUpload(Request $request, $fieldName = 'image')
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            
            if ($file->isValid()) {
                // Déterminer le type de modèle (categories, products, brands)
                $modelType = $this->getModelType();
                
                // Créer le chemin de destination
                $uploadPath = public_path("images/{$modelType}");
                
                // Créer le dossier s'il n'existe pas
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                // Générer un nom de fichier unique
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(40) . '.' . $extension;
                
                // Déplacer le fichier directement dans public/images
                $file->move($uploadPath, $filename);
                
                // Retourner le chemin relatif pour la base de données
                $relativePath = "images/{$modelType}/{$filename}";
                
                Log::info("Image uploadée avec succès dans public/images: {$relativePath}");
                
                return $relativePath;
            }
        }
        
        return null;
    }

    /**
     * Gère l'upload ou URL selon le type choisi - version simplifiée
     */
    public function handleImageOrUrl($request, $imageField, $urlField, $typeField, $oldImage = null)
    {
        $imageType = $request->input($typeField);
        
        if ($imageType === 'upload') {
            // Mode upload de fichier
            if ($request->hasFile($imageField)) {
                // Supprimer l'ancienne image locale si elle existe
                if ($oldImage && !filter_var($oldImage, FILTER_VALIDATE_URL)) {
                    $this->deleteSimpleImage($oldImage);
                }
                
                return $this->handleSimpleImageUpload($request, $imageField);
            }
            // Si pas de nouveau fichier, on garde l'ancienne image
            return $oldImage;
            
        } elseif ($imageType === 'url' && $request->filled($urlField)) {
            // Mode URL externe
            
            // Supprimer l'ancienne image locale si on passe à une URL
            if ($oldImage && !filter_var($oldImage, FILTER_VALIDATE_URL)) {
                $this->deleteSimpleImage($oldImage);
            }
            
            $url = $request->input($urlField);
            Log::info("URL d'image définie: {$url}");
            
            return $url;
        }

        // Si aucun type valide, on garde l'ancienne image
        return $oldImage;
    }

    /**
     * Supprime une image du dossier public/images
     */
    public function deleteSimpleImage($imagePath)
    {
        if ($imagePath && !filter_var($imagePath, FILTER_VALIDATE_URL)) {
            $fullPath = public_path($imagePath);
            
            if (file_exists($fullPath)) {
                unlink($fullPath);
                Log::info("Image supprimée de public/images: {$imagePath}");
                return true;
            }
        }
        
        return false;
    }

    /**
     * Retourne l'URL complète d'une image
     */
    public function getImageUrl($imagePath)
    {
        if (!$imagePath) {
            return null;
        }
        
        // Si c'est déjà une URL complète, la retourner telle quelle
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }
        
        // Sinon, construire l'URL avec asset()
        return asset($imagePath);
    }

    /**
     * Retourne les règles de validation pour les images - version simplifiée
     */
    public function getSimpleImageValidationRules($request, $imageField, $urlField, $typeField, $isRequired = false, $currentImage = null)
    {
        $rules = [
            $imageField => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            $urlField => 'nullable|url|max:500',
            $typeField => 'required|in:upload,url'
        ];

        $imageType = $request->input($typeField);
        
        if ($imageType === 'upload') {
            if ($isRequired && !$request->hasFile($imageField) && !$currentImage) {
                $rules[$imageField] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            }
        } elseif ($imageType === 'url') {
            if ($isRequired || $request->filled($urlField)) {
                $rules[$urlField] = 'required|url|max:500';
            }
        }

        return $rules;
    }

    /**
     * Migre les images existantes du système storage vers public/images
     */
    public function migrateStorageImages()
    {
        $modelType = $this->getModelType();
        $storageBase = storage_path("app/public/{$modelType}");
        $publicBase = public_path("images/{$modelType}");
        
        if (is_dir($storageBase)) {
            if (!is_dir($publicBase)) {
                mkdir($publicBase, 0755, true);
            }
            
            $files = scandir($storageBase);
            $migratedCount = 0;
            
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && !is_dir($storageBase . '/' . $file)) {
                    $sourcePath = $storageBase . '/' . $file;
                    $destPath = $publicBase . '/' . $file;
                    
                    if (!file_exists($destPath)) {
                        copy($sourcePath, $destPath);
                        $migratedCount++;
                        Log::info("Image migrée: {$file} vers images/{$modelType}/");
                    }
                }
            }
            
            Log::info("Migration terminée pour {$modelType}: {$migratedCount} images migrées");
            return $migratedCount;
        }
        
        return 0;
    }

    /**
     * Détermine le type de modèle (categories, products, brands) à partir du contrôleur
     */
    private function getModelType()
    {
        $className = class_basename($this);
        
        if (str_contains(strtolower($className), 'category')) {
            return 'categories';
        } elseif (str_contains(strtolower($className), 'product')) {
            return 'products';
        } elseif (str_contains(strtolower($className), 'brand')) {
            return 'brands';
        }
        
        // Par défaut
        return 'images';
    }
}
