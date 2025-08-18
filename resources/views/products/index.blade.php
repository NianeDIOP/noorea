@extends('layouts.app')

@push('head')
<!-- Meta tags et polices d'origine -->
@endpush

@section('navbar')
<!-- Navbar Supérieur -->
<header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <!-- Barre supérieure avec logo, recherche et icônes -->
    <div class="bg-white shadow-lg border-b border-gray-100">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Logo à gauche -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Noorea - L'élégance multiculturelle" class="h-14 md:h-16 w-auto">
                    </a>
                </div>
                
                <!-- Barre de recherche centrale - Desktop uniquement -->
                <div class="desktop-search flex-1 max-w-2xl mx-8">
                    <div class="relative">
                        <input 
                            type="search" 
                            placeholder="Rechercher des produits, marques, catégories..." 
                            class="w-full px-5 py-3 pl-12 pr-14 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-all duration-300 shadow-lg text-gray-800 placeholder-gray-500 font-medium"
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
                    <!-- Recherche mobile uniquement - MASQUÉE sur desktop -->
                    <button type="button" class="navbar-icon-top mobile-only" id="mobile-search-button" title="Rechercher">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                    
                    <!-- Compte utilisateur / Connexion - Desktop uniquement -->
                    <div class="desktop-auth items-center space-x-4">
                        @auth
                            <!-- Utilisateur connecté -->
                            <div class="relative group">
                                <a href="{{ route('account.dashboard') }}" class="navbar-icon-top" title="Mon compte">
                                    <i class="fas fa-user text-xl"></i>
                                </a>
                                <!-- Menu déroulant -->
                                <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                    <div class="py-2">
                                        <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                            <i class="fas fa-user mr-2"></i>Mon compte
                                        </a>
                                        <a href="{{ route('wishlist') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                            <i class="fas fa-heart mr-2"></i>Ma wishlist
                                        </a>
                                        <hr class="my-1">
                                        <form method="POST" action="{{ route('logout') }}" class="block">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Wishlist -->
                            <a href="{{ route('wishlist') }}" class="navbar-icon-top relative" title="Ma wishlist">
                                <i class="fas fa-heart text-xl"></i>
                                <span class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">3</span>
                            </a>
                        @else
                            <!-- Utilisateur non connecté -->
                            <a href="{{ route('login') }}" class="navbar-icon-top" title="Se connecter">
                                <i class="fas fa-sign-in-alt text-xl"></i>
                            </a>
                            
                            <a href="{{ route('register') }}" class="navbar-icon-top" title="S'inscrire">
                                <i class="fas fa-user-plus text-xl"></i>
                            </a>
                        @endauth
                    </div>
                    
                    <!-- Panier - Toujours visible -->
                    <button id="navbar-cart-button" type="button" class="navbar-icon-top relative" title="Mon panier">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">0</span>
                    </button>
                    
                    <!-- Menu mobile toggle - MASQUÉ sur desktop -->
                    <button type="button" class="navbar-icon-top mobile-only" id="mobile-menu-button" aria-label="Menu">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Barre de navigation inférieure -->
    <div class="border-t border-noorea-gold/20" style="background-color: #F7EAD5;">
        <div class="container mx-auto px-4">
            <!-- Navigation principale - desktop -->
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
                    <a href="{{ route('brands') }}" class="nav-link-gold {{ request()->routeIs('brands') ? 'active-gold' : '' }} flex items-center">
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
            
            <!-- Menu mobile -->
            <div class="hidden" id="mobile-menu">
                <nav class="flex flex-col space-y-1 p-4 bg-white border-t border-gray-200 shadow-lg">
                    <a href="{{ route('home') }}" class="nav-link-gold {{ request()->routeIs('home') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-home mr-3 w-5"></i>Accueil
                    </a>
                    <a href="{{ route('products') }}" class="nav-link-gold {{ request()->routeIs('products') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-shopping-bag mr-3 w-5"></i>Boutique
                    </a>
                    <a href="{{ route('categories') }}" class="nav-link-gold {{ request()->routeIs('categories') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-th-large mr-3 w-5"></i>Catégories
                    </a>
                    <a href="{{ route('brands') }}" class="nav-link-gold {{ request()->routeIs('brands') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-crown mr-3 w-5"></i>Marques
                    </a>
                    <a href="{{ route('blog') }}" class="nav-link-gold {{ request()->routeIs('blog') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-globe mr-3 w-5"></i>Beauté du Monde
                    </a>
                    <a href="{{ route('about') }}" class="nav-link-gold {{ request()->routeIs('about') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-info-circle mr-3 w-5"></i>À propos
                    </a>
                    
                    <!-- Séparateur -->
                    <hr class="my-3 border-gray-200">
                    
                    <!-- Liens d'authentification en mobile -->
                    @guest
                        <a href="{{ route('login') }}" class="nav-link-gold flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-sign-in-alt mr-3 w-5"></i>Se connecter
                        </a>
                        <a href="{{ route('register') }}" class="nav-link-gold flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-user-plus mr-3 w-5"></i>S'inscrire
                        </a>
                    @endguest
                </nav>
            </div>
        </div>
    </div>
