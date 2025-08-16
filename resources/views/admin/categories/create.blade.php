@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Nouvelle Catégorie';
    $breadcrumb = [
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Catégories', 'url' => route('admin.categories.index')],
        ['title' => 'Nouvelle']
    ];
@endphp

@section('page_actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('admin.categories.index') }}" class="btn-admin-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>
@endsection

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Formulaire principal -->
    <div class="lg:col-span-2">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
            @csrf
            
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
                               value="{{ old('name') }}" 
                               placeholder="Ex: Soins du visage"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
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
                                  placeholder="Décrivez cette catégorie...">{{ old('description') }}</textarea>
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
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
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
                               value="{{ old('sort_order') }}" 
                               min="0"
                               placeholder="Auto">
                        @error('sort_order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Laissez vide pour un ordre automatique</p>
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

                <!-- Choix du type d'image -->
                <div class="mb-6">
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="image_type" value="upload" class="mr-2" checked onchange="toggleImageType()">
                            <span class="text-sm font-medium">Télécharger une image</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="image_type" value="url" class="mr-2" onchange="toggleImageType()">
                            <span class="text-sm font-medium">URL d'image</span>
                        </label>
                    </div>
                </div>

                <!-- Upload d'image -->
                <div id="upload_section">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-noorea-gold transition-colors">
                        <div class="text-center">
                            <div id="image_preview" class="mb-4 hidden">
                                <img class="mx-auto h-32 w-auto rounded-lg shadow-md">
                            </div>
                            <div id="upload_placeholder">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-4"></i>
                                <p class="text-sm text-gray-600">Cliquez pour sélectionner ou glissez votre image ici</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF, WEBP (max. 2MB)</p>
                            </div>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   accept="image/*" 
                                   class="hidden" 
                                   onchange="previewImage(this)">
                            <button type="button" onclick="document.getElementById('image').click()" class="btn-admin-secondary mt-4">
                                <i class="fas fa-upload mr-2"></i>Choisir une image
                            </button>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL d'image -->
                <div id="url_section" class="hidden">
                    <label for="image_url" class="admin-form-label">URL de l'image</label>
                    <input type="url" 
                           name="image_url" 
                           id="image_url" 
                           class="admin-form-input @error('image_url') border-red-500 @enderror" 
                           value="{{ old('image_url') }}" 
                           placeholder="https://exemple.com/image.jpg"
                           onchange="previewImageUrl(this.value)">
                    <div id="url_preview" class="mt-4 hidden">
                        <img class="h-32 w-auto rounded-lg shadow-md">
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
                               value="{{ old('meta_title') }}" 
                               placeholder="Titre pour les moteurs de recherche"
                               maxlength="255">
                        @error('meta_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Laissez vide pour utiliser le nom de la catégorie</p>
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
                                  maxlength="500">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Recommandé: 150-160 caractères</p>
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
                        <p class="text-sm text-gray-600">Rendre cette catégorie visible</p>
                    </div>
                    <label class="admin-toggle">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
                               onchange="updateStatusLabel(this)">
                        <span class="toggle-slider"></span>
                        <span class="status-label active ml-2" id="statusLabel">Actif</span>
                    </label>
                </div>

                <!-- Boutons d'action -->
                <div class="space-y-3">
                    <button type="submit" form="categoryForm" class="btn-admin-primary w-full">
                        <i class="fas fa-save mr-2"></i>Créer la catégorie
                    </button>
                    <button type="button" onclick="saveDraft()" class="btn-admin-secondary w-full">
                        <i class="fas fa-file-alt mr-2"></i>Sauvegarder brouillon
                    </button>
                </div>
            </div>
        </div>

        <!-- Aide -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-question-circle text-blue-500 mr-2"></i>
                    Aide
                </h3>
            </div>

            <div class="space-y-3 text-sm">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-lightbulb text-yellow-500 mt-0.5"></i>
                    <div>
                        <p class="font-medium">Nom de catégorie</p>
                        <p class="text-gray-600">Choisissez un nom clair et descriptif pour vos clients.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-lightbulb text-yellow-500 mt-0.5"></i>
                    <div>
                        <p class="font-medium">Sous-catégories</p>
                        <p class="text-gray-600">Les sous-catégories vous aident à organiser vos produits.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-lightbulb text-yellow-500 mt-0.5"></i>
                    <div>
                        <p class="font-medium">Images</p>
                        <p class="text-gray-600">Utilisez des images de bonne qualité (min. 400x400px).</p>
                    </div>
                </div>
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
    const imageType = document.querySelector('input[name="image_type"]:checked').value;
    
    if (imageType === 'upload') {
        uploadSection.classList.remove('hidden');
        urlSection.classList.add('hidden');
        document.getElementById('image_url').value = '';
        document.getElementById('url_preview').classList.add('hidden');
    } else {
        uploadSection.classList.add('hidden');
        urlSection.classList.remove('hidden');
        document.getElementById('image').value = '';
        document.getElementById('image_preview').classList.add('hidden');
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

function saveDraft() {
    // Implémentation du brouillon si nécessaire
    alert('Fonctionnalité de brouillon à implémenter');
}

// Auto-génération du slug
document.getElementById('name').addEventListener('input', function() {
    // Optionnel: affichage du slug généré
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
@endpush
