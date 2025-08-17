@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Catégorie: ' . $category->name;
    $breadcrumb = [
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Catégories', 'url' => route('admin.categories.index')],
        ['title' => $category->name]
    ];
@endphp

@section('page_actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('admin.categories.edit', $category) }}" class="btn-admin-primary">
        <i class="fas fa-edit mr-2"></i>
        Modifier
    </a>
    <form action="{{ route('admin.categories.toggle-status', $category) }}" method="POST" class="inline">
        @csrf
        @if($category->is_active)
            <button type="submit" class="btn-admin-secondary">
                <i class="fas fa-eye-slash mr-2"></i>
                Désactiver
            </button>
        @else
            <button type="submit" class="btn-admin-primary">
                <i class="fas fa-eye mr-2"></i>
                Activer
            </button>
        @endif
    </form>
    <a href="{{ route('admin.categories.index') }}" class="btn-admin-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>
@endsection

<!-- En-tête de la catégorie -->
<div class="admin-card mb-8">
    <div class="flex items-start space-x-6">
        <!-- Image de la catégorie -->
        <div class="w-32 h-32 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
            @if($category->image)
                @if(filter_var($category->image, FILTER_VALIDATE_URL))
                    <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                @endif
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    <i class="fas fa-image text-4xl"></i>
                </div>
            @endif
        </div>

        <!-- Informations principales -->
        <div class="flex-1">
            <div class="flex items-center space-x-3 mb-4">
                <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
                <span class="status-badge {{ $category->is_active ? 'active' : 'inactive' }}">
                    @if($category->is_active)
                        <i class="fas fa-check mr-1"></i>Active
                    @else
                        <i class="fas fa-times mr-1"></i>Inactive
                    @endif
                </span>
                @if($category->parent)
                    <span class="status-badge info">
                        <i class="fas fa-level-up-alt mr-1"></i>{{ $category->parent->name }}
                    </span>
                @endif
            </div>

            @if($category->description)
                <p class="text-gray-600 mb-4">{{ $category->description }}</p>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Slug:</span>
                    <p class="font-medium text-gray-900">{{ $category->slug }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Ordre:</span>
                    <p class="font-medium text-gray-900">{{ $category->sort_order }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Créée le:</span>
                    <p class="font-medium text-gray-900">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Modifiée le:</span>
                    <p class="font-medium text-gray-900">{{ $category->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stats-card primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Produits Actifs</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_products'] }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </div>

    <div class="stats-card info">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Sous-catégories</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['subcategories_count'] }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-sitemap"></i>
            </div>
        </div>
    </div>

    <div class="stats-card success">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Valeur Totale</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ number_format($stats['total_value'], 0, ',', ' ') }} CFA</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>

    <div class="stats-card warning">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Prix Moyen</p>
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ number_format($stats['avg_price'], 0, ',', ' ') }} CFA</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-calculator"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Contenu principal -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Sous-catégories -->
        @if($category->subcategories->count() > 0)
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-sitemap text-noorea-gold mr-2"></i>
                    Sous-catégories ({{ $category->subcategories->count() }})
                </h3>
                <a href="{{ route('admin.categories.create') }}?parent_id={{ $category->id }}" class="btn-admin-primary text-sm px-3 py-1">
                    <i class="fas fa-plus mr-1"></i>Ajouter
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($category->subcategories as $subcategory)
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-medium text-gray-900">{{ $subcategory->name }}</h4>
                        <span class="status-badge {{ $subcategory->is_active ? 'active' : 'inactive' }}">
                            {{ $subcategory->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    @if($subcategory->description)
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($subcategory->description, 80) }}</p>
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">{{ $subcategory->products->count() }} produit(s)</span>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.categories.show', $subcategory) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.categories.edit', $subcategory) }}" class="text-noorea-gold hover:text-noorea-gold/80">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Produits récents -->
        @if($category->products->count() > 0)
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-box text-noorea-gold mr-2"></i>
                    Produits récents
                </h3>
                <a href="{{ route('admin.products.index') }}?category_id={{ $category->id }}" class="btn-admin-secondary text-sm px-3 py-1">
                    Voir tous ({{ $stats['total_products'] }})
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($category->products as $product)
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                            @if($product->main_image)
                                <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-gray-900 truncate">{{ $product->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $product->brand->name ?? 'N/A' }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="font-semibold text-noorea-gold">{{ $product->formatted_price }}</span>
                                <div class="flex items-center space-x-2">
                                    <span class="status-badge {{ $product->status }}">
                                        {{ $product->status === 'active' ? 'Actif' : 'Inactif' }}
                                    </span>
                                    @if($product->stock_quantity <= 5)
                                        <span class="status-badge danger">Stock faible</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs text-gray-500">Stock: {{ $product->stock_quantity }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.products.show', $product) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-noorea-gold hover:text-noorea-gold/80">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="admin-card">
            <div class="text-center py-12">
                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-box text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun produit</h3>
                <p class="text-gray-500 mb-6">Cette catégorie ne contient aucun produit pour le moment.</p>
                <a href="{{ route('admin.products.create') }}?category_id={{ $category->id }}" class="btn-admin-primary">
                    <i class="fas fa-plus mr-2"></i>Ajouter un produit
                </a>
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Actions rapides -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-bolt text-noorea-gold mr-2"></i>
                    Actions rapides
                </h3>
            </div>

            <div class="space-y-3">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn-admin-primary w-full">
                    <i class="fas fa-edit mr-2"></i>Modifier la catégorie
                </a>
                <a href="{{ route('admin.products.create') }}?category_id={{ $category->id }}" class="btn-admin-secondary w-full">
                    <i class="fas fa-plus mr-2"></i>Ajouter un produit
                </a>
                @if(!$category->parent_id)
                <a href="{{ route('admin.categories.create') }}?parent_id={{ $category->id }}" class="btn-admin-secondary w-full">
                    <i class="fas fa-sitemap mr-2"></i>Créer sous-catégorie
                </a>
                @endif
            </div>
        </div>

        <!-- Informations SEO -->
        @if($category->meta_title || $category->meta_description)
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-search text-green-500 mr-2"></i>
                    Informations SEO
                </h3>
            </div>

            <div class="space-y-4">
                @if($category->meta_title)
                <div>
                    <label class="text-sm font-medium text-gray-700">Meta Title</label>
                    <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded mt-1">{{ $category->meta_title }}</p>
                </div>
                @endif
                
                @if($category->meta_description)
                <div>
                    <label class="text-sm font-medium text-gray-700">Meta Description</label>
                    <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded mt-1">{{ $category->meta_description }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Hiérarchie -->
        @if($category->parent || $category->subcategories->count() > 0)
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-tree text-green-500 mr-2"></i>
                    Hiérarchie
                </h3>
            </div>

            <div class="space-y-3">
                @if($category->parent)
                <div>
                    <label class="text-sm font-medium text-gray-700">Catégorie parente</label>
                    <div class="mt-1">
                        <a href="{{ route('admin.categories.show', $category->parent) }}" 
                           class="inline-flex items-center px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm font-medium text-gray-900 transition-colors">
                            <i class="fas fa-level-up-alt mr-2"></i>{{ $category->parent->name }}
                        </a>
                    </div>
                </div>
                @endif

                @if($category->subcategories->count() > 0)
                <div>
                    <label class="text-sm font-medium text-gray-700">Sous-catégories ({{ $category->subcategories->count() }})</label>
                    <div class="mt-2 space-y-1">
                        @foreach($category->subcategories->take(5) as $subcategory)
                        <a href="{{ route('admin.categories.show', $subcategory) }}" 
                           class="block px-3 py-1 bg-gray-50 hover:bg-gray-100 rounded text-sm text-gray-900 transition-colors">
                            {{ $subcategory->name }}
                        </a>
                        @endforeach
                        @if($category->subcategories->count() > 5)
                        <p class="text-xs text-gray-500 px-3 py-1">
                            et {{ $category->subcategories->count() - 5 }} autre(s)...
                        </p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Zone de danger -->
        @if($stats['total_products'] === 0 && $stats['subcategories_count'] === 0)
        <div class="admin-card border-red-200">
            <div class="admin-card-header">
                <h3 class="admin-card-title text-red-600">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    Zone de danger
                </h3>
            </div>

            <div class="space-y-3">
                <p class="text-sm text-gray-600">
                    Cette catégorie ne contient aucun produit ni sous-catégorie et peut être supprimée.
                </p>
                <form id="deleteForm" action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDeleteCategory()" class="btn-admin-danger w-full">
                        <i class="fas fa-trash mr-2"></i>Supprimer la catégorie
                    </button>
                </form>
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
function confirmDeleteCategory() {
    confirmDelete(function() {
        document.getElementById('deleteForm').submit();
    }, 'la catégorie "{{ $category->name }}"');
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
</script>
@endpush