</header>
@endsection

<!-- Barre de recherche mobile -->
<div class="mobile-search-bar md:hidden" id="mobile-search-bar">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center space-x-3">
            <button type="button" id="close-mobile-search" class="flex-shrink-0">
                <i class="fas fa-arrow-left text-2xl text-gray-700"></i>
            </button>
            <div class="flex-1">
                <div class="relative">
                    <input 
                        type="search" 
                        placeholder="Rechercher des produits..." 
                        class="w-full px-4 py-3 pl-12 pr-4 bg-white border-2 border-noorea-gold rounded-xl focus:outline-none focus:ring-2 focus:ring-noorea-gold text-gray-800 placeholder-gray-500"
                        id="mobile-search-input"
                    >
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('content')
<!-- Espacement après navbar pour desktop -->
<div class="hidden md:block h-8"></div>

<!-- Hero Section SUPPRIMÉ - Transition directe vers contenu -->

<!-- Section des résultats organisée par catégories -->
<section class="pt-32 md:pt-36 py-6 md:py-12 relative overflow-hidden" style="background-color: #F7EAD5;">
    <!-- Éléments décoratifs comme welcome -->
    <div class="absolute top-20 right-10 w-24 h-24 bg-noorea-rose-gold/10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-10 left-20 w-32 h-32 bg-noorea-gold/10 rounded-full blur-2xl"></div>
    
    <div class="container mx-auto px-4 md:px-6 relative z-10">
        <!-- Filtres et statistiques -->
        <div class="mb-8 md:mb-12">
            <!-- En-tête avec filtres -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-6 lg:space-y-0 mb-6">
                <!-- Statistiques résultats -->
                <div class="text-center lg:text-left">
                    <h2 class="text-4xl font-serif font-light text-noorea-dark mb-4 tracking-wide">
                        Notre <span class="text-noorea-rose-gold font-medium">Boutique</span>
                    </h2>
                    <div class="flex items-center justify-center lg:justify-start mb-4">
                        <div class="h-px bg-noorea-gold/30 w-20"></div>
                        <i class="fas fa-shopping-bag text-noorea-rose-gold text-lg mx-4"></i>
                        <div class="h-px bg-noorea-gold/30 w-20"></div>
                    </div>
                    <p class="text-noorea-dark/70 text-lg">
                        <span id="count-number" class="font-medium text-noorea-gold">{{ $products->count() }}</span> 
                        {{ $products->count() > 1 ? 'produits disponibles' : 'produit disponible' }}
                    </p>
                </div>
                
                <!-- Filtres rapides - VISIBLES sur desktop -->
                <div class="flex flex-wrap justify-center lg:justify-end gap-3 lg:w-auto w-full">
                    <select id="category-filter" class="bg-white border-2 border-noorea-gold/30 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-noorea-gold min-w-[140px]">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    
                    <select id="brand-filter" class="bg-white border-2 border-noorea-gold/30 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-noorea-gold min-w-[140px]">
                        <option value="">Toutes les marques</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->slug }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    
                    <select id="price-filter" class="bg-white border-2 border-noorea-gold/30 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-noorea-gold min-w-[120px]">
                        <option value="">Tous les prix</option>
                        <option value="0-15000">0 - 15 000 CFA</option>
                        <option value="15000-30000">15 000 - 30 000 CFA</option>
                        <option value="30000-60000">30 000 - 60 000 CFA</option>
                        <option value="60000+">60 000 CFA et plus</option>
                    </select>
                    
                    <button id="apply-filters" class="bg-noorea-gold hover:bg-noorea-gold/90 text-white px-6 py-2 rounded-xl font-medium transition-all duration-300 hover:scale-105 shadow-lg">
                        <i class="fas fa-filter mr-2"></i>Filtrer
                    </button>
                </div>
            </div>
        </div>

        <!-- Produits organisés par catégories -->
        @if($categories->isNotEmpty())
            @foreach($categories as $category)
                @php
                    $categoryProducts = $products->where('category_id', $category->id);
                @endphp
                
                @if($categoryProducts->isNotEmpty())
                    <!-- Section catégorie -->
                    <div class="category-section mb-8 md:mb-12" data-category-slug="{{ $category->slug }}">
                        <!-- Titre de catégorie harmonisé avec welcome -->
                        <div class="text-center mb-6 md:mb-8">
                            <h3 class="text-3xl md:text-4xl font-serif font-light text-noorea-dark mb-3 tracking-wide">
                                {{ $category->name }}
                                <span class="text-noorea-rose-gold font-medium text-lg ml-2">
                                    ({{ $categoryProducts->count() }})
                                </span>
                            </h3>
                            <div class="flex items-center justify-center mb-4">
                                <div class="h-px bg-noorea-gold/30 w-20"></div>
                                <i class="fas fa-{{ $category->icon ?? 'star' }} text-noorea-rose-gold text-lg mx-4"></i>
                                <div class="h-px bg-noorea-gold/30 w-20"></div>
                            </div>
                        </div>

                        <!-- Grille responsive des produits -->
                        <!-- Mobile: Cartes empilées verticalement -->
                        <div class="md:hidden space-y-4">
                            @foreach($categoryProducts as $product)
                                <div class="product-card-mobile bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300" 
                                     data-category="{{ $product->category ? $product->category->slug : '' }}" 
                                     data-brand="{{ $product->brand ? $product->brand->slug : '' }}"
                                     data-price="{{ $product->final_price }}">
                                    
                                    <div class="flex">
                                        <!-- Image produit mobile -->
                                        <div class="flex-shrink-0 w-24 h-24 relative">
                                            <img src="{{ $product->main_image ?? 'https://via.placeholder.com/200x200?text=Noorea+Beauty' }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="w-full h-full object-cover">
                                            
                                            @if($product->category)
                                            <div class="absolute top-1 left-1">
                                                <span class="inline-block px-1.5 py-0.5 bg-noorea-gold/90 text-white text-xs font-medium rounded">
                                                    {{ substr($product->category->name, 0, 6) }}
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Contenu mobile -->
                                        <div class="flex-1 p-3 flex flex-col justify-between">
                                            <div>
                                                <!-- Marque -->
                                                <p class="text-xs text-gray-500 mb-1 font-medium">
                                                    {{ $product->brand ? $product->brand->name : 'Marque' }}
                                                </p>
                                                
                                                <!-- Nom -->
                                                <h4 class="text-sm font-bold text-noorea-brown mb-1 line-clamp-2">
                                                    {{ $product->name }}
                                                </h4>
                                                
                                                <!-- Prix -->
                                                <div class="flex items-center justify-between">
                                                    <div class="text-base font-bold text-noorea-gold">
                                                        {{ number_format($product->final_price, 0, ',', '.') }} FCFA
                                                    </div>
                                                    @if($product->is_on_sale)
                                                        <div class="text-xs text-gray-400 line-through">
                                                            {{ number_format($product->price, 0, ',', '.') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Actions mobile - Version améliorée -->
                                        <div class="flex-shrink-0 w-20 p-2 flex flex-col justify-center space-y-2">
                                            <!-- Wishlist -->
                                            <button class="p-2 bg-gray-100 rounded-lg hover:bg-noorea-gold/10 transition-colors" 
                                                    onclick="event.stopPropagation();" 
                                                    title="Ajouter aux favoris">
                                                <i class="fas fa-heart text-gray-400 hover:text-noorea-gold text-sm"></i>
                                            </button>
                                            
                                            <!-- Voir le produit -->
                                            <a href="{{ route('products.show', $product->slug) }}" 
                                               class="p-2 bg-noorea-gold/20 rounded-lg hover:bg-noorea-gold/30 transition-colors"
                                               title="Voir le produit">
                                                <i class="fas fa-eye text-noorea-gold text-sm"></i>
                                            </a>
                                            
                                            <!-- Ajouter au panier - ICÔNE MOBILE -->
                                            <button class="add-to-cart-btn p-2 bg-noorea-brown rounded-lg hover:bg-noorea-dark transition-colors"
                                                    data-product-id="{{ $product->id }}"
                                                    data-product-name="{{ $product->name }}"
                                                    data-product-price="{{ $product->final_price }}"
                                                    data-product-image="{{ $product->main_image ?? asset('images/logo.png') }}"
                                                    onclick="event.stopPropagation();" 
                                                    title="Ajouter au panier">
                                                <i class="fas fa-shopping-cart text-white text-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Plus de bouton texte - utilisation de l'icône uniquement -->
                                </div>
                            @endforeach
                        </div>

                        <!-- Desktop: Grille traditionnelle -->
                        <div class="hidden md:grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 lg:gap-6">
                            @foreach($categoryProducts as $product)
                                <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 group" 
                                     data-category="{{ $product->category ? $product->category->slug : '' }}" 
                                     data-brand="{{ $product->brand ? $product->brand->slug : '' }}"
                                     data-price="{{ $product->final_price }}">
                                    
                                    <a href="{{ route('products.show', $product->slug) }}" class="block">
                                        <!-- Image du produit -->
                                        <div class="relative overflow-hidden rounded-t-xl">
                                            <img src="{{ $product->main_image ?? 'https://via.placeholder.com/200x200?text=Noorea+Beauty' }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="w-full h-44 md:h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                            
                                            <!-- Badge catégorie -->
                                            @if($product->category)
                                            <div class="absolute top-2 left-2">
                                                <span class="inline-flex items-center px-2 py-1 bg-white/90 backdrop-blur-sm text-xs font-medium text-noorea-brown rounded-full">
                                                    {{ $product->category->name }}
                                                </span>
                                            </div>
                                            @endif
                                            
                                            <!-- Actions rapides -->
                                            <div class="absolute top-2 right-2 flex flex-col space-y-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <button class="p-1.5 bg-white/90 backdrop-blur-sm rounded-full text-gray-600 hover:text-noorea-gold hover:bg-white transition-colors duration-200" onclick="event.stopPropagation(); event.preventDefault();">
                                                    <i class="fas fa-heart text-sm"></i>
                                                </button>
                                                <button class="p-1.5 bg-white/90 backdrop-blur-sm rounded-full text-gray-600 hover:text-noorea-gold hover:bg-white transition-colors duration-200" onclick="event.stopPropagation(); event.preventDefault();">
                                                    <i class="fas fa-eye text-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Contenu -->
                                        <div class="p-3 md:p-4">
                                            <!-- Marque -->
                                            <p class="text-xs text-gray-500 mb-1 font-medium">
                                                {{ $product->brand ? $product->brand->name : 'Marque non spécifiée' }}
                                            </p>
                                            
                                            <!-- Nom du produit -->
                                            <h3 class="text-sm md:text-base font-bold text-noorea-brown mb-2 line-clamp-2 group-hover:text-noorea-gold transition-colors duration-200">
                                                {{ $product->name }}
                                            </h3>
                                            
                                            <!-- Prix -->
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="text-lg md:text-xl font-bold text-noorea-gold">
                                                    {{ number_format($product->final_price, 0, ',', '.') }} <span class="text-xs">FCFA</span>
                                                </div>
                                                @if($product->is_on_sale)
                                                    <div class="text-xs text-gray-400 line-through">
                                                        {{ number_format($product->price, 0, ',', '.') }} FCFA
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <!-- Bouton Ajouter -->
                                    <div class="px-3 pb-3 md:px-4 md:pb-4">
                                        <button 
                                            class="add-to-cart-btn w-full bg-noorea-gold hover:bg-yellow-600 text-white font-medium py-2 px-3 rounded-lg text-sm transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 flex items-center justify-center"
                                            data-product-id="{{ $product->id }}"
                                            data-product-name="{{ $product->name }}"
                                            data-product-price="{{ $product->final_price }}"
                                            data-product-image="{{ $product->main_image ?? asset('images/logo.png') }}">
                                            <i class="fas fa-shopping-bag mr-1 text-xs"></i>
                                            Ajouter
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
            
            <!-- Produits sans catégorie -->
            @php
                $uncategorizedProducts = $products->whereNull('category_id');
            @endphp
            
            @if($uncategorizedProducts->isNotEmpty())
                <div class="category-section mb-8 md:mb-12" data-category-slug="">
                    <!-- Titre harmonisé pour les autres produits -->
                    <div class="text-center mb-6 md:mb-8">
                        <h3 class="text-3xl md:text-4xl font-serif font-light text-noorea-dark mb-3 tracking-wide">
                            Autres <span class="text-noorea-rose-gold font-medium">Produits</span>
                            <span class="text-noorea-rose-gold font-medium text-lg ml-2">
                                ({{ $uncategorizedProducts->count() }})
                            </span>
                        </h3>
                        <div class="flex items-center justify-center mb-4">
                            <div class="h-px bg-noorea-gold/30 w-20"></div>
                            <i class="fas fa-sparkles text-noorea-rose-gold text-lg mx-4"></i>
                            <div class="h-px bg-noorea-gold/30 w-20"></div>
                        </div>
                    </div>
                    
                    <!-- Même structure responsive pour produits sans catégorie -->
                    <!-- [Même code que ci-dessus] -->
                </div>
            @endif
            
        @else
            <!-- Affichage simple si pas de catégories -->
            <div id="products-grid" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 md:gap-4 lg:gap-6">
                <!-- Products normaux si pas d'organisation par catégories -->
            </div>
        @endif
        
        <!-- Message si aucun résultat -->
        <div id="no-results" class="hidden text-center py-16">
            <i class="fas fa-search text-6xl text-gray-300 mb-6"></i>
            <h3 class="text-2xl font-bold text-gray-500 mb-4">Aucun produit trouvé</h3>
            <p class="text-gray-400">Essayez de modifier vos filtres de recherche</p>
        </div>
    </div>
</section>

<!-- Overlay pour fermer le mini-panier - Désactivé temporairement -->
<!--<div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300"></div>-->

@push('scripts')
<script>
// JavaScript SIMPLE - juste les boutons panier
document.addEventListener('DOMContentLoaded', function() {
    console.log('Boutique chargée - Version SIMPLE');
    
    // Seulement les boutons "Ajouter au panier"
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            
            // Animation simple
            const originalIcon = this.querySelector('i').className;
            this.querySelector('i').className = 'fas fa-check text-white text-sm';
            this.style.backgroundColor = '#10B981';
            
            console.log('Produit ajouté:', productName);
            
            setTimeout(() => {
                this.querySelector('i').className = originalIcon;
                this.style.backgroundColor = '';
            }, 2000);
        });
    });
    
    // === SYSTÈME DE FILTRAGE AJOUTÉ ===
    const categoryFilter = document.getElementById('category-filter');
    const brandFilter = document.getElementById('brand-filter');
    const priceFilter = document.getElementById('price-filter');
    const applyFiltersBtn = document.getElementById('apply-filters');
    const productCards = document.querySelectorAll('.product-card');
    const countNumber = document.getElementById('count-number');
    const noResults = document.getElementById('no-results');
    
    // Fonction de filtrage
    function applyFilters() {
        const selectedCategory = categoryFilter.value;
        const selectedBrand = brandFilter.value;
        const selectedPrice = priceFilter.value;
        
        let visibleCount = 0;
        
        productCards.forEach(card => {
            let shouldShow = true;
            
            // Filtre par catégorie
            if (selectedCategory && card.dataset.category !== selectedCategory) {
                shouldShow = false;
            }
            
            // Filtre par marque
            if (selectedBrand && card.dataset.brand !== selectedBrand) {
                shouldShow = false;
            }
            
            // Filtre par prix (adapté pour CFA)
            if (selectedPrice) {
                const productPrice = parseFloat(card.dataset.price || 0);
                let priceRange;
                
                if (selectedPrice === '0-15000') {
                    priceRange = [0, 15000];
                } else if (selectedPrice === '15000-30000') {
                    priceRange = [15000, 30000];
                } else if (selectedPrice === '30000-60000') {
                    priceRange = [30000, 60000];
                } else if (selectedPrice === '60000+') {
                    priceRange = [60000, Infinity];
                }
                
                if (priceRange && (productPrice < priceRange[0] || productPrice > priceRange[1])) {
                    shouldShow = false;
                }
            }
            
            // Afficher/masquer la carte
            if (shouldShow) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Mettre à jour le compteur
        countNumber.textContent = visibleCount;
        
        // Afficher/masquer le message "aucun résultat"
        if (visibleCount === 0 && noResults) {
            noResults.classList.remove('hidden');
        } else if (noResults) {
            noResults.classList.add('hidden');
        }
    }
    
    // Attacher les événements
    if (applyFiltersBtn) {
        applyFiltersBtn.addEventListener('click', applyFilters);
    }
    
    console.log(`${addToCartButtons.length} boutons panier et système de filtrage initialisés`);
    
    // TOUT LE RESTE est géré par le layout app.blade.php
});
</script>
@endpush

