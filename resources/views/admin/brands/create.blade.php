@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Nouvelle Marque';
    $breadcrumb = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Marques', 'url' => route('admin.brands.index')],
        ['title' => 'Nouvelle']
    ];
@endphp

@section('page_actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('admin.brands.index') }}" class="btn-admin-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>
@endsection

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Formulaire principal -->
    <div class="lg:col-span-2">
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" id="brandForm">
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
                            <i class="fas fa-tag mr-2"></i>Nom de la marque
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="admin-form-input @error('name') border-red-500 @enderror" 
                               value="{{ old('name') }}" 
                               placeholder="Ex: Apple, Nike, L'Oréal"
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
                                  placeholder="Décrivez cette marque...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pays -->
                    <div>
                        <label for="country" class="admin-form-label">
                            <i class="fas fa-globe mr-2"></i>Pays d'origine
                        </label>
                        <input type="text" 
                               name="country" 
                               id="country" 
                               class="admin-form-input @error('country') border-red-500 @enderror" 
                               value="{{ old('country') }}" 
                               placeholder="Ex: France, Maroc, États-Unis">
                        @error('country')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Site web -->
                    <div>
                        <label for="website" class="admin-form-label">
                            <i class="fas fa-external-link-alt mr-2"></i>Site web
                        </label>
                        <input type="url" 
                               name="website" 
                               id="website" 
                               class="admin-form-input @error('website') border-red-500 @enderror" 
                               value="{{ old('website') }}" 
                               placeholder="https://www.exemple.com">
                        @error('website')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
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

                <!-- Choix du type d'image -->
                <div class="mb-6">
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="logo_type" value="upload" class="mr-2" checked onchange="toggleLogoType()">
                            <span class="text-sm font-medium">Télécharger un logo</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="logo_type" value="url" class="mr-2" onchange="toggleLogoType()">
                            <span class="text-sm font-medium">URL de logo</span>
                        </label>
                    </div>
                </div>

                <!-- Upload de logo -->
                <div id="upload_section">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-noorea-gold transition-colors">
                        <div class="text-center">
                            <div id="logo_preview" class="mb-4 hidden">
                                <img class="mx-auto h-32 w-auto rounded-lg shadow-md">
                            </div>
                            <div id="upload_placeholder">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-4"></i>
                                <p class="text-sm text-gray-600">Cliquez pour sélectionner ou glissez votre logo ici</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF, SVG, WEBP (max. 2MB)</p>
                            </div>
                            <input type="file" 
                                   name="logo" 
                                   id="logo" 
                                   accept="image/*" 
                                   class="hidden" 
                                   onchange="previewLogo(this)">
                            <button type="button" onclick="document.getElementById('logo').click()" class="btn-admin-secondary mt-4">
                                <i class="fas fa-upload mr-2"></i>Choisir un logo
                            </button>
                        </div>
                    </div>
                    @error('logo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL de logo -->
                <div id="url_section" class="hidden">
                    <label for="logo_url" class="admin-form-label">URL du logo</label>
                    <input type="url" 
                           name="logo_url" 
                           id="logo_url" 
                           class="admin-form-input @error('logo_url') border-red-500 @enderror" 
                           value="{{ old('logo_url') }}" 
                           placeholder="https://exemple.com/logo.jpg"
                           onchange="previewLogoUrl(this.value)">
                    <div id="url_logo_preview" class="mt-4 hidden">
                        <img class="h-32 w-auto rounded-lg shadow-md">
                    </div>
                    @error('logo_url')
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
                        <p class="text-xs text-gray-500 mt-1">Laissez vide pour utiliser le nom de la marque</p>
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
                        <p class="text-sm text-gray-600">Rendre cette marque visible</p>
                    </div>
                    <label class="admin-toggle">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
                               onchange="updateStatusLabel(this)">
                        <span class="toggle-slider"></span>
                        <span class="status-label active ml-2" id="statusLabel">Actif</span>
                    </label>
                </div>

                <!-- Vedette -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <label class="font-medium text-gray-900">Marque vedette</label>
                        <p class="text-sm text-gray-600">Mise en avant sur le site</p>
                    </div>
                    <label class="admin-toggle">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} 
                               onchange="updateFeaturedLabel(this)">
                        <span class="toggle-slider"></span>
                        <span class="status-label inactive ml-2" id="featuredLabel">Non vedette</span>
                    </label>
                </div>

                <!-- Boutons d'action -->
                <div class="space-y-3">
                    <button type="submit" form="brandForm" class="btn-admin-primary w-full">
                        <i class="fas fa-save mr-2"></i>Créer la marque
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
                        <p class="font-medium">Nom de marque</p>
                        <p class="text-gray-600">Utilisez le nom officiel de la marque.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-lightbulb text-yellow-500 mt-0.5"></i>
                    <div>
                        <p class="font-medium">Logo</p>
                        <p class="text-gray-600">Format carré recommandé (min. 200x200px).</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <i class="fas fa-lightbulb text-yellow-500 mt-0.5"></i>
                    <div>
                        <p class="font-medium">Marque vedette</p>
                        <p class="text-gray-600">Les marques vedettes sont mises en avant.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleLogoType() {
    const uploadRadio = document.querySelector('input[name="logo_type"][value="upload"]');
    const urlRadio = document.querySelector('input[name="logo_type"][value="url"]');
    const uploadSection = document.getElementById('upload_section');
    const urlSection = document.getElementById('url_section');

    if (uploadRadio.checked) {
        uploadSection.classList.remove('hidden');
        urlSection.classList.add('hidden');
    } else if (urlRadio.checked) {
        uploadSection.classList.add('hidden');
        urlSection.classList.remove('hidden');
    }
}

function previewLogo(input) {
    const preview = document.getElementById('logo_preview');
    const placeholder = document.getElementById('upload_placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
    }
}

function previewLogoUrl(url) {
    const preview = document.getElementById('url_logo_preview');
    
    if (url) {
        preview.querySelector('img').src = url;
        preview.querySelector('img').onerror = function() {
            this.src = '';
            preview.classList.add('hidden');
        };
        preview.querySelector('img').onload = function() {
            preview.classList.remove('hidden');
        };
    } else {
        preview.classList.add('hidden');
    }
}

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

function updateFeaturedLabel(checkbox) {
    const label = document.getElementById('featuredLabel');
    if (checkbox.checked) {
        label.textContent = 'Vedette';
        label.className = 'status-label active ml-2';
    } else {
        label.textContent = 'Non vedette';
        label.className = 'status-label inactive ml-2';
    }
}

function saveDraft() {
    const form = document.getElementById('brandForm');
    const formData = new FormData(form);
    formData.append('save_draft', '1');
    
    // Simulation - à implémenter selon vos besoins
    alert('Fonctionnalité de brouillon à implémenter');
}

// Validation côté client
document.getElementById('brandForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    
    if (!name) {
        e.preventDefault();
        alert('Le nom de la marque est requis.');
        document.getElementById('name').focus();
        return;
    }
});
</script>
@endsection
