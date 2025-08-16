@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Gestion des Produits';
    $breadcrumb = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Produits']
    ];
@endphp

@section('page_actions')
<div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
    <div class="flex items-center space-x-2">
        <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-box text-noorea-gold mr-2"></i>
            <span class="font-medium text-gray-700">{{ $products->total() }} produit(s)</span>
        </div>
        @if(request()->hasAny(['search', 'status', 'category_id', 'brand_id', 'featured', 'stock']))
        <div class="flex items-center bg-blue-50 text-blue-700 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-filter mr-2"></i>
            <span class="font-medium">Filtres actifs</span>
        </div>
        @endif
    </div>
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.products.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>
            Nouveau Produit
        </a>
    </div>
</div>
@endsection

<!-- Statistiques rapides -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stats-card primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Produits</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $products->total() }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card success">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Actifs</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $products->where('status', 'active')->count() }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card warning">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">En Rupture</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $products->where('stock_quantity', '<=', 0)->count() }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card info">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Vedettes</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $products->where('is_featured', true)->count() }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filtres et recherche -->
<div class="admin-card mb-6">
    <div class="admin-card-header">
        <h3 class="admin-card-title">
            <i class="fas fa-filter text-noorea-gold mr-2"></i>
            Filtres et Recherche
        </h3>
        @if(request()->hasAny(['search', 'status', 'category_id', 'brand_id', 'featured', 'stock']))
        <div class="flex items-center space-x-2">
            <span class="text-sm text-blue-600 bg-blue-50 px-3 py-1 rounded-lg">
                {{ collect(request()->only(['search', 'status', 'category_id', 'brand_id', 'featured', 'stock']))->filter()->count() }} filtre(s) actif(s)
            </span>
            <a href="{{ route('admin.products.index') }}" class="btn-admin-secondary text-sm">
                <i class="fas fa-times mr-2"></i>Réinitialiser
            </a>
        </div>
        @endif
    </div>
    
    <!-- Formulaire de filtres unifié -->
    <form method="GET" action="{{ route('admin.products.index') }}" id="filter-form">
        <!-- Filtres principaux - toujours visibles -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <!-- Recherche -->
            <div class="admin-form-group">
                <label class="admin-form-label">
                    <i class="fas fa-search mr-1 text-gray-400"></i>
                    Recherche
                </label>
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Nom, SKU, description..."
                           class="admin-form-input pl-10">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Statut -->
            <div class="admin-form-group">
                <label class="admin-form-label">
                    <i class="fas fa-toggle-on mr-1 text-gray-400"></i>
                    Statut
                </label>
                <select name="status" class="admin-form-select">
                    <option value="">Tous</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actifs</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactifs</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Brouillons</option>
                </select>
            </div>

            <!-- Catégorie -->
            <div class="admin-form-group">
                <label class="admin-form-label">
                    <i class="fas fa-folder mr-1 text-gray-400"></i>
                    Catégorie
                </label>
                <select name="category_id" class="admin-form-select">
                    <option value="">Toutes</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Actions -->
            <div class="admin-form-group flex items-end">
                <div class="flex space-x-2 w-full">
                    <button type="submit" class="btn-admin-primary flex-1">
                        <i class="fas fa-search mr-2"></i>Rechercher
                    </button>
                    @if(request()->hasAny(['search', 'status', 'category_id', 'brand_id', 'featured', 'stock']))
                        <a href="{{ route('admin.products.index') }}" class="btn-admin-secondary px-3" title="Réinitialiser les filtres">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Toggle pour filtres avancés -->
        <div class="flex items-center justify-between border-t pt-4">
            <button type="button" id="toggle-advanced-filters" 
                    class="flex items-center text-gray-600 hover:text-noorea-gold transition-colors">
                <i class="fas fa-sliders-h mr-2"></i>
                <span>Filtres avancés</span>
                <i class="fas fa-chevron-down ml-2 transform transition-transform" id="chevron-icon"></i>
            </button>
            
            @if(request()->hasAny(['brand_id', 'featured', 'stock']))
                <span class="text-xs bg-noorea-gold text-white px-2 py-1 rounded-full">
                    {{ collect(request()->only(['brand_id', 'featured', 'stock']))->filter()->count() }} filtre(s) avancé(s)
                </span>
            @endif
        </div>

        <!-- Filtres avancés - cachés par défaut -->
        <div id="advanced-filters" class="hidden mt-4 pt-4 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Marque -->
                <div class="admin-form-group">
                    <label class="admin-form-label">
                        <i class="fas fa-tags mr-1 text-gray-400"></i>
                        Marque
                    </label>
                    <select name="brand_id" class="admin-form-select">
                        <option value="">Toutes les marques</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Produits vedettes -->
                <div class="admin-form-group">
                    <label class="admin-form-label">
                        <i class="fas fa-star mr-1 text-gray-400"></i>
                        Vedette
                    </label>
                    <select name="featured" class="admin-form-select">
                        <option value="">Tous</option>
                        <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Vedettes uniquement</option>
                        <option value="0" {{ request('featured') === '0' ? 'selected' : '' }}>Non-vedettes</option>
                    </select>
                </div>

                <!-- Stock -->
                <div class="admin-form-group">
                    <label class="admin-form-label">
                        <i class="fas fa-box mr-1 text-gray-400"></i>
                        Stock
                    </label>
                    <select name="stock" class="admin-form-select">
                        <option value="">Tous les niveaux</option>
                        <option value="in_stock" {{ request('stock') === 'in_stock' ? 'selected' : '' }}>En stock</option>
                        <option value="low_stock" {{ request('stock') === 'low_stock' ? 'selected' : '' }}>Stock faible</option>
                        <option value="out_of_stock" {{ request('stock') === 'out_of_stock' ? 'selected' : '' }}>Rupture</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end mt-4">
                <button type="submit" class="btn-admin-primary">
                    <i class="fas fa-filter mr-2"></i>Appliquer les filtres
                </button>
            </div>
        </div>
    </form>
    </form>
