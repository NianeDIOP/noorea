@extends('admin.layouts.app')

@section('title', 'Détails du produit - ' . $product->name)

@section('content')
    <!-- Header -->
    <div class="admin-card">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="h-8 w-1 bg-noorea-gold rounded-full"></div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Détails du produit</h1>
                    <p class="text-gray-600 mt-1">Informations complètes du produit {{ $product->name }}</p>
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
                
                @if($product->featured)
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-star w-2 h-2 mr-1.5"></i>
                        Vedette
                    </div>
                @endif

                <a href="{{ route('admin.products.edit', $product) }}" class="btn-admin-primary">
                    <i class="fas fa-edit mr-2"></i>Modifier
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn-admin-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Image et informations générales -->
            <div class="admin-card">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-info text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Informations générales</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image du produit -->
                    <div>
                        @if($product->images && count($product->images) > 0)
                            <div class="aspect-square rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="aspect-square rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
                                <div class="text-center">
                                    <i class="fas fa-image text-gray-400 text-4xl mb-2"></i>
                                    <p class="text-gray-500">Aucune image</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Informations détaillées -->
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nom du produit</label>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $product->name }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-500">SKU</label>
                                <p class="mt-1 text-gray-900">{{ $product->sku ?: 'Non défini' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Prix</label>
                                <p class="mt-1 text-xl font-bold text-noorea-gold">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Catégorie</label>
                            <p class="mt-1 text-gray-900">
                                @if($product->category)
                                    <a href="{{ route('admin.categories.show', $product->category) }}" 
                                       class="text-noorea-gold hover:text-noorea-gold/80">
                                        {{ $product->category->name }}
                                    </a>
                                @else
                                    <span class="text-gray-400">Non définie</span>
                                @endif
                            </p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Marque</label>
                            <p class="mt-1 text-gray-900">
                                @if($product->brand)
                                    <a href="{{ route('admin.brands.show', $product->brand) }}" 
                                       class="text-noorea-gold hover:text-noorea-gold/80">
                                        {{ $product->brand->name }}
                                    </a>
                                @else
                                    <span class="text-gray-400">Non définie</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Descriptions -->
            <div class="admin-card">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-align-left text-purple-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Descriptions</h3>
                </div>

                <div class="space-y-6">
                    @if($product->short_description)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Description courte</label>
                            <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                                <p class="text-gray-900">{{ $product->short_description }}</p>
                            </div>
                        </div>
                    @endif

                    @if($product->description)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Description complète</label>
                            <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                                <p class="text-gray-900 whitespace-pre-line">{{ $product->description }}</p>
                            </div>
                        </div>
                    @endif

                    @if(!$product->short_description && !$product->description)
                        <div class="text-center py-8">
                            <i class="fas fa-file-alt text-gray-300 text-4xl mb-2"></i>
                            <p class="text-gray-500">Aucune description disponible</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- SEO -->
            @if($product->meta_title || $product->meta_description)
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-search text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Optimisation SEO</h3>
                    </div>

                    <div class="space-y-4">
                        @if($product->meta_title)
                            <div>
                                <label class="text-sm font-medium text-gray-500">Titre SEO</label>
                                <p class="mt-1 text-gray-900">{{ $product->meta_title }}</p>
                            </div>
                        @endif

                        @if($product->meta_description)
                            <div>
                                <label class="text-sm font-medium text-gray-500">Description SEO</label>
                                <p class="mt-1 text-gray-700">{{ $product->meta_description }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Actions rapides -->
            <div class="admin-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn-admin-primary w-full text-center">
                        <i class="fas fa-edit mr-2"></i>Modifier le produit
                    </a>
                    
                    @if($product->status === 'active')
                        <form action="{{ route('admin.products.update-status', $product) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="inactive">
                            <button type="submit" class="btn-admin-secondary w-full">
                                <i class="fas fa-eye-slash mr-2"></i>Désactiver
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.products.update-status', $product) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="active">
                            <button type="submit" class="btn-admin-primary w-full">
                                <i class="fas fa-eye mr-2"></i>Activer
                            </button>
                        </form>
                    @endif

                    @if($product->featured)
                        <form action="{{ route('admin.products.toggle-featured', $product) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-admin-outline w-full">
                                <i class="fas fa-star-half-alt mr-2"></i>Retirer de la vedette
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.products.toggle-featured', $product) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-admin-outline w-full">
                                <i class="fas fa-star mr-2"></i>Mettre en vedette
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-admin-danger w-full">
                            <i class="fas fa-trash mr-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistiques du stock -->
            <div class="admin-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion du stock</h3>
                
                <div class="space-y-4">
                    <!-- Quantité en stock -->
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Quantité en stock</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $product->stock_quantity ?? 0 }}</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-blue-600"></i>
                        </div>
                    </div>

                    <!-- Stock minimum -->
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Stock minimum</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $product->min_stock ?? 0 }}</p>
                        </div>
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-orange-600"></i>
                        </div>
                    </div>

                    <!-- Statut du stock -->
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Statut du stock</p>
                            @php
                                $stockQuantity = $product->stock_quantity ?? 0;
                                $minStock = $product->min_stock ?? 0;
                            @endphp
                            
                            @if($stockQuantity <= 0)
                                <p class="text-lg font-semibold text-red-600">Rupture de stock</p>
                            @elseif($stockQuantity <= $minStock)
                                <p class="text-lg font-semibold text-orange-600">Stock faible</p>
                            @else
                                <p class="text-lg font-semibold text-green-600">En stock</p>
                            @endif
                        </div>
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center
                            @if($stockQuantity <= 0) bg-red-100 @elseif($stockQuantity <= $minStock) bg-orange-100 @else bg-green-100 @endif">
                            <i class="fas fa-chart-line 
                                @if($stockQuantity <= 0) text-red-600 @elseif($stockQuantity <= $minStock) text-orange-600 @else text-green-600 @endif"></i>
                        </div>
                    </div>

                    <!-- Suivi du stock -->
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Suivi du stock</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $product->track_stock ? 'Activé' : 'Désactivé' }}
                            </p>
                        </div>
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center
                            {{ $product->track_stock ? 'bg-green-100' : 'bg-gray-100' }}">
                            <i class="fas {{ $product->track_stock ? 'fa-toggle-on text-green-600' : 'fa-toggle-off text-gray-400' }}"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="admin-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Métadonnées</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">ID</span>
                        <span class="text-sm text-gray-900">#{{ $product->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Créé le</span>
                        <span class="text-sm text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-500">Modifié le</span>
                        <span class="text-sm text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
