@extends('layouts.app')

@section('navbar')
<header class="absolute top-0 left-0 w-full z-50 backdrop-blur-md transition-all duration-300">
    <!-- Barre supérieure avec logo, recherche et icônes -->
    <div class="backdrop-blur-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Logo à gauche -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Noorea - L'élégance multiculturelle" class="h-14 md:h-16 w-auto">
                    </a>
                </div>
                
                <!-- Barre de recherche centrale -->
                <div class="flex-1 max-w-2xl mx-8">
                    <div class="relative">
                        <input 
                            type="search" 
                            placeholder="Rechercher des produits, marques, catégories..." 
                            class="w-full px-5 py-3 pl-12 pr-14 bg-white border-2 border-white/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-all duration-300 shadow-xl text-gray-800 placeholder-gray-500 font-medium"
                        >
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-search text-gray-600 text-xl"></i>
                        </div>
                        <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-noorea-gold hover:bg-yellow-600 text-white p-3 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                            <i class="fas fa-search text-lg"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Icônes à droite -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('account.dashboard') }}" class="navbar-icon-top" title="Mon compte">
                        <i class="fas fa-user text-xl"></i>
                    </a>
                    <a href="{{ route('wishlist') }}" class="navbar-icon-top relative" title="Ma wishlist">
                        <i class="fas fa-heart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">3</span>
                    </a>
                    <a href="{{ route('cart') }}" class="navbar-icon-top relative" title="Mon panier">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Barre de navigation inférieure -->
    <div class="backdrop-blur-sm border-t border-noorea-gold/20" style="background-color: #F7EAD5;">
        <div class="container mx-auto px-4">
            <nav class="hidden md:flex items-center justify-center py-3">
                <div class="flex space-x-8">
                    <a href="{{ route('home') }}" class="nav-link-gold {{ request()->routeIs('home') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                    <a href="{{ route('products') }}" class="nav-link-gold {{ request()->routeIs('products') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-shopping-bag mr-2"></i>Boutique
                    </a>
                    <a href="{{ route('categories') }}" class="nav-link-gold {{ request()->routeIs('categories') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-th-large mr-2"></i>Catégories
                    </a>
                    <a href="{{ route('brands') }}" class="nav-link-gold {{ request()->routeIs('brands*') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-crown mr-2"></i>Marques
                    </a>
                    <a href="{{ route('blog') }}" class="nav-link-gold {{ request()->routeIs('blog') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-globe mr-2"></i>Beauté du Monde
                    </a>
                    <a href="{{ route('about') }}" class="nav-link-gold {{ request()->routeIs('about') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>À propos
                    </a>
                </div>
            </nav>
        </div>
    </div>
</header>
@endsection

@section('content')
<!-- Fil d'Ariane -->
<section class="pt-32 pb-8 bg-noorea-cream/30">
    <div class="container mx-auto px-4">
        <nav class="text-sm breadcrumbs">
            <ol class="flex items-center space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-noorea-gold transition-colors">Accueil</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                <li><a href="{{ route('brands') }}" class="hover:text-noorea-gold transition-colors">Marques</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                <li class="text-gray-800 font-medium">{{ $brand->name }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- En-tête de la marque -->
<section class="py-16 bg-gradient-to-br from-noorea-cream/20 via-white to-noorea-cream/10 relative overflow-hidden">
    <!-- Éléments décoratifs -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-noorea-gold/10 rounded-full blur-xl"></div>
    <div class="absolute bottom-20 right-20 w-32 h-32 bg-noorea-rose-gold/10 rounded-full blur-xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <!-- Logo de la marque -->
            @if($brand->logo)
                <div class="w-32 h-32 mx-auto mb-6 rounded-2xl overflow-hidden border-4 border-noorea-gold/20 bg-white p-4">
                    <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="w-full h-full object-contain">
                </div>
            @else
                <div class="w-32 h-32 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-noorea-gold to-noorea-rose-gold flex items-center justify-center border-4 border-noorea-gold/20">
                    <i class="fas fa-crown text-4xl text-white"></i>
                </div>
            @endif
            
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-noorea-dark mb-6">
                {{ $brand->name }}
            </h1>
            
            @if($brand->description)
                <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-3xl mx-auto">
                    {{ $brand->description }}
                </p>
            @endif
            
            <!-- Statistiques de la marque -->
            <div class="flex items-center justify-center space-x-8 text-sm text-gray-500 mb-8">
                <div class="flex items-center">
                    <i class="fas fa-box mr-2 text-noorea-gold"></i>
                    {{ $products->total() }} {{ $products->total() > 1 ? 'produits' : 'produit' }}
                </div>
                @if($brand->country)
                    <div class="flex items-center">
                        <i class="fas fa-globe mr-2 text-noorea-gold"></i>
                        {{ $brand->country }}
                    </div>
                @endif
                @if($brand->founded_year)
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-2 text-noorea-gold"></i>
                        Depuis {{ $brand->founded_year }}
                    </div>
                @endif
            </div>
            
            <!-- Liens de la marque -->
            @if($brand->website || $brand->social_links)
                <div class="flex items-center justify-center space-x-4">
                    @if($brand->website)
                        <a href="{{ $brand->website }}" target="_blank" 
                           class="inline-flex items-center bg-noorea-gold hover:bg-yellow-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Site officiel
                        </a>
                    @endif
                    
                    @if($brand->social_links && is_array($brand->social_links))
                        @foreach($brand->social_links as $platform => $url)
                            <a href="{{ $url }}" target="_blank" 
                               class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 hover:bg-noorea-gold text-gray-600 hover:text-white rounded-lg transition-all duration-300">
                                @if($platform === 'facebook')
                                    <i class="fab fa-facebook-f"></i>
                                @elseif($platform === 'instagram')
                                    <i class="fab fa-instagram"></i>
                                @elseif($platform === 'twitter')
                                    <i class="fab fa-twitter"></i>
                                @else
                                    <i class="fas fa-link"></i>
                                @endif
                            </a>
                        @endforeach
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Informations supplémentaires sur la marque -->
@if($brand->history || $brand->values || $brand->achievements)
<section class="py-16 bg-white border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if($brand->history)
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-noorea-gold/10 flex items-center justify-center">
                            <i class="fas fa-history text-2xl text-noorea-gold"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-noorea-dark mb-4">Notre Histoire</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $brand->history }}</p>
                    </div>
                @endif
                
                @if($brand->values)
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-noorea-emerald/10 flex items-center justify-center">
                            <i class="fas fa-heart text-2xl text-noorea-emerald"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-noorea-dark mb-4">Nos Valeurs</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $brand->values }}</p>
                    </div>
                @endif
                
                @if($brand->achievements)
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-noorea-rose-gold/10 flex items-center justify-center">
                            <i class="fas fa-trophy text-2xl text-noorea-rose-gold"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-noorea-dark mb-4">Nos Réussites</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $brand->achievements }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Filtres et tri -->
<section class="py-8 bg-noorea-cream/20 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <!-- Résultats -->
            <div class="text-gray-600">
                <span class="font-medium">{{ $products->total() }}</span> 
                {{ $products->total() > 1 ? 'produits trouvés' : 'produit trouvé' }} pour la marque
                <span class="font-semibold text-noorea-gold">{{ $brand->name }}</span>
            </div>
            
            <!-- Filtres et tri -->
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <!-- Tri -->
                <select id="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold">
                    <option value="name_asc">Nom (A-Z)</option>
                    <option value="name_desc">Nom (Z-A)</option>
                    <option value="price_asc">Prix croissant</option>
                    <option value="price_desc">Prix décroissant</option>
                    <option value="newest">Plus récents</option>
                    <option value="popular">Plus populaires</option>
                </select>
                
                <!-- Vue -->
                <div class="flex items-center space-x-2">
                    <button onclick="setGridView(4)" id="grid-4" class="p-2 border border-gray-300 rounded hover:bg-noorea-gold hover:text-white hover:border-noorea-gold transition-colors">
                        <i class="fas fa-th"></i>
                    </button>
                    <button onclick="setGridView(3)" id="grid-3" class="p-2 border border-gray-300 rounded hover:bg-noorea-gold hover:text-white hover:border-noorea-gold transition-colors active">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button onclick="setGridView(2)" id="grid-2" class="p-2 border border-gray-300 rounded hover:bg-noorea-gold hover:text-white hover:border-noorea-gold transition-colors">
                        <i class="fas fa-th-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Grille des produits -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        @if($products->count() > 0)
            <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/5">
                        <!-- Image -->
                        <div class="relative h-64 overflow-hidden">
                            <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-full">
                                @if($product->main_image)
                                    <img src="{{ asset('storage/' . $product->main_image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-noorea-cream to-noorea-rose-gold flex items-center justify-center">
                                        <i class="fas fa-image text-4xl text-white/70"></i>
                                    </div>
                                @endif
                            </a>
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 space-y-2">
                                @if($product->is_featured)
                                    <div class="bg-noorea-gold text-white px-3 py-1 rounded-full text-xs font-medium flex items-center">
                                        <i class="fas fa-star mr-1"></i> Coup de Cœur
                                    </div>
                                @endif
                                @if($product->is_on_sale)
                                    <div class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                        -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                    </div>
                                @endif
                                @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
                                    <div class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                        Stock limité
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Actions rapides -->
                            <div class="absolute top-3 right-3 flex flex-col space-y-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button onclick="toggleWishlist({{ $product->id }})" class="w-10 h-10 bg-white/90 hover:bg-white text-gray-600 hover:text-red-500 rounded-full flex items-center justify-center transition-colors shadow-lg">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button onclick="quickView({{ $product->id }})" class="w-10 h-10 bg-white/90 hover:bg-white text-gray-600 hover:text-noorea-gold rounded-full flex items-center justify-center transition-colors shadow-lg">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Contenu -->
                        <div class="p-6">
                            <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block">
                                <h3 class="text-lg font-semibold text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300 leading-tight">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            
                            @if($product->category)
                                <p class="text-sm text-gray-500 font-medium mb-3">
                                    {{ $product->category->name }}
                                </p>
                            @endif
                            
                            @if($product->short_description)
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                    {{ Str::limit($product->short_description, 100) }}
                                </p>
                            @endif
                            
                            <!-- Prix -->
                            <div class="flex items-center justify-between mb-4">
                                @if($product->is_on_sale)
                                    <div class="space-x-2">
                                        <span class="text-lg font-bold text-noorea-gold">
                                            {{ number_format($product->sale_price, 0, ',', ' ') }} FCFA
                                        </span>
                                        <span class="text-sm text-gray-500 line-through">
                                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                        </span>
                                    </div>
                                @else
                                    <span class="text-lg font-bold text-noorea-gold">
                                        {{ $product->formatted_price }}
                                    </span>
                                @endif
                                
                                <!-- Stock -->
                                <div class="text-xs">
                                    @if($product->stock_quantity > 10)
                                        <span class="text-green-600">En stock</span>
                                    @elseif($product->stock_quantity > 0)
                                        <span class="text-orange-600">{{ $product->stock_quantity }} restants</span>
                                    @else
                                        <span class="text-red-600">Rupture</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex space-x-2">
                                @if($product->stock_quantity > 0)
                                    <button onclick="addToCart({{ $product->id }})" class="flex-1 bg-noorea-gold hover:bg-yellow-600 text-white text-sm font-medium px-4 py-3 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                                        <i class="fas fa-shopping-bag mr-2"></i>
                                        Ajouter
                                    </button>
                                @else
                                    <button disabled class="flex-1 bg-gray-300 text-gray-500 text-sm font-medium px-4 py-3 rounded-lg cursor-not-allowed">
                                        Rupture de stock
                                    </button>
                                @endif
                                
                                <a href="{{ route('products.show', $product->slug ?? $product->id) }}" 
                                   class="px-4 py-3 border-2 border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white text-sm font-medium rounded-lg transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-16">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <!-- Aucun produit -->
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-noorea-cream to-noorea-rose-gold flex items-center justify-center">
                    <i class="fas fa-crown text-4xl text-white/70"></i>
                </div>
                <h3 class="text-2xl font-semibold text-noorea-dark mb-4">Aucun produit pour cette marque</h3>
                <p class="text-gray-600 mb-8">La marque "{{ $brand->name }}" ne propose pas encore de produits.</p>
                <a href="{{ route('brands') }}" class="inline-flex items-center bg-noorea-gold hover:bg-yellow-600 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 mr-4">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Voir les marques
                </a>
                <a href="{{ route('products') }}" class="inline-flex items-center border-2 border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300">
                    Découvrir la boutique
                </a>
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .navbar-icon-top {
        @apply w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 text-white flex items-center justify-center transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .active {
        @apply bg-noorea-gold text-white border-noorea-gold;
    }
</style>
@endpush

@push('scripts')
<script>
    // Gestion de la vue en grille
    function setGridView(columns) {
        const grid = document.getElementById('products-grid');
        const buttons = document.querySelectorAll('[id^="grid-"]');
        
        // Retirer la classe active de tous les boutons
        buttons.forEach(btn => btn.classList.remove('active'));
        
        // Ajouter la classe active au bouton cliqué
        document.getElementById('grid-' + columns).classList.add('active');
        
        // Changer les classes de la grille
        grid.className = grid.className.replace(/lg:grid-cols-\d+/, 'lg:grid-cols-' + columns);
    }
    
    // Ajouter au panier
    function addToCart(productId) {
        console.log('Ajouter au panier:', productId);
        alert('Produit ajouté au panier !');
    }
    
    // Toggle wishlist
    function toggleWishlist(productId) {
        console.log('Toggle wishlist:', productId);
        alert('Ajouté à votre wishlist !');
    }
    
    // Vue rapide
    function quickView(productId) {
        console.log('Vue rapide:', productId);
        alert('Vue rapide du produit (à implémenter)');
    }
    
    // Tri des produits
    document.getElementById('sort').addEventListener('change', function() {
        const sortValue = this.value;
        console.log('Tri par:', sortValue);
    });
</script>
@endpush
@endsection