</div>

<!-- Liste des produits -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">
            <i class="fas fa-list text-noorea-gold mr-2"></i>
            Liste des Produits
        </h3>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-500">
                {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} sur {{ $products->total() }}
            </span>
            @if($products->hasPages())
            <div class="flex items-center space-x-1 text-sm text-gray-500">
                <i class="fas fa-file-alt"></i>
                <span>Page {{ $products->currentPage() }} sur {{ $products->lastPage() }}</span>
            </div>
            @endif
        </div>
    </div>

    @if($products->count() > 0)
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Catégorie</th>
                    <th>Marque</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Statut</th>
                    <th>Vedette</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <!-- Image -->
                    <td>
                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center border">
                            @if($product->images && count($product->images) > 0 && $product->images[0])
                                <img src="{{ $product->images[0] }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-200"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full flex items-center justify-center text-gray-400" style="display: none;">
                                    <i class="fas fa-image text-xl"></i>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-xl"></i>
                                </div>
                            @endif
                        </div>
                    </td>

                    <!-- Produit -->
                    <td>
                        <div class="flex flex-col">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-gray-900">{{ $product->name }}</span>
                            </div>
                            @if($product->sku)
                                <span class="text-xs text-gray-500">SKU: {{ $product->sku }}</span>
                            @endif
                            @if($product->short_description)
                                <span class="text-sm text-gray-500">{{ Str::limit($product->short_description, 50) }}</span>
                            @endif
                        </div>
                    </td>

                    <!-- Catégorie -->
                    <td>
                        @if($product->category)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $product->category->name }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <!-- Marque -->
                    <td>
                        @if($product->brand)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $product->brand->name }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <!-- Prix -->
                    <td>
                        <div class="flex flex-col">
                            @if($product->is_on_sale)
                                <span class="text-lg font-semibold text-red-600">{{ number_format($product->sale_price, 0, ',', ' ') }} FCFA</span>
                                <span class="text-sm text-gray-500 line-through">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                            @else
                                <span class="text-lg font-semibold text-gray-900">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                            @endif
                        </div>
                    </td>

                    <!-- Stock -->
                    <td>
                        <div class="flex items-center space-x-2">
                            <span class="text-lg font-semibold {{ $product->stock_quantity <= 0 ? 'text-red-600' : 'text-gray-900' }}">
                                {{ $product->stock_quantity }}
                            </span>
                            @if($product->stock_quantity <= 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Rupture
                                </span>
                            @elseif($product->stock_quantity <= 5)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    Faible
                                </span>
                            @endif
                        </div>
                    </td>

                    <!-- Statut -->
                    <td>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                            @if($product->status === 'active') bg-green-100 text-green-800
                            @elseif($product->status === 'inactive') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            @if($product->status === 'active') Actif
                            @elseif($product->status === 'inactive') Inactif
                            @else Brouillon @endif
                        </span>
                    </td>

                    <!-- Vedette -->
                    <td>
                        <form action="{{ route('admin.products.toggle-featured', $product) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="p-2 rounded-full transition-colors {{ $product->is_featured ? 'text-noorea-gold hover:text-yellow-600' : 'text-gray-400 hover:text-noorea-gold' }}"
                                    title="{{ $product->is_featured ? 'Retirer des vedettes' : 'Marquer comme vedette' }}">
                                <i class="fas fa-star"></i>
                            </button>
                        </form>
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.products.show', $product) }}" 
                               class="text-blue-600 hover:text-blue-800 transition-colors" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" 
                               class="text-noorea-gold hover:text-noorea-gold/80 transition-colors" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if(!$product->orderItems()->exists())
                                <button onclick="confirmDeleteProduct('{{ $product->id }}', '{{ $product->name }}')" 
                                        class="text-red-600 hover:text-red-800 transition-colors" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @else
                                <span class="text-gray-300" title="Impossible de supprimer (commandes associées)">
                                    <i class="fas fa-lock"></i>
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->appends(request()->query())->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
            <i class="fas fa-box text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun produit trouvé</h3>
        <p class="text-gray-500 mb-6">
            @if(request()->hasAny(['search', 'status', 'category_id', 'brand_id', 'featured', 'stock']))
                Aucun produit ne correspond à vos critères de recherche.
            @else
                Commencez par créer votre premier produit.
            @endif
        </p>
        @if(request()->hasAny(['search', 'status', 'category_id', 'brand_id', 'featured', 'stock']))
            <a href="{{ route('admin.products.index') }}" class="btn-admin-secondary mr-3">
                <i class="fas fa-times mr-2"></i>Effacer les filtres
            </a>
        @endif
        <a href="{{ route('admin.products.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>Créer un produit
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Gestion des filtres avancés
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggle-advanced-filters');
    const advancedFilters = document.getElementById('advanced-filters');
    const chevronIcon = document.getElementById('chevron-icon');
    
    // Vérifier si des filtres avancés sont déjà actifs pour les afficher
    const hasAdvancedFilters = {{ request()->hasAny(['brand_id', 'featured', 'stock']) ? 'true' : 'false' }};
    if (hasAdvancedFilters) {
        advancedFilters.classList.remove('hidden');
        chevronIcon.classList.add('rotate-180');
    }
    
    toggleButton.addEventListener('click', function() {
        if (advancedFilters.classList.contains('hidden')) {
            advancedFilters.classList.remove('hidden');
            chevronIcon.classList.add('rotate-180');
        } else {
            advancedFilters.classList.add('hidden');
            chevronIcon.classList.remove('rotate-180');
        }
    });
});

function confirmDeleteProduct(productId, productName) {
    confirmDelete(function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/products/${productId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }, `le produit "${productName}"`);
}
</script>
@endpush