@push('styles')
<style>
/* === STYLES EXACTEMENT COMME WELCOME === */
.navbar-icon-top {
    color: #ffffff;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 50%;
    transform: scale(1);
}

.navbar-icon-top:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: scale(1.1);
    color: #d4af37;
}

/* Responsive classes EXACTLY LIKE WELCOME */
.desktop-search {
    display: none;
}

@media (min-width: 768px) {
    .desktop-search {
        display: block;
    }
    
    .mobile-only {
        display: none !important;
    }
    
    .desktop-auth {
        display: flex;
    }
}

@media (max-width: 767px) {
    .desktop-search {
        display: none !important;
    }
    
    .desktop-auth {
        display: none !important;
    }
}

/* Mobile search bar - CENTRÉ comme le menu */
.mobile-search-bar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: auto;
    background: transparent;
    z-index: 100;
    transform: translateY(-100%);
    transition: transform 0.3s ease-in-out;
    padding-top: 140px; /* Espace pour les deux navbars */
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.mobile-search-bar.show {
    transform: translateY(0);
}

.mobile-search-bar .container {
    background: white;
    margin: 0;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    border: 2px solid #d4af37;
    width: 90%;
    max-width: 400px;
}

/* Styles pour les cartes de produits */
.product-card {
    border: 1px solid rgba(0,0,0,0.05);
    background: white;
    transition: all 0.3s ease;
}

