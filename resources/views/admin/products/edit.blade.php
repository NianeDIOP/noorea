@extends('admin.layouts.app')

@section('title', 'Modifier le produit - ' . $product->name)

@section('content')
    <!-- Header -->
    <div class="admin-card">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="h-8 w-1 bg-noorea-gold rounded-full"></div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Modifier le produit</h1>
                    <p class="text-gray-600 mt-1">Modifiez les informations du produit {{ $product->name }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                @if($product->status === 'active')
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-circle w-2 h-2 mr-1.5"></i>
                        Actif
                    </div>
                @elseif($product->status === 'inactive')
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <i class="fas fa-circle w-2 h-2 mr-1.5"></i>
                        Inactif
                    </div>
                @else
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-circle w-2 h-2 mr-1.5"></i>
                        Brouillon
                    </div>
                @endif
                <a href="{{ route('admin.products.index') }}" class="btn-admin-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Erreurs de validation</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Contenu principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Informations générales -->
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-info text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informations générales</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Nom du produit -->
                        <div class="admin-form-group">
                            <label class="admin-form-label required">Nom du produit</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                                   class="admin-form-input @error('name') border-red-300 @enderror"
                                   placeholder="Ex: iPhone 14 Pro Max">
                            @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SKU et Prix -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="admin-form-group">
                                <label class="admin-form-label">SKU</label>
                                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" 
                                       class="admin-form-input @error('sku') border-red-300 @enderror"
                                       placeholder="Ex: IPH14PM-128-BLK">
                                @error('sku')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label required">Prix (€)</label>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}" 
                                       step="0.01" min="0"
                                       class="admin-form-input @error('price') border-red-300 @enderror"
                                       placeholder="Ex: 1199.99">
                                @error('price')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description courte -->
                        <div class="admin-form-group">
                            <label class="admin-form-label">Description courte</label>
                            <textarea name="short_description" rows="3" 
                                      class="admin-form-input @error('short_description') border-red-300 @enderror"
                                      placeholder="Résumé en quelques mots du produit">{{ old('short_description', $product->short_description) }}</textarea>
                            @error('short_description')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description complète -->
                        <div class="admin-form-group">
                            <label class="admin-form-label">Description complète</label>
                            <textarea name="description" rows="6" 
                                      class="admin-form-input @error('description') border-red-300 @enderror"
                                      placeholder="Description détaillée du produit, ses caractéristiques, avantages...">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Gestion des images -->
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-images text-purple-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Images du produit</h3>
                    </div>

                    <!-- Image actuelle -->
                    @if($product->images && count($product->images) > 0)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Image actuelle</label>
                            <div class="relative inline-block">
                                <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" 
                                     class="h-32 w-32 object-cover rounded-lg border border-gray-200">
                            </div>
                        </div>
                    @endif

                    <!-- Choix du type d'image -->
                    <div class="admin-form-group">
                        <label class="admin-form-label">Type d'image</label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="image_type" value="upload" 
                                       class="form-radio text-noorea-gold" checked>
                                <span class="ml-2">Télécharger une image</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="image_type" value="url" class="form-radio text-noorea-gold">
                                <span class="ml-2">URL d'image</span>
                            </label>
                        </div>
                    </div>

                    <!-- Upload d'image -->
                    <div class="admin-form-group" id="image-upload-section">
                        <label class="admin-form-label">Nouvelle image (optionnel)</label>
                        <div class="mt-1">
                            <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-noorea-gold transition-colors" id="dropzone">
                                <div class="space-y-1 text-center">
                                    <div id="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-noorea-gold hover:text-noorea-gold/80 focus:outline-none focus:ring-2 focus:ring-noorea-gold">
                                                <span>Cliquez pour télécharger</span>
                                                <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="handleImageUpload(this)">
                                            </label>
                                            <p class="pl-1">ou glisser-déposer une image ici</p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF jusqu'à 2MB</p>
                                    </div>
                                    <div id="image-preview" class="hidden">
                                        <img id="preview-img" class="mx-auto h-32 w-32 object-cover rounded-lg" src="" alt="Preview">
                                        <div class="mt-2 flex items-center justify-center space-x-2">
                                            <span id="file-name" class="text-sm text-gray-600"></span>
                                            <button type="button" onclick="removeImage()" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- URL d'image -->
                    <div class="admin-form-group hidden" id="image-url-section">
                        <label class="admin-form-label">URL de l'image</label>
                        <input type="url" name="image_url_input" 
                               class="admin-form-input @error('image_url_input') border-red-300 @enderror"
                               placeholder="https://example.com/image.jpg">
                        @error('image_url_input')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SEO -->
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-search text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Optimisation SEO</h3>
                    </div>

                    <div class="space-y-4">
                        <!-- Meta Title -->
                        <div class="admin-form-group">
                            <label class="admin-form-label">Titre SEO</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}" 
                                   class="admin-form-input @error('meta_title') border-red-300 @enderror"
                                   placeholder="Titre optimisé pour les moteurs de recherche">
                            @error('meta_title')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Meta Description -->
                        <div class="admin-form-group">
                            <label class="admin-form-label">Description SEO</label>
                            <textarea name="meta_description" rows="3" 
                                      class="admin-form-input @error('meta_description') border-red-300 @enderror"
                                      placeholder="Description optimisée pour les moteurs de recherche (155 caractères max)">{{ old('meta_description', $product->meta_description) }}</textarea>
                            @error('meta_description')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Actions -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <button type="submit" class="btn-admin-primary w-full">
                            <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.products.show', $product) }}" class="btn-admin-secondary w-full text-center">
                            <i class="fas fa-eye mr-2"></i>Aperçu du produit
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn-admin-outline w-full text-center">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </a>
                    </div>
                </div>

                <!-- Configuration -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Configuration</h3>
                    
                    <!-- Statut -->
                    <div class="admin-form-group">
                        <label class="admin-form-label required">Statut</label>
                        <select name="status" class="admin-form-select @error('status') border-red-300 @enderror">
                            <option value="draft" {{ old('status', $product->status) === 'draft' ? 'selected' : '' }}>Brouillon</option>
                            <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Actif</option>
                            <option value="inactive" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Inactif</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Produit vedette -->
                    <div class="admin-form-group">
                        <label class="flex items-center">
                            <input type="checkbox" name="featured" value="1" 
                                   {{ old('featured', $product->featured) ? 'checked' : '' }}
                                   class="form-checkbox h-4 w-4 text-noorea-gold">
                            <span class="ml-2 text-sm font-medium text-gray-700">Produit vedette</span>
                        </label>
                        <p class="text-sm text-gray-500 mt-1">Afficher ce produit en avant sur le site</p>
                    </div>
                </div>

                <!-- Classification -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Classification</h3>
                    
                    <!-- Catégorie -->
                    <div class="admin-form-group">
                        <label class="admin-form-label required">Catégorie</label>
                        <select name="category_id" class="admin-form-select @error('category_id') border-red-300 @enderror">
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Marque -->
                    <div class="admin-form-group">
                        <label class="admin-form-label">Marque</label>
                        <select name="brand_id" class="admin-form-select @error('brand_id') border-red-300 @enderror">
                            <option value="">Sélectionner une marque</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" 
                                        {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Stock -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion du stock</h3>
                    
                    <div class="space-y-4">
                        <!-- Quantité en stock -->
                        <div class="admin-form-group">
                            <label class="admin-form-label">Quantité en stock</label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" 
                                   min="0" class="admin-form-input @error('stock_quantity') border-red-300 @enderror"
                                   placeholder="Ex: 100">
                            @error('stock_quantity')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stock minimum -->
                        <div class="admin-form-group">
                            <label class="admin-form-label">Stock minimum</label>
                            <input type="number" name="min_stock" value="{{ old('min_stock', $product->min_stock) }}" 
                                   min="0" class="admin-form-input @error('min_stock') border-red-300 @enderror"
                                   placeholder="Ex: 10">
                            <p class="text-sm text-gray-500 mt-1">Alerte quand le stock atteint ce niveau</p>
                            @error('min_stock')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Suivi du stock -->
                        <div class="admin-form-group">
                            <label class="flex items-center">
                                <input type="checkbox" name="track_stock" value="1" 
                                       {{ old('track_stock', $product->track_stock) ? 'checked' : '' }}
                                       class="form-checkbox h-4 w-4 text-noorea-gold">
                                <span class="ml-2 text-sm font-medium text-gray-700">Suivre le stock</span>
                            </label>
                            <p class="text-sm text-gray-500 mt-1">Décrémenter automatiquement lors des ventes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des types d'image
        const imageTypeRadios = document.querySelectorAll('input[name="image_type"]');
        const uploadSection = document.getElementById('image-upload-section');
        const urlSection = document.getElementById('image-url-section');

        imageTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'upload') {
                    uploadSection.classList.remove('hidden');
                    urlSection.classList.add('hidden');
                } else {
                    uploadSection.classList.add('hidden');
                    urlSection.classList.remove('hidden');
                }
            });
        });

        // Gestion du drag & drop
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('image');

        if (dropzone && fileInput) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropzone.classList.add('border-noorea-gold', 'bg-noorea-gold/5');
            }

            function unhighlight(e) {
                dropzone.classList.remove('border-noorea-gold', 'bg-noorea-gold/5');
            }

            dropzone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length > 0) {
                    fileInput.files = files;
                    handleImageUpload(fileInput);
                }
            }
        }
    });

    function handleImageUpload(input) {
        const file = input.files[0];
        const placeholder = document.getElementById('upload-placeholder');
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        const fileName = document.getElementById('file-name');

        if (file) {
            // Validation du type de fichier
            if (!file.type.match('image.*')) {
                alert('Veuillez sélectionner un fichier image valide.');
                input.value = '';
                return;
            }

            // Validation de la taille (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('Le fichier est trop volumineux. Taille maximale : 2MB.');
                input.value = '';
                return;
            }

            // Affichage de l'aperçu
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                fileName.textContent = file.name;
                placeholder.classList.add('hidden');
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        const fileInput = document.getElementById('image');
        const placeholder = document.getElementById('upload-placeholder');
        const preview = document.getElementById('image-preview');

        fileInput.value = '';
        placeholder.classList.remove('hidden');
        preview.classList.add('hidden');
    }
    </script>
@endsection
