

<?php $__env->startSection('content'); ?>
<?php
    $page_title = 'Modifier la Marque: ' . $brand->name;
    $breadcrumb = [
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Marques', 'url' => route('admin.brands.index')],
        ['title' => 'Modifier']
    ];
?>

<?php $__env->startSection('page_actions'); ?>
<div class="flex items-center space-x-3">
    <a href="<?php echo e(route('admin.brands.show', $brand)); ?>" class="btn-admin-secondary">
        <i class="fas fa-eye mr-2"></i>
        Voir la marque
    </a>
    <a href="<?php echo e(route('admin.brands.index')); ?>" class="btn-admin-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>
<?php $__env->stopSection(); ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Formulaire principal -->
    <div class="lg:col-span-2">
        <form action="<?php echo e(route('admin.brands.update', $brand)); ?>" method="POST" enctype="multipart/form-data" id="brandForm">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3 class="admin-card-title">
                        <i class="fas fa-info-circle text-noorea-gold mr-2"></i>
                        Informations générales
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div class="md:col-span-2">
                        <label for="name" class="admin-form-label required">
                            <i class="fas fa-tag mr-2"></i>Nom de la marque
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="admin-form-input <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('name', $brand->name)); ?>" 
                               placeholder="Ex: L'Occitane"
                               required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Slug (lecture seule) -->
                    <div class="md:col-span-2">
                        <label class="admin-form-label">
                            <i class="fas fa-link mr-2"></i>Slug (URL)
                        </label>
                        <input type="text" 
                               value="<?php echo e($brand->slug); ?>" 
                               class="admin-form-input bg-gray-50" 
                               readonly>
                        <p class="text-xs text-gray-500 mt-1">Le slug sera mis à jour automatiquement si vous modifiez le nom</p>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="admin-form-label">
                            <i class="fas fa-align-left mr-2"></i>Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4" 
                                  class="admin-form-input <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  placeholder="Décrivez cette marque, son histoire, ses valeurs..."
                                  maxlength="1000"><?php echo e(old('description', $brand->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="flex justify-between mt-1">
                            <p class="text-xs text-gray-500">Description de la marque</p>
                            <p class="text-xs text-gray-500">
                                <span id="description-count"><?php echo e(strlen(old('description', $brand->description ?? ''))); ?></span>/1000
                            </p>
                        </div>
                    </div>

                    <!-- Site web -->
                    <div class="md:col-span-2">
                        <label for="website" class="admin-form-label">
                            <i class="fas fa-external-link-alt mr-2"></i>Site web officiel
                        </label>
                        <input type="url" 
                               name="website" 
                               id="website" 
                               class="admin-form-input <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('website', $brand->website)); ?>" 
                               placeholder="https://www.exemple.com">
                        <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- Logo -->
            <div class="admin-card mt-6">
                <div class="admin-card-header">
                    <h3 class="admin-card-title">
                        <i class="fas fa-image text-noorea-gold mr-2"></i>
                        Logo de la marque
                    </h3>
                </div>

                <!-- Logo actuel -->
                <?php if($brand->logo): ?>
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <label class="admin-form-label">Logo actuel</label>
                    <div class="flex items-center space-x-4">
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-white border">
                            <?php if(filter_var($brand->logo, FILTER_VALIDATE_URL)): ?>
                                <img src="<?php echo e($brand->logo); ?>" alt="<?php echo e($brand->name); ?>" class="w-full h-full object-contain">
                            <?php else: ?>
                                <img src="<?php echo e(Storage::url($brand->logo)); ?>" alt="<?php echo e($brand->name); ?>" class="w-full h-full object-contain">
                            <?php endif; ?>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">
                                <?php if(filter_var($brand->logo, FILTER_VALIDATE_URL)): ?>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">URL externe</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Fichier local</span>
                                <?php endif; ?>
                            </p>
                            <button type="button" onclick="removeCurrentLogo()" class="text-red-600 hover:text-red-800 text-sm mt-1">
                                <i class="fas fa-trash mr-1"></i>Supprimer le logo
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Choix du type de logo -->
                <div class="mb-6">
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="logo_type" value="upload" class="mr-2" 
                                   <?php echo e(!$brand->logo || !filter_var($brand->logo, FILTER_VALIDATE_URL) ? 'checked' : ''); ?> 
                                   onchange="toggleLogoType()">
                            <span class="text-sm font-medium">Télécharger un nouveau logo</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="logo_type" value="url" class="mr-2" 
                                   <?php echo e($brand->logo && filter_var($brand->logo, FILTER_VALIDATE_URL) ? 'checked' : ''); ?> 
                                   onchange="toggleLogoType()">
                            <span class="text-sm font-medium">URL de logo</span>
                        </label>
                    </div>
                </div>

                <!-- Upload de logo -->
                <div id="upload_section" class="<?php echo e($brand->logo && filter_var($brand->logo, FILTER_VALIDATE_URL) ? 'hidden' : ''); ?>">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-noorea-gold transition-colors">
                        <div class="text-center">
                            <div id="logo_preview" class="mb-4 hidden">
                                <img class="mx-auto h-32 w-auto rounded-lg shadow-md">
                            </div>
                            <div id="upload_placeholder">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-4"></i>
                                <p class="text-sm text-gray-600">Cliquez pour sélectionner ou glissez votre nouveau logo ici</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, SVG (recommandé), GIF (max. 2MB)</p>
                            </div>
                            <input type="file" 
                                   name="logo" 
                                   id="logo" 
                                   accept="image/*" 
                                   class="hidden" 
                                   onchange="previewLogo(this)">
                            <button type="button" onclick="document.getElementById('logo').click()" class="btn-admin-secondary mt-4">
                                <i class="fas fa-upload mr-2"></i>Choisir un nouveau logo
                            </button>
                        </div>
                    </div>
                    <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- URL de logo -->
                <div id="url_section" class="<?php echo e(!$brand->logo || !filter_var($brand->logo, FILTER_VALIDATE_URL) ? 'hidden' : ''); ?>">
                    <label for="logo_url" class="admin-form-label">URL du logo</label>
                    <input type="url" 
                           name="logo_url" 
                           id="logo_url" 
                           class="admin-form-input <?php $__errorArgs = ['logo_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           value="<?php echo e(old('logo_url', filter_var($brand->logo ?? '', FILTER_VALIDATE_URL) ? $brand->logo : '')); ?>" 
                           placeholder="https://exemple.com/logo.png"
                           onchange="previewLogoUrl(this.value)">
                    <div id="url_preview" class="mt-4 <?php echo e(filter_var($brand->logo ?? '', FILTER_VALIDATE_URL) ? '' : 'hidden'); ?>">
                        <img src="<?php echo e(filter_var($brand->logo ?? '', FILTER_VALIDATE_URL) ? $brand->logo : ''); ?>" class="h-32 w-auto rounded-lg shadow-md bg-white border p-2">
                    </div>
                    <?php $__errorArgs = ['logo_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- SEO -->
            <div class="admin-card mt-6">
                <div class="admin-card-header">
                    <h3 class="admin-card-title">
                        <i class="fas fa-search text-noorea-gold mr-2"></i>
                        Optimisation SEO
                    </h3>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Meta Title -->
                    <div>
                        <label for="meta_title" class="admin-form-label">
                            <i class="fas fa-heading mr-2"></i>Meta Title
                        </label>
                        <input type="text" 
                               name="meta_title" 
                               id="meta_title" 
                               class="admin-form-input <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('meta_title', $brand->meta_title)); ?>" 
                               placeholder="Titre pour les moteurs de recherche"
                               maxlength="255">
                        <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="admin-form-label">
                            <i class="fas fa-paragraph mr-2"></i>Meta Description
                        </label>
                        <textarea name="meta_description" 
                                  id="meta_description" 
                                  rows="3" 
                                  class="admin-form-input <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  placeholder="Description pour les moteurs de recherche..."
                                  maxlength="500"><?php echo e(old('meta_description', $brand->meta_description)); ?></textarea>
                        <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="flex justify-between mt-1">
                            <p class="text-xs text-gray-500">Recommandé: 150-160 caractères</p>
                            <p class="text-xs text-gray-500">
                                <span id="meta-description-count"><?php echo e(strlen(old('meta_description', $brand->meta_description ?? ''))); ?></span>/500
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Actions -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-cogs text-noorea-gold mr-2"></i>
                    Actions
                </h3>
            </div>

            <div class="space-y-4">
                <!-- Statut -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <label class="font-medium text-gray-900">Statut</label>
                        <p class="text-sm text-gray-600">Rendre cette marque visible</p>
                    </div>
                    <label class="admin-toggle">
                        <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $brand->is_active ?? true) ? 'checked' : ''); ?>

                               onchange="updateStatusLabel(this)">
                        <span class="toggle-slider"></span>
                        <span class="status-label <?php echo e(old('is_active', $brand->is_active ?? true) ? 'active' : 'inactive'); ?> ml-2" id="statusLabel">
                            <?php echo e(old('is_active', $brand->is_active ?? true) ? 'Actif' : 'Inactif'); ?>

                        </span>
                    </label>
                </div>

                <!-- Boutons d'action -->
                <div class="space-y-3">
                    <button type="submit" form="brandForm" class="btn-admin-primary w-full">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
                    </button>
                    <a href="<?php echo e(route('admin.brands.show', $brand)); ?>" class="btn-admin-secondary w-full">
                        <i class="fas fa-eye mr-2"></i>Voir la marque
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-chart-bar text-blue-500 mr-2"></i>
                    Statistiques
                </h3>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Produits</span>
                    <span class="font-semibold text-gray-900"><?php echo e($brand->products()->count()); ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Créée le</span>
                    <span class="font-semibold text-gray-900"><?php echo e($brand->created_at->format('d/m/Y')); ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Modifiée le</span>
                    <span class="font-semibold text-gray-900"><?php echo e($brand->updated_at->format('d/m/Y')); ?></span>
                </div>
            </div>
        </div>

        <!-- Actions dangereuses -->
        <?php if($brand->products()->count() === 0): ?>
        <div class="admin-card border-red-200">
            <div class="admin-card-header">
                <h3 class="admin-card-title text-red-600">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    Zone de danger
                </h3>
            </div>

            <div class="space-y-3">
                <p class="text-sm text-gray-600">
                    La suppression de cette marque est irréversible.
                </p>
                <button type="button" onclick="confirmDelete()" class="btn-admin-danger w-full">
                    <i class="fas fa-trash mr-2"></i>Supprimer la marque
                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mt-4">Confirmer la suppression</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Êtes-vous sûr de vouloir supprimer la marque "<span class="font-semibold"><?php echo e($brand->name); ?></span>" ?
                </p>
                <p class="text-xs text-red-500 mt-2">Cette action est irréversible.</p>
            </div>
            <div class="items-center px-4 py-3">
                <form action="<?php echo e(route('admin.brands.destroy', $brand)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-admin-danger mr-3">
                        <i class="fas fa-trash mr-2"></i>Supprimer
                    </button>
                </form>
                <button onclick="closeDeleteModal()" class="btn-admin-secondary">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire
    document.getElementById('brandForm').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        
        if (!name) {
            e.preventDefault();
            alert('Le nom de la marque est requis.');
            document.getElementById('name').focus();
            return;
        }
    });

    // Compteurs de caractères
    function setupCharacterCounter(inputId, counterId, maxLength) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);
        
        if (input && counter) {
            input.addEventListener('input', function() {
                const currentLength = this.value.length;
                counter.textContent = currentLength;
                
                if (currentLength > maxLength * 0.9) {
                    counter.style.color = '#ef4444';
                } else if (currentLength > maxLength * 0.7) {
                    counter.style.color = '#f59e0b';
                } else {
                    counter.style.color = '#6b7280';
                }
            });
        }
    }
    
    setupCharacterCounter('description', 'description-count', 1000);
    setupCharacterCounter('meta_description', 'meta-description-count', 500);
});

