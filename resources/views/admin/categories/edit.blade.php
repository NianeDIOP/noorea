@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Modifier la Catégorie: ' . $category->name;
    $breadcrumb = [
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Catégories', 'url' => route('admin.categories.index')],
        ['title' => 'Modifier']
    ];
@endphp

@section('page_actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('admin.categories.show', $category) }}" class="btn-admin-secondary">
        <i class="fas fa-eye mr-2"></i>
        Voir la catégorie
    </a>
    <a href="{{ route('admin.categories.index') }}" class="btn-admin-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>
@endsection

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Formulaire principal -->
    <div class="lg:col-span-2">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" id="categoryForm">
            @csrf
            @method('PUT')
            
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
                            <i class="fas fa-tag mr-2"></i>Nom de la catégorie
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="admin-form-input @error('name') border-red-500 @enderror" 
                               value="{{ old('name', $category->name) }}" 
                               placeholder="Ex: Soins du visage"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug (lecture seule) -->
                    <div class="md:col-span-2">
                        <label class="admin-form-label">
                            <i class="fas fa-link mr-2"></i>Slug (URL)
                        </label>
                        <input type="text" 
                               value="{{ $category->slug }}" 
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
                                  rows="3" 
                                  class="admin-form-input @error('description') border-red-500 @enderror" 
                                  placeholder="Décrivez cette catégorie...">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catégorie parente -->
                    <div>
                        <label for="parent_id" class="admin-form-label">
                            <i class="fas fa-sitemap mr-2"></i>Catégorie parente
                        </label>
                        <select name="parent_id" id="parent_id" class="admin-form-select @error('parent_id') border-red-500 @enderror">
                            <option value="">Catégorie principale</option>
                            @foreach($parentCategories as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Laissez vide pour une catégorie principale</p>
                    </div>

                    <!-- Ordre de tri -->
                    <div>
                        <label for="sort_order" class="admin-form-label">
                            <i class="fas fa-sort-numeric-up mr-2"></i>Ordre d'affichage
                        </label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               class="admin-form-input @error('sort_order') border-red-500 @enderror" 
                               value="{{ old('sort_order', $category->sort_order) }}" 
                               min="0">
                        @error('sort_order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div class="admin-card mt-6">
                <div class="admin-card-header">
                    <h3 class="admin-card-title">
                        <i class="fas fa-image text-noorea-gold mr-2"></i>
                        Image de la catégorie
                    </h3>
                </div>

                <!-- Image actuelle -->
                @if($category->image)
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <label class="admin-form-label">Image actuelle</label>
                    <div class="flex items-center space-x-4">
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-200">
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">
                                @if(filter_var($category->image, FILTER_VALIDATE_URL))
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">URL externe</span>
                                @else
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Fichier local</span>
                                @endif
                            </p>
                            <button type="button" onclick="removeCurrentImage()" class="text-red-600 hover:text-red-800 text-sm mt-1">
                                <i class="fas fa-trash mr-1"></i>Supprimer l'image
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Choix du type d'image -->
                <div class="mb-6">
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="image_type" value="upload" class="mr-2" 
                                   {{ !$category->image || !filter_var($category->image, FILTER_VALIDATE_URL) ? 'checked' : '' }} 
                                   onchange="toggleImageType()">
                            <span class="text-sm font-medium">Télécharger une nouvelle image</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="image_type" value="url" class="mr-2" 
                                   {{ $category->image && filter_var($category->image, FILTER_VALIDATE_URL) ? 'checked' : '' }} 
                                   onchange="toggleImageType()">
                            <span class="text-sm font-medium">URL d'image</span>
                        </label>
                    </div>
                </div>

                <!-- Upload d'image -->
                <div id="upload_section" class="{{ $category->image && filter_var($category->image, FILTER_VALIDATE_URL) ? 'hidden' : '' }}">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-noorea-gold transition-colors">
                        <div class="text-center">
                            <div id="image_preview" class="mb-4 hidden">
                                <img class="mx-auto h-32 w-auto rounded-lg shadow-md">
                            </div>
                            <div id="upload_placeholder">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-4"></i>
                                <p class="text-sm text-gray-600">Cliquez pour sélectionner ou glissez votre nouvelle image ici</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF, WEBP (max. 2MB)</p>
                            </div>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   accept="image/*" 
                                   class="hidden" 
                                   onchange="previewImage(this)">
                            <button type="button" onclick="document.getElementById('image').click()" class="btn-admin-secondary mt-4">
                                <i class="fas fa-upload mr-2"></i>Choisir une nouvelle image
                            </button>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL d'image -->
                <div id="url_section" class="{{ !$category->image || !filter_var($category->image, FILTER_VALIDATE_URL) ? 'hidden' : '' }}">
                    <label for="image_url" class="admin-form-label">URL de l'image</label>
                    <input type="url" 
                           name="image_url" 
                           id="image_url" 
                           class="admin-form-input @error('image_url') border-red-500 @enderror" 
                           value="{{ old('image_url', filter_var($category->image ?? '', FILTER_VALIDATE_URL) ? $category->image : '') }}" 
                           placeholder="https://exemple.com/image.jpg"
                           onchange="previewImageUrl(this.value)">
                    <div id="url_preview" class="mt-4 {{ filter_var($category->image ?? '', FILTER_VALIDATE_URL) ? '' : 'hidden' }}">
                        <img src="{{ filter_var($category->image ?? '', FILTER_VALIDATE_URL) ? $category->image : '' }}" class="h-32 w-auto rounded-lg shadow-md">
                    </div>
                    @error('image_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                               class="admin-form-input @error('meta_title') border-red-500 @enderror" 
                               value="{{ old('meta_title', $category->meta_title) }}" 
                               placeholder="Titre pour les moteurs de recherche"
                               maxlength="255">
                        @error('meta_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="admin-form-label">
                            <i class="fas fa-paragraph mr-2"></i>Meta Description
                        </label>
                        <textarea name="meta_description" 
                                  id="meta_description" 
                                  rows="3" 
                                  class="admin-form-input @error('meta_description') border-red-500 @enderror" 
                                  placeholder="Description pour les moteurs de recherche..."
                                  maxlength="500">{{ old('meta_description', $category->meta_description) }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Recommandé: 150-160 caractères</p>
                    </div>
                </div>
            </div>

            <!-- Status dans le formulaire -->
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" id="is_active_input" class="hidden" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
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
                        <p class="text-sm text-gray-600">Rendre cette catégorie visible</p>
                    </div>
                    <label class="admin-toggle">
                        <input type="checkbox" value="1" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
                               onchange="updateStatusLabel(this); syncStatusCheckbox(this)">
                        <span class="toggle-slider"></span>
                        <span class="status-label {{ old('is_active', $category->is_active ?? true) ? 'active' : 'inactive' }} ml-2" id="statusLabel">
                            {{ old('is_active', $category->is_active ?? true) ? 'Actif' : 'Inactif' }}
                        </span>
                    </label>
                </div>

                <!-- Boutons d'action -->
                <div class="space-y-3">
                    <button type="submit" form="categoryForm" class="btn-admin-primary w-full" onclick="debugFormSubmit()">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
                    </button>
                    <a href="{{ route('admin.categories.show', $category) }}" class="btn-admin-secondary w-full">
                        <i class="fas fa-eye mr-2"></i>Voir la catégorie
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
                    <span class="font-semibold text-gray-900">{{ $category->products()->count() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Sous-catégories</span>
                    <span class="font-semibold text-gray-900">{{ $category->subcategories()->count() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Créée le</span>
                    <span class="font-semibold text-gray-900">{{ $category->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Modifiée le</span>
                    <span class="font-semibold text-gray-900">{{ $category->updated_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Actions dangereuses -->
        @if($category->products()->count() === 0 && $category->subcategories()->count() === 0)
        <div class="admin-card border-red-200">
            <div class="admin-card-header">
                <h3 class="admin-card-title text-red-600">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    Zone de danger
                </h3>
            </div>

            <div class="space-y-3">
                <p class="text-sm text-gray-600">
                    La suppression de cette catégorie est irréversible.
                </p>
                <button type="button" onclick="confirmDelete()" class="btn-admin-danger w-full">
                    <i class="fas fa-trash mr-2"></i>Supprimer la catégorie
                </button>
            </div>
        </div>
        @endif
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
                    Êtes-vous sûr de vouloir supprimer la catégorie "<span class="font-semibold">{{ $category->name }}</span>" ?
                </p>
                <p class="text-xs text-red-500 mt-2">Cette action est irréversible.</p>
            </div>
            <div class="items-center px-4 py-3">
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
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
@endsection

@push('scripts')
<script>
function toggleImageType() {
    const uploadSection = document.getElementById('upload_section');
    const urlSection = document.getElementById('url_section');
    const imageInput = document.getElementById('image');
    const imageUrlInput = document.getElementById('image_url');
    const imageType = document.querySelector('input[name="image_type"]:checked').value;
    
    if (imageType === 'upload') {
        uploadSection.classList.remove('hidden');
        urlSection.classList.add('hidden');
        imageInput.disabled = false;
        imageUrlInput.disabled = true;
        imageUrlInput.value = '';
        document.getElementById('url_preview').classList.add('hidden');
    } else {
        uploadSection.classList.add('hidden');
        urlSection.classList.remove('hidden');
        imageInput.disabled = true;
        imageUrlInput.disabled = false;
        // Note: on ne peut pas vider un input file pour des raisons de sécurité
        // mais on le désactive quand on n'en a pas besoin
        document.getElementById('image_preview').classList.add('hidden');
        document.getElementById('upload_placeholder').classList.remove('hidden');
    }
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image_preview');
            const img = preview.querySelector('img');
            img.src = e.target.result;
            preview.classList.remove('hidden');
            document.getElementById('upload_placeholder').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewImageUrl(url) {
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

function removeCurrentImage() {
    if (confirm('Êtes-vous sûr de vouloir supprimer l\'image actuelle ?')) {
        // Ici vous pourriez envoyer une requête AJAX pour supprimer l'image
        // Pour l'instant, on cache juste l'affichage
        alert('Fonctionnalité de suppression d\'image à implémenter via AJAX');
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

// Synchroniser le checkbox visible avec le checkbox dans le formulaire
function syncStatusCheckbox(visibleCheckbox) {
    const hiddenCheckbox = document.getElementById('is_active_input');
    hiddenCheckbox.checked = visibleCheckbox.checked;
}

// Debug du formulaire
function debugFormSubmit() {
    const form = document.getElementById('categoryForm');
    const formData = new FormData(form);
    
    console.log('=== DEBUG FORM SUBMISSION ===');
    console.log('Form action:', form.action);
    console.log('Form method:', form.method);
    console.log('Form enctype:', form.enctype);
    
    console.log('FormData contents:');
    for (let [key, value] of formData.entries()) {
        console.log(key + ':', value);
    }
    
    const imageInput = document.getElementById('image');
    console.log('Image input:', {
        hasFiles: imageInput.files.length > 0,
        fileCount: imageInput.files.length,
        firstFile: imageInput.files[0] ? {
            name: imageInput.files[0].name,
            size: imageInput.files[0].size,
            type: imageInput.files[0].type
        } : null
    });
    
    const imageType = document.querySelector('input[name="image_type"]:checked');
    console.log('Image type:', imageType ? imageType.value : 'none selected');
    
    // Permettre la soumission
    return true;
}
</script>
@endpush
