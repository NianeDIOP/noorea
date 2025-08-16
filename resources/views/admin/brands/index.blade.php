@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Gestion des Marques';
    $breadcrumb = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Marques']
    ];
@endphp

@section('page_actions')
<div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
    <div class="flex items-center space-x-2">
        <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-tags text-noorea-gold mr-2"></i>
            <span class="font-medium text-gray-700">{{ $brands->total() }} marque(s)</span>
        </div>
        @if(request()->hasAny(['search', 'status', 'featured', 'country']))
        <div class="flex items-center bg-blue-50 text-blue-700 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-filter mr-2"></i>
            <span class="font-medium">Filtres actifs</span>
        </div>
        @endif
    </div>
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.brands.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>
            Nouvelle Marque
        </a>
    </div>
</div>
@endsection

<!-- Statistiques rapides -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stats-card primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Marques</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $brands->total() }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-tags"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card success">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Actives</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $brands->where('is_active', true)->count() }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card warning">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Vedettes</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $brands->where('is_featured', true)->count() }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card info">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Avec Produits</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $brands->where('products_count', '>', 0)->count() }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-box"></i>
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
        @if(request()->hasAny(['search', 'status', 'featured', 'country']))
        <div class="flex items-center space-x-2">
            <span class="text-sm text-blue-600 bg-blue-50 px-3 py-1 rounded-lg">
                {{ collect(request()->only(['search', 'status', 'featured', 'country']))->filter()->count() }} filtre(s) actif(s)
            </span>
            <a href="{{ route('admin.brands.index') }}" class="btn-admin-secondary text-sm">
                <i class="fas fa-times mr-2"></i>Réinitialiser
            </a>
        </div>
        @endif
    </div>
    
    <form method="GET" action="{{ route('admin.brands.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                       placeholder="Nom, description..."
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
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actives</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactives</option>
            </select>
        </div>

        <!-- Actions -->
        <div class="admin-form-group flex items-end">
            <div class="flex space-x-2 w-full">
                <button type="submit" class="btn-admin-primary flex-1">
                    <i class="fas fa-search mr-2"></i>Rechercher
                </button>
                @if(request()->hasAny(['search', 'status', 'featured', 'country']))
                    <a href="{{ route('admin.brands.index') }}" class="btn-admin-secondary px-3" title="Réinitialiser les filtres">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