function toggleLogoType() {
    const uploadSection = document.getElementById('upload_section');
    const urlSection = document.getElementById('url_section');
    const logoType = document.querySelector('input[name="logo_type"]:checked').value;
    
    if (logoType === 'upload') {
        uploadSection.classList.remove('hidden');
        urlSection.classList.add('hidden');
        document.getElementById('logo_url').value = '';
        document.getElementById('url_preview').classList.add('hidden');
    } else {
        uploadSection.classList.add('hidden');
        urlSection.classList.remove('hidden');
        document.getElementById('logo').value = '';
        document.getElementById('logo_preview').classList.add('hidden');
    }
}

function previewLogo(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('logo_preview');
            const img = preview.querySelector('img');
            img.src = e.target.result;
            preview.classList.remove('hidden');
            document.getElementById('upload_placeholder').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewLogoUrl(url) {
    if (url) {
        const preview = document.getElementById('url_preview');
        const img = preview.querySelector('img');
        img.src = url;
        img.onload = function() {
            preview.classList.remove('hidden');
        };
        img.onerror = function() {
            preview.classList.add('hidden');
        };
    } else {
        document.getElementById('url_preview').classList.add('hidden');
    }
}

function removeCurrentLogo() {
    if (confirm('Êtes-vous sûr de vouloir supprimer le logo actuel ?')) {
        // Ici vous pourriez envoyer une requête AJAX pour supprimer le logo
        // Pour l'instant, on cache juste l'affichage
        alert('Fonctionnalité de suppression de logo à implémenter via AJAX');
    }
}

function confirmDelete() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Fermer le modal en cliquant en dehors
document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Gestion du toggle status
function updateStatusLabel(checkbox) {
    const label = document.getElementById('statusLabel');
    if (checkbox.checked) {
        label.textContent = 'Actif';
        label.className = 'status-label active ml-2';
    } else {
        label.textContent = 'Inactif';
        label.className = 'status-label inactive ml-2';
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/admin/brands/edit.blade.php ENDPATH**/ ?>