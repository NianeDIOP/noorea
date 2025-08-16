<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

trait HandlesImageUploads
{
    /**
     * Gère l'upload ou l'URL d'une image selon le type choisi
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $imageField - nom du champ fichier (ex: 'image', 'logo')
     * @param string $urlField - nom du champ URL (ex: 'image_url', 'logo_url')  
     * @param string $typeField - nom du champ type (ex: 'image_type', 'logo_type')
     * @param string $folder - dossier de stockage (ex: 'products', 'brands', 'categories')
     * @param string|null $oldImage - ancienne image à supprimer si nécessaire
     * 
     * @return string|null - chemin de l'image ou URL
     */
    protected function handleImageUpload($request, $imageField, $urlField, $typeField, $folder, $oldImage = null)
    {
        $imageType = $request->input($typeField);
        
        Log::info("Handling image upload", [
            'image_type' => $imageType,
            'has_file' => $request->hasFile($imageField),
            'has_url' => $request->filled($urlField),
            'folder' => $folder
        ]);

        if ($imageType === 'upload') {
            // Mode upload de fichier
            if ($request->hasFile($imageField)) {
                // Supprimer l'ancienne image locale si elle existe
                if ($oldImage && !filter_var($oldImage, FILTER_VALIDATE_URL)) {
                    try {
                        Storage::disk('public')->delete($oldImage);
                        Log::info("Old local image deleted", ['path' => $oldImage]);
                    } catch (\Exception $e) {
                        Log::warning("Failed to delete old image", ['path' => $oldImage, 'error' => $e->getMessage()]);
                    }
                }
                
                try {
                    $file = $request->file($imageField);
                    $path = $file->store($folder, 'public');
                    
                    Log::info("Image uploaded successfully", [
                        'path' => $path,
                        'url' => Storage::disk('public')->url($path)
                    ]);
                    
                    return $path;
                } catch (\Exception $e) {
                    Log::error("Image upload failed", [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw new \Exception('Erreur lors de l\'upload de l\'image: ' . $e->getMessage());
                }
            }
            // Si pas de nouveau fichier en mode upload, on garde l'ancienne image
            return $oldImage;
            
        } elseif ($imageType === 'url' && $request->filled($urlField)) {
            // Mode URL externe
            
            // Supprimer l'ancienne image locale si on passe à une URL
            if ($oldImage && !filter_var($oldImage, FILTER_VALIDATE_URL)) {
                try {
                    Storage::disk('public')->delete($oldImage);
                    Log::info("Old local image deleted when switching to URL", ['path' => $oldImage]);
                } catch (\Exception $e) {
                    Log::warning("Failed to delete old image when switching to URL", ['path' => $oldImage, 'error' => $e->getMessage()]);
                }
            }
            
            $url = $request->input($urlField);
            Log::info("Image URL set", ['url' => $url]);
            
            return $url;
        }

        // Si aucun type valide, on garde l'ancienne image
        return $oldImage;
    }

    /**
     * Supprime une image (locale uniquement, pas les URLs externes)
     * 
     * @param string|null $imagePath
     * @return bool
     */
    protected function deleteImage($imagePath)
    {
        if (!$imagePath || filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return true; // Pas d'image locale à supprimer
        }

        try {
            $deleted = Storage::disk('public')->delete($imagePath);
            Log::info("Image deleted", ['path' => $imagePath, 'success' => $deleted]);
            return $deleted;
        } catch (\Exception $e) {
            Log::error("Failed to delete image", ['path' => $imagePath, 'error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Validation des règles d'images selon le type
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $imageField
     * @param string $urlField  
     * @param string $typeField
     * @param bool $isRequired - si une image est obligatoire
     * @param string|null $currentImage - image actuelle (pour les modifications)
     * 
     * @return array - règles de validation supplémentaires
     */
    protected function getImageValidationRules($request, $imageField, $urlField, $typeField, $isRequired = false, $currentImage = null)
    {
        $rules = [
            $imageField => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            $urlField => 'nullable|url|max:500',
            $typeField => 'required|in:upload,url'
        ];

        // Validation personnalisée pour s'assurer qu'on a une image selon le type
        $imageType = $request->input($typeField);
        
        if ($imageType === 'upload') {
            if ($isRequired && !$request->hasFile($imageField) && !$currentImage) {
                // Pour la création, on doit avoir un fichier
                $rules[$imageField] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            }
        } elseif ($imageType === 'url') {
            if ($isRequired || $request->filled($urlField)) {
                $rules[$urlField] = 'required|url|max:500';
            }
        }

        return $rules;
    }
}