.product-card:hover {
    border-color: rgba(212, 175, 55, 0.2);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    transform: translateY(-2px);
}

.product-card-mobile {
    border: 1px solid rgba(0,0,0,0.05);
    background: white;
    transition: all 0.3s ease;
}

.product-card-mobile:hover {
    border-color: rgba(212, 175, 55, 0.2);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Animation pour les boutons d'action */
.add-to-cart-btn {
    transition: all 0.3s ease;
}

.add-to-cart-btn:hover {
    transform: scale(1.05);
}

/* Styles pour les actions mobiles */
.product-card-mobile .flex-shrink-0 button,
.product-card-mobile .flex-shrink-0 a {
    transition: all 0.2s ease;
}

.product-card-mobile .flex-shrink-0 button:hover,
.product-card-mobile .flex-shrink-0 a:hover {
    transform: scale(1.1);
}

/* Styles pour navbar-icon-top sur pages intérieures - couleurs proches de welcome */
.navbar-icon-top {
    color: #d4af37;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 50%;
    transform: scale(1);
    background-color: rgba(212, 175, 55, 0.1);
    backdrop-filter: blur(2px);
    border: 1px solid rgba(212, 175, 55, 0.2);
}

.navbar-icon-top:hover {
    color: #b8941f;
    background-color: rgba(212, 175, 55, 0.2);
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
    border: 1px solid rgba(212, 175, 55, 0.4);
}

/* Responsive design */
.desktop-auth { display: flex; }
.mobile-only { display: block; }
.desktop-search { display: block; }

@media (max-width: 768px) {
    .desktop-auth { display: none; }
    .desktop-search { display: none; }
}

@media (min-width: 769px) {
    .mobile-only { display: none; }
}

/* Styles pour nav-link-gold et active-gold - EXACTEMENT comme welcome */
.nav-link-gold {
    color: #1f2937;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    border: 1px solid transparent;
}

.nav-link-gold:hover {
    color: #d4af37;
    border-color: rgba(212, 175, 55, 0.4);
    background-color: rgba(255, 255, 255, 0.3);
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(212, 175, 55, 0.2);
}

.nav-link-gold.active-gold {
    color: #d4af37;
    border-color: rgba(212, 175, 55, 0.5);
    background-color: rgba(255, 255, 255, 0.4);
    box-shadow: 0 2px 4px rgba(212, 175, 55, 0.2);
}

.nav-link-gold i {
    color: #d4af37;
    transition: all 0.3s ease;
}

.nav-link-gold:hover i {
    color: #d4af37;
    transform: scale(1.1);
}

.active-gold i {
    color: #d4af37;
}
</style>
@endpush
@endsection
