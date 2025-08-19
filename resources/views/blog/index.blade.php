@extends('layouts.app')

@push('head')
<!-- Meta tags pour blog -->
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
                            placeholder="Rechercher des articles, conseils beauté..." 
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
                    <a href="{{ route('blog') }}" class="nav-link-gold {{ request()->routeIs('blog*') ? 'active-gold' : '' }} flex items-center">
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
                    <a href="{{ route('blog') }}" class="nav-link-gold {{ request()->routeIs('blog*') ? 'active-gold' : '' }} flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
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
                        placeholder="Rechercher des articles..." 
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

<!-- Section Blog -->
<section class="pt-32 md:pt-36 py-6 md:py-12 relative overflow-hidden" style="background-color: #F7EAD5;">
    <!-- Éléments décoratifs -->
    <div class="absolute top-20 right-10 w-24 h-24 bg-noorea-rose-gold/10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-10 left-20 w-32 h-32 bg-noorea-gold/10 rounded-full blur-2xl"></div>
    
    <div class="container mx-auto px-4 md:px-6 relative z-10">
        <!-- Fil d'Ariane -->
        <nav class="text-sm mb-8">
            <ol class="flex items-center space-x-2 text-noorea-dark/70">
                <li><a href="{{ route('home') }}" class="hover:text-noorea-gold transition-colors">Accueil</a></li>
                <li><i class="fas fa-chevron-right text-noorea-gold/50 text-xs"></i></li>
                <li class="text-noorea-dark font-medium">Beauté du Monde</li>
            </ol>
        </nav>

        <!-- En-tête -->
        <div class="mb-12 md:mb-16">
            <div class="text-center lg:text-left">
                <h2 class="text-4xl font-serif font-light text-noorea-dark mb-4 tracking-wide">
                    <span class="text-noorea-rose-gold font-medium">Beauté</span> du Monde
                </h2>
                <div class="flex items-center justify-center lg:justify-start mb-6">
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                    <i class="fas fa-globe text-noorea-rose-gold text-lg mx-4"></i>
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                </div>
                
                <p class="text-lg text-noorea-dark/70 leading-relaxed mb-8 max-w-3xl">
                    Découvrez les secrets de beauté des quatre coins du monde et les traditions 
                    cosmétiques ancestrales. Plongez dans un univers de conseils, astuces et rituels authentiques.
                </p>
            </div>
        </div>

        <!-- Filtres -->
        <div class="flex flex-wrap justify-center lg:justify-start gap-4 mb-12">
            <button class="filter-btn active bg-noorea-gold text-white px-6 py-3 rounded-full font-medium transition-all duration-300 hover:shadow-lg" data-filter="tous">
                Tous les articles
            </button>
            <button class="filter-btn border-2 border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white px-6 py-3 rounded-full font-medium transition-all duration-300" data-filter="soins">
                Soins
            </button>
            <button class="filter-btn border-2 border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white px-6 py-3 rounded-full font-medium transition-all duration-300" data-filter="maquillage">
                Maquillage
            </button>
            <button class="filter-btn border-2 border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white px-6 py-3 rounded-full font-medium transition-all duration-300" data-filter="traditions">
                Traditions
            </button>
            <button class="filter-btn border-2 border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white px-6 py-3 rounded-full font-medium transition-all duration-300" data-filter="diy">
                DIY
            </button>
        </div>
        
        <!-- Article principal en vedette -->
        <div class="mb-16">
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-500 border border-noorea-gold/10">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="relative overflow-hidden">
                        <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop" 
                             alt="Les secrets du beurre de karité" class="w-full h-80 lg:h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute top-6 left-6 bg-noorea-gold text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg">
                            <i class="fas fa-star mr-1"></i>Article vedette
                        </div>
                    </div>
                    <div class="p-8 lg:p-12 flex flex-col justify-center">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="text-sm bg-noorea-rose-gold/20 text-noorea-rose-gold px-3 py-1 rounded-full font-medium">Traditions</span>
                            <span class="text-sm text-noorea-dark/60">12 janvier 2025</span>
                        </div>
                        <h3 class="text-3xl lg:text-4xl font-serif font-light text-noorea-dark mb-4 leading-tight">
                            Les Secrets Millénaires du <span class="text-noorea-rose-gold font-medium">Beurre de Karité</span>
                        </h3>
                        <p class="text-noorea-dark/70 mb-6 leading-relaxed">
                            Découvrez l'histoire fascinante du beurre de karité, cet "or blanc" africain aux vertus 
                            cosmétiques exceptionnelles. De la récolte traditionnelle aux bienfaits modernes.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="https://images.pexels.com/photos/3762879/pexels-photo-3762879.jpeg?auto=compress&cs=tinysrgb&w=100&h=100&fit=crop" 
                                     alt="Aïssatou Diop" class="w-12 h-12 rounded-full object-cover border-2 border-noorea-gold/30">
                                <div>
                                    <p class="font-medium text-noorea-dark">Aïssatou Diop</p>
                                    <p class="text-sm text-noorea-dark/60">Fondatrice Noorea</p>
                                </div>
                            </div>
                            <button class="bg-noorea-gold hover:bg-noorea-gold/80 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 hover:shadow-lg hover:scale-105">
                                Lire l'article
                            </button>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        
        <!-- Grille d'articles -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Article 1 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 border border-noorea-gold/10">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/4465659/pexels-photo-4465659.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Routine beauté marocaine" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-gold/90 text-white px-3 py-1 rounded-full text-xs font-medium">
                        Soins
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-noorea-dark/60">8 janvier 2025</span>
                        <span class="text-xs text-noorea-gold">•</span>
                        <span class="text-xs text-noorea-dark/60">5 min de lecture</span>
                    </div>
                    <h4 class="text-xl font-serif font-medium text-noorea-dark mb-3 leading-tight">
                        La Routine Beauté Marocaine : Secrets de l'Huile d'Argan
                    </h4>
                    <p class="text-noorea-dark/70 mb-4 leading-relaxed">
                        Plongez dans les rituels de beauté ancestraux du Maroc et découvrez comment l'huile d'argan transforme votre peau.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Fatima El Mansouri" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-noorea-dark/70">Fatima E.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm transition-colors">
                            Lire l'article →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 2 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 border border-noorea-gold/10">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Maquillage traditionnel indien" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-rose-gold/90 text-white px-3 py-1 rounded-full text-xs font-medium">
                        Maquillage
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-noorea-dark/60">5 janvier 2025</span>
                        <span class="text-xs text-noorea-gold">•</span>
                        <span class="text-xs text-noorea-dark/60">7 min de lecture</span>
                    </div>
                    <h4 class="text-xl font-serif font-medium text-noorea-dark mb-3 leading-tight">
                        L'Art du Henné et du Kohl : Traditions Indiennes
                    </h4>
                    <p class="text-noorea-dark/70 mb-4 leading-relaxed">
                        Explorez l'art millénaire du maquillage indien et apprenez à intégrer ces techniques dans votre routine moderne.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Priya Sharma" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-noorea-dark/70">Priya S.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm transition-colors">
                            Lire l'article →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 3 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 border border-noorea-gold/10">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/4465124/pexels-photo-4465124.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Soins naturels coréens" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-gold/90 text-white px-3 py-1 rounded-full text-xs font-medium">
                        K-Beauty
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-noorea-dark/60">2 janvier 2025</span>
                        <span class="text-xs text-noorea-gold">•</span>
                        <span class="text-xs text-noorea-dark/60">6 min de lecture</span>
                    </div>
                    <h4 class="text-xl font-serif font-medium text-noorea-dark mb-3 leading-tight">
                        K-Beauty : La Routine Coréenne en 10 Étapes
                    </h4>
                    <p class="text-noorea-dark/70 mb-4 leading-relaxed">
                        Décryptage de la célèbre routine de soins coréenne et adaptation pour les peaux africaines et méditerranéennes.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/3992206/pexels-photo-3992206.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Min-jung Kim" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-noorea-dark/70">Min-jung K.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm transition-colors">
                            Lire l'article →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 4 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 border border-noorea-gold/10">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="DIY masques maison" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-gold/90 text-white px-3 py-1 rounded-full text-xs font-medium">
                        DIY
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-noorea-dark/60">28 décembre 2024</span>
                        <span class="text-xs text-noorea-gold">•</span>
                        <span class="text-xs text-noorea-dark/60">4 min de lecture</span>
                    </div>
                    <h4 class="text-xl font-serif font-medium text-noorea-dark mb-3 leading-tight">
                        5 Masques Maison aux Ingrédients Africains
                    </h4>
                    <p class="text-noorea-dark/70 mb-4 leading-relaxed">
                        Recettes simples et efficaces avec du miel, de l'argile rhassoul et des huiles végétales locales.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Aminata Ba" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-noorea-dark/70">Aminata B.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm transition-colors">
                            Lire l'article →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 5 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 border border-noorea-gold/10">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3762879/pexels-photo-3762879.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Cheveux afro soins" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-gold/90 text-white px-3 py-1 rounded-full text-xs font-medium">
                        Cheveux
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-noorea-dark/60">25 décembre 2024</span>
                        <span class="text-xs text-noorea-gold">•</span>
                        <span class="text-xs text-noorea-dark/60">8 min de lecture</span>
                    </div>
                    <h4 class="text-xl font-serif font-medium text-noorea-dark mb-3 leading-tight">
                        Guide Complet : Soins des Cheveux Crépus et Frisés
                    </h4>
                    <p class="text-noorea-dark/70 mb-4 leading-relaxed">
                        Tout ce qu'il faut savoir pour prendre soin de vos cheveux texturés avec des produits naturels.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/1190829/pexels-photo-1190829.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Khadija Ndiaye" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-noorea-dark/70">Khadija N.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm transition-colors">
                            Lire l'article →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 6 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 border border-noorea-gold/10">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/1190829/pexels-photo-1190829.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Tendances maquillage" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-rose-gold/90 text-white px-3 py-1 rounded-full text-xs font-medium">
                        Tendances
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-noorea-dark/60">20 décembre 2024</span>
                        <span class="text-xs text-noorea-gold">•</span>
                        <span class="text-xs text-noorea-dark/60">5 min de lecture</span>
                    </div>
                    <h4 class="text-xl font-serif font-medium text-noorea-dark mb-3 leading-tight">
                        Tendances Maquillage 2025 : L'Élégance Multiculturelle
                    </h4>
                    <p class="text-noorea-dark/70 mb-4 leading-relaxed">
                        Les couleurs et techniques qui vont dominer cette année, adaptées à toutes les carnations.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Sira Coulibaly" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-noorea-dark/70">Sira C.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm transition-colors">
                            Lire l'article →
                        </button>
                    </div>
                </div>
            </article>
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center mt-16">
            <nav class="flex items-center gap-2">
                <button class="px-4 py-2 text-noorea-dark/50 hover:text-noorea-gold transition-colors">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-4 py-2 bg-noorea-gold text-white rounded-lg shadow-sm">1</button>
                <button class="px-4 py-2 text-noorea-dark/70 hover:text-noorea-gold hover:bg-white rounded-lg transition-all duration-300">2</button>
                <button class="px-4 py-2 text-noorea-dark/70 hover:text-noorea-gold hover:bg-white rounded-lg transition-all duration-300">3</button>
                <span class="px-2 text-noorea-dark/50">...</span>
                <button class="px-4 py-2 text-noorea-dark/70 hover:text-noorea-gold hover:bg-white rounded-lg transition-all duration-300">8</button>
                <button class="px-4 py-2 text-noorea-dark/50 hover:text-noorea-gold transition-colors">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </nav>
        </div>
    </div>
