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
                    <a href="{{ route('categories') }}" class="nav-link-gold {{ request()->routeIs('categories*') ? 'active-gold' : '' }} flex items-center">
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
            
            <!-- Menu mobile -->
            <div class="hidden" id="mobile-menu">
                <nav class="flex flex-col space-y-1 p-4 bg-white border-t border-gray-200 shadow-lg">
                    <a href="{{ route('home') }}" class="nav-link-gold {{ request()->routeIs('home') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-home mr-3 w-5"></i>Accueil
                    </a>
                    <a href="{{ route('products') }}" class="nav-link-gold {{ request()->routeIs('products') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-shopping-bag mr-3 w-5"></i>Boutique
                    </a>
                    <a href="{{ route('categories') }}" class="nav-link-gold {{ request()->routeIs('categories*') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-th-large mr-3 w-5"></i>Catégories
                    </a>
                    <a href="{{ route('brands') }}" class="nav-link-gold {{ request()->routeIs('brands*') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
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
                        placeholder="Rechercher des marques..." 
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

<!-- Section des marques -->
<section class="pt-32 md:pt-36 py-6 md:py-12 relative overflow-hidden" style="background-color: #F7EAD5;">
    <!-- Éléments décoratifs comme welcome -->
    <div class="absolute top-20 right-10 w-24 h-24 bg-noorea-rose-gold/10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-10 left-20 w-32 h-32 bg-noorea-gold/10 rounded-full blur-2xl"></div>
    
    <div class="container mx-auto px-4 md:px-6 relative z-10">
        <!-- Fil d'Ariane -->
        <nav class="text-sm mb-8">
            <ol class="flex items-center space-x-2 text-noorea-dark/70">
                <li><a href="{{ route('home') }}" class="hover:text-noorea-gold transition-colors">Accueil</a></li>
                <li><i class="fas fa-chevron-right text-noorea-gold/50 text-xs"></i></li>
                <li class="text-noorea-dark font-medium">Nos Marques</li>
            </ol>
        </nav>

        <!-- En-tête -->
        <div class="mb-8 md:mb-12">
            <div class="text-center lg:text-left">
                <h2 class="text-4xl font-serif font-light text-noorea-dark mb-4 tracking-wide">
                    Nos <span class="text-noorea-rose-gold font-medium">Marques</span>
                </h2>
                <div class="flex items-center justify-center lg:justify-start mb-4">
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                    <i class="fas fa-crown text-noorea-rose-gold text-lg mx-4"></i>
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                </div>
                
                <p class="text-lg text-noorea-dark/70 leading-relaxed mb-6 max-w-3xl">
                    Découvrez nos marques partenaires sélectionnées avec passion pour leur qualité, 
                    leur authenticité et leur respect des traditions cosmétiques du monde entier.
                </p>
                
                <p class="text-noorea-dark/70 text-lg">
                    <span id="count-number" class="font-medium text-noorea-gold">{{ $brands->count() }}</span> 
                    {{ $brands->count() > 1 ? 'marques partenaires' : 'marque partenaire' }}
                </p>
            </div>
        </div>

        <!-- Grille des marques -->
        @if($brands->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                @foreach($brands as $brand)
                    <div class="brand-card bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 group border border-noorea-gold/5">
                        <a href="{{ route('brands.show', $brand->slug ?? $brand->id) }}" class="block">
                            <!-- Logo/Image de la marque -->
                            <div class="relative overflow-hidden rounded-t-xl">
                                @if($brand->logo_url)
                                    <div class="w-full h-48 bg-white flex items-center justify-center p-6">
                                        <img src="{{ $brand->logo_url }}" 
                                             alt="{{ $brand->name }}" 
                                             class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500"
                                             loading="lazy">
                                    </div>
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-noorea-cream to-noorea-rose-gold flex items-center justify-center">
                                        <div class="w-16 h-16 bg-white/30 rounded-full flex items-center justify-center">
                                            <i class="fas fa-crown text-2xl text-white"></i>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Badge pays -->
                                @if($brand->country)
                                    <div class="absolute top-2 left-2">
                                        <div class="bg-noorea-gold text-white px-2 py-1 rounded-full text-xs font-medium flex items-center">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $brand->country }}
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Badge featured -->
                                @if($brand->is_featured)
                                    <div class="absolute top-2 right-2">
                                        <div class="bg-noorea-rose-gold text-white px-2 py-1 rounded-full text-xs font-medium flex items-center">
                                            <i class="fas fa-star mr-1"></i> Premium
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Contenu -->
                            <div class="p-4 md:p-6">
                                <!-- Nom de la marque -->
                                <h3 class="text-xl font-bold text-noorea-brown mb-2 group-hover:text-noorea-gold transition-colors duration-200">
                                    {{ $brand->name }}
                                </h3>
                                
                                <!-- Description -->
                                @if($brand->description)
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                        {{ $brand->description }}
                                    </p>
                                @endif
                                
                                <!-- Statistiques -->
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-500">
                                        <span class="font-medium text-noorea-gold">{{ $brand->products_count }}</span> 
                                        {{ $brand->products_count > 1 ? 'produits' : 'produit' }}
                                    </div>
                                    
                                    @if($brand->website)
                                        <div class="text-xs text-gray-400">
                                            <i class="fas fa-external-link-alt"></i> Site web
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        
                        <!-- Lien Découvrir -->
                        <div class="px-4 pb-4 md:px-6 md:pb-6 pt-2">
                            <a href="{{ route('brands.show', $brand->slug ?? $brand->id) }}" 
                               class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm transition-colors duration-300 flex items-center">
                                <span>Découvrir</span>
                                <i class="fas fa-arrow-right ml-2 text-xs transition-transform duration-300 group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Aucune marque -->
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-noorea-cream to-noorea-rose-gold rounded-full mb-6">
                    <i class="fas fa-crown text-4xl text-white/70"></i>
                </div>
                <h3 class="text-2xl font-serif font-medium text-noorea-dark mb-4">Aucune marque disponible</h3>
                <p class="text-noorea-dark/70 mb-8 max-w-md mx-auto">
                    Nous travaillons actuellement à enrichir notre catalogue de marques partenaires.
                </p>
                <a href="{{ route('products') }}" 
                   class="inline-flex items-center bg-noorea-gold hover:bg-noorea-gold/80 text-white font-semibold px-8 py-4 rounded-2xl transition-all duration-300 hover:shadow-lg">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Découvrir nos produits
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
// JavaScript SIMPLE pour les marques
document.addEventListener('DOMContentLoaded', function() {
    console.log('Marques chargées - Version SIMPLE');
    
    // Comptage des marques
    const brandCards = document.querySelectorAll('.brand-card');
    console.log(`${brandCards.length} marques affichées`);
    
    // Animation au hover pour les cartes
    brandCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush

@push('styles')
<style>
/* === STYLES EXACTEMENT COMME PRODUCTS ET CATEGORIES === */
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

/* Responsive classes EXACTLY LIKE PRODUCTS */
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

/* Styles pour les cartes de marques */
.brand-card {
    border: 1px solid rgba(0,0,0,0.05);
    background: white;
    transition: all 0.3s ease;
}

.brand-card:hover {
    border-color: rgba(212, 175, 55, 0.2);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    transform: translateY(-2px);
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Styles pour nav-link-gold et active-gold - EXACTEMENT comme products */
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