<!-- Liste des marques -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">
            <i class="fas fa-list text-noorea-gold mr-2"></i>
            Liste des Marques
        </h3>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-500">
                {{ $brands->firstItem() ?? 0 }}-{{ $brands->lastItem() ?? 0 }} sur {{ $brands->total() }}
            </span>
            @if($brands->hasPages())
            <div class="flex items-center space-x-1 text-sm text-gray-500">
                <i class="fas fa-file-alt"></i>
                <span>Page {{ $brands->currentPage() }} sur {{ $brands->lastPage() }}</span>
            </div>
            @endif
        </div>
    </div>

    @if($brands->count() > 0)
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nom</th>
                    <th>Pays</th>
                    <th>Produits</th>
                    <th>Vedette</th>
                    <th>Statut</th>
                    <th>Créée le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <!-- Logo -->
                    <td>
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center border">
                            @if($brand->logo)
                                <img src="{{ $brand->logo_url }}" 
                                     alt="{{ $brand->name }}" 
                                     class="w-full h-full object-contain"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full flex items-center justify-center" style="display: none;">
                                    <i class="fas fa-tags text-gray-400"></i>
                                </div>
                            @else
                                <i class="fas fa-tags text-gray-400"></i>
                            @endif
                        </div>
                    </td>

                    <!-- Nom -->
                    <td>
                        <div class="flex flex-col">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-gray-900">{{ $brand->name }}</span>
                                @if($brand->is_local)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-home mr-1"></i>Local
                                    </span>
                                @endif
                            </div>
                            @if($brand->description)
                                <span class="text-sm text-gray-500">{{ Str::limit($brand->description, 40) }}</span>
                            @endif
                            @if($brand->website)
                                <a href="{{ $brand->website }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-external-link-alt mr-1"></i>{{ parse_url($brand->website, PHP_URL_HOST) }}
                                </a>
                            @endif
                        </div>
                    </td>

                    <!-- Pays -->
                    <td>
                        @if($brand->country)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-globe mr-1"></i>{{ $brand->country }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <!-- Produits -->
                    <td>
                        <div class="flex items-center space-x-2">
                            <span class="text-lg font-semibold text-gray-900">{{ $brand->products_count }}</span>
                            @if($brand->products_count > 0)
                                <a href="{{ route('admin.brands.show', $brand) }}" class="text-noorea-gold hover:text-noorea-gold/80">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endif
                        </div>
                    </td>

                    <!-- Vedette -->
                    <td>
                        <form action="{{ route('admin.brands.toggle-featured', $brand) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="p-2 rounded-full transition-colors {{ $brand->is_featured ? 'text-noorea-gold hover:text-yellow-600' : 'text-gray-400 hover:text-noorea-gold' }}"
                                    title="{{ $brand->is_featured ? 'Retirer des vedettes' : 'Marquer comme vedette' }}">
                                <i class="fas fa-star"></i>
                            </button>
                        </form>
                    </td>

                    <!-- Statut -->
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.brands.toggle-status', $brand) }}" method="POST" class="inline">
                            @csrf
                            <label class="admin-toggle" title="{{ $brand->is_active ? 'Désactiver' : 'Activer' }} cette marque">
                                <input type="checkbox" {{ $brand->is_active ? 'checked' : '' }} 
                                       onchange="confirmToggleStatusInline(this, '{{ $brand->is_active ? "désactiver" : "activer" }}', '{{ $brand->name }}')">
                                <span class="toggle-slider"></span>
                                <span class="status-label {{ $brand->is_active ? 'active' : 'inactive' }}">
                                    {{ $brand->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </label>
                        </form>
                    </td>

                    <!-- Date -->
                    <td>
                        <div class="text-sm text-gray-900">{{ $brand->created_at->format('d/m/Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $brand->created_at->format('H:i') }}</div>
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.brands.show', $brand) }}" 
                               class="text-blue-600 hover:text-blue-800 transition-colors" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.brands.edit', $brand) }}" 
                               class="text-noorea-gold hover:text-noorea-gold/80 transition-colors" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($brand->products_count === 0)
                                <button onclick="confirmDeleteBrand('{{ $brand->id }}', '{{ $brand->name }}')" 
                                        class="text-red-600 hover:text-red-800 transition-colors" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @else
                                <span class="text-gray-300" title="Impossible de supprimer (contient {{ $brand->products_count }} produit(s))">
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
        {{ $brands->appends(request()->query())->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
            <i class="fas fa-tags text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune marque trouvée</h3>
        <p class="text-gray-500 mb-6">
            @if(request()->hasAny(['search', 'status', 'featured', 'country']))
                Aucune marque ne correspond à vos critères de recherche.
            @else
                Commencez par créer votre première marque.
            @endif
        </p>
        @if(request()->hasAny(['search', 'status', 'featured', 'country']))
            <a href="{{ route('admin.brands.index') }}" class="btn-admin-secondary mr-3">
                <i class="fas fa-times mr-2"></i>Effacer les filtres
            </a>
        @endif
        <a href="{{ route('admin.brands.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>Créer une marque
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDeleteBrand(brandId, brandName) {
    confirmDelete(function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/brands/${brandId}`;
        
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
    }, `la marque "${brandName}"`);
}

function confirmToggleStatus(button, action, brandName) {
    confirmToggle(function() {
        button.closest('form').submit();
    }, `${action} la marque "${brandName}"`);
}

function confirmToggleStatusInline(checkbox, action, brandName) {
    // Remettre le checkbox à son état précédent temporairement
    checkbox.checked = !checkbox.checked;
    
    confirmToggle(function() {
        // Remettre le bon état et soumettre
        checkbox.checked = !checkbox.checked;
        checkbox.closest('form').submit();
    }, `${action} la marque "${brandName}"`);
}
</script>
@endpush