</section>

<!-- Newsletter subscription -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-serif font-light text-noorea-dark mb-4">
                Restez Connectée à la <span class="text-noorea-rose-gold font-medium">Beauté du Monde</span>
            </h2>
            <div class="flex items-center justify-center mb-6">
                <div class="h-px bg-noorea-gold/30 w-20"></div>
                <i class="fas fa-envelope text-noorea-rose-gold text-lg mx-4"></i>
                <div class="h-px bg-noorea-gold/30 w-20"></div>
            </div>
            <p class="text-noorea-dark/70 mb-8">
                Recevez nos derniers articles, conseils beauté et offres exclusives directement dans votre boîte mail
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                <input type="email" placeholder="Votre adresse email" 
                       class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-noorea-gold focus:ring-2 focus:ring-noorea-gold/20 focus:outline-none transition-all duration-300 text-gray-800">
                <button class="bg-noorea-gold hover:bg-noorea-gold/80 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105">
                    S'abonner
                </button>
            </div>
            
            <p class="text-xs text-noorea-dark/50 mt-4">
                En vous abonnant, vous acceptez de recevoir nos emails. Vous pouvez vous désabonner à tout moment.
            </p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// JavaScript optimisé pour blog
document.addEventListener('DOMContentLoaded', function() {
    console.log('Blog "Beauté du Monde" chargé - Version standardisée');
    
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Mobile search functionality
    const mobileSearchButton = document.getElementById('mobile-search-button');
    const mobileSearchBar = document.getElementById('mobile-search-bar');
    const closeMobileSearch = document.getElementById('close-mobile-search');
    
    if (mobileSearchButton && mobileSearchBar) {
        mobileSearchButton.addEventListener('click', function() {
            mobileSearchBar.classList.add('show');
            document.body.style.overflow = 'hidden';
            // Focus sur l'input de recherche
            setTimeout(() => {
                const searchInput = document.getElementById('mobile-search-input');
                if (searchInput) searchInput.focus();
            }, 300);
        });
    }
    
    if (closeMobileSearch && mobileSearchBar) {
        closeMobileSearch.addEventListener('click', function() {
            mobileSearchBar.classList.remove('show');
            document.body.style.overflow = '';
        });
    }
    
    // Filtres blog avec gestion améliorée
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Retirer la classe active de tous les boutons
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-noorea-gold', 'text-white');
                btn.classList.add('border-2', 'border-noorea-gold', 'text-noorea-gold', 'hover:bg-noorea-gold', 'hover:text-white');
            });
            
            // Ajouter la classe active au bouton cliqué
            this.classList.remove('border-2', 'border-noorea-gold', 'text-noorea-gold', 'hover:bg-noorea-gold', 'hover:text-white');
            this.classList.add('bg-noorea-gold', 'text-white');
            
            const filter = this.getAttribute('data-filter');
            console.log('Filtre sélectionné:', filter);
            
            // Animation des cartes d'articles (simulation de filtrage)
            const articles = document.querySelectorAll('article');
            articles.forEach(article => {
                article.style.transform = 'scale(0.95)';
                article.style.opacity = '0.7';
                setTimeout(() => {
                    article.style.transform = 'scale(1)';
                    article.style.opacity = '1';
                }, 200);
            });
        });
    });
    
    // Animation des articles au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.transform = 'translateY(0)';
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);
    
    // Appliquer l'observer aux articles
    const articles = document.querySelectorAll('article');
    articles.forEach(article => {
        article.style.transform = 'translateY(20px)';
        article.style.opacity = '0';
        article.style.transition = 'all 0.6s ease-out';
        observer.observe(article);
    });
    
    console.log('Blog initialisé avec succès');
});
</script>
@endpush

@push('styles')
<style>
/* === STYLES EXACTEMENT COMME AUTRES VUES === */
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

/* Animation pour les filtres */
.filter-btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.filter-btn:hover {
    transform: translateY(-2px);
}

.filter-btn.active {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
}
</style>
@endpush
