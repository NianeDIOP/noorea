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
                        placeholder="Rechercher..." 
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

<!-- Section À propos -->
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
                <li class="text-noorea-dark font-medium">À propos</li>
            </ol>
        </nav>

        <!-- En-tête -->
        <div class="mb-12 md:mb-16">
            <div class="text-center lg:text-left">
                <h2 class="text-4xl font-serif font-light text-noorea-dark mb-4 tracking-wide">
                    À propos de <span class="text-noorea-rose-gold font-medium">Noorea</span>
                </h2>
                <div class="flex items-center justify-center lg:justify-start mb-6">
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                    <i class="fas fa-info-circle text-noorea-rose-gold text-lg mx-4"></i>
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                </div>
                
                <p class="text-lg text-noorea-dark/70 leading-relaxed mb-8 max-w-3xl">
                    Découvrez notre histoire, nos valeurs et notre passion pour la beauté multiculturelle. 
                    Noorea illumine votre beauté naturelle grâce à des produits authentiques et respectueux.
                </p>
                
                <!-- Statistiques -->
                <div class="flex flex-wrap justify-center lg:justify-start gap-6 mb-8">
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl px-4 py-3 border border-noorea-gold/20 shadow-sm">
                        <div class="text-2xl font-bold text-noorea-gold">2023</div>
                        <div class="text-sm text-noorea-dark/70">Fondation</div>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl px-4 py-3 border border-noorea-gold/20 shadow-sm">
                        <div class="text-2xl font-bold text-noorea-gold">100%</div>
                        <div class="text-sm text-noorea-dark/70">Naturel</div>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl px-4 py-3 border border-noorea-gold/20 shadow-sm">
                        <div class="text-2xl font-bold text-noorea-gold">∞</div>
                        <div class="text-sm text-noorea-dark/70">Passion</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notre histoire -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-16">
            <div class="order-2 lg:order-1">
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-noorea-gold/10">
                    <h3 class="text-2xl font-serif font-medium text-noorea-dark mb-6">Notre Histoire</h3>
                    <div class="space-y-4 text-noorea-dark/80 leading-relaxed">
                        <p>
                            Fondée en 2023, Noorea est née d'une passion pour la beauté multiculturelle et d'une volonté de mettre en lumière les trésors cosmétiques du monde entier, en particulier ceux d'Afrique et du Sénégal.
                        </p>
                        <p>
                            Notre fondatrice, Aïssatou Diop, a grandi au Sénégal entourée des rituels de beauté transmis de génération en génération. Après des études en cosmétologie en France et plusieurs années d'expérience dans l'industrie, elle a décidé de créer Noorea pour partager ces traditions avec le monde.
                        </p>
                        <p>
                            Le nom "Noorea" vient du mot arabe "Noor" qui signifie "lumière" - une référence à notre mission d'illuminer la beauté naturelle de chacun grâce à des produits de qualité qui respectent la peau et l'environnement.
                        </p>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <div class="rounded-2xl overflow-hidden shadow-lg">
                    <img src="https://images.pexels.com/photos/3762800/pexels-photo-3762800.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" 
                         alt="Noorea - Notre histoire" 
                         class="w-full h-64 lg:h-80 object-cover">
                </div>
            </div>
        </div>

        <!-- Nos valeurs -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-serif font-light text-noorea-dark mb-4">
                    Nos <span class="text-noorea-rose-gold font-medium">Valeurs</span>
                </h3>
                <div class="flex items-center justify-center mb-4">
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                    <i class="fas fa-heart text-noorea-rose-gold text-lg mx-4"></i>
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-noorea-gold/10 text-center group hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-noorea-gold/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-noorea-gold/30 transition-colors duration-300">
                        <i class="fas fa-leaf text-noorea-gold text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-serif font-medium text-noorea-dark mb-4">Naturel</h4>
                    <p class="text-noorea-dark/70 leading-relaxed">
                        Nous privilégions les ingrédients naturels, issus de sources durables et éthiques. Nos produits sont formulés pour être efficaces tout en respectant votre peau.
                    </p>
                </div>
                
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-noorea-gold/10 text-center group hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-noorea-gold/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-noorea-gold/30 transition-colors duration-300">
                        <i class="fas fa-globe-africa text-noorea-gold text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-serif font-medium text-noorea-dark mb-4">Multiculturel</h4>
                    <p class="text-noorea-dark/70 leading-relaxed">
                        Nous célébrons la diversité des traditions de beauté à travers le monde. Chaque produit raconte une histoire et porte en lui un savoir-faire ancestral.
                    </p>
                </div>
                
                <div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-noorea-gold/10 text-center group hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-noorea-gold/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-noorea-gold/30 transition-colors duration-300">
                        <i class="fas fa-handshake text-noorea-gold text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-serif font-medium text-noorea-dark mb-4">Responsable</h4>
                    <p class="text-noorea-dark/70 leading-relaxed">
                        Nous nous engageons à avoir un impact positif sur les communautés avec lesquelles nous travaillons. Nos emballages sont éco-responsables et nos produits ne sont jamais testés sur les animaux.
                    </p>
                </div>
            </div>
        </div>

        <!-- Notre équipe -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-serif font-light text-noorea-dark mb-4">
                    Notre <span class="text-noorea-rose-gold font-medium">Équipe</span>
                </h3>
                <div class="flex items-center justify-center mb-4">
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                    <i class="fas fa-users text-noorea-rose-gold text-lg mx-4"></i>
                    <div class="h-px bg-noorea-gold/30 w-20"></div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-noorea-gold/10 text-center group hover:shadow-xl transition-all duration-300">
                    <div class="relative mb-6 w-32 h-32 mx-auto">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-br from-noorea-gold/20 to-noorea-rose-gold/20"></div>
                        <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop" 
                             alt="Aïssatou Diop" 
                             class="rounded-full w-28 h-28 object-cover absolute inset-2 group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h5 class="text-lg font-serif font-medium text-noorea-dark mb-2">Aïssatou Diop</h5>
                    <p class="text-noorea-gold text-sm">Fondatrice & CEO</p>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-noorea-gold/10 text-center group hover:shadow-xl transition-all duration-300">
                    <div class="relative mb-6 w-32 h-32 mx-auto">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-br from-noorea-gold/20 to-noorea-rose-gold/20"></div>
                        <img src="https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop" 
                             alt="Marie Faye" 
                             class="rounded-full w-28 h-28 object-cover absolute inset-2 group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h5 class="text-lg font-serif font-medium text-noorea-dark mb-2">Marie Faye</h5>
                    <p class="text-noorea-gold text-sm">Directrice Produit</p>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-noorea-gold/10 text-center group hover:shadow-xl transition-all duration-300">
                    <div class="relative mb-6 w-32 h-32 mx-auto">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-br from-noorea-gold/20 to-noorea-rose-gold/20"></div>
                        <img src="https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop" 
                             alt="Omar Ndiaye" 
                             class="rounded-full w-28 h-28 object-cover absolute inset-2 group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h5 class="text-lg font-serif font-medium text-noorea-dark mb-2">Omar Ndiaye</h5>
                    <p class="text-noorea-gold text-sm">Directeur Marketing</p>
                </div>
                
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-noorea-gold/10 text-center group hover:shadow-xl transition-all duration-300">
                    <div class="relative mb-6 w-32 h-32 mx-auto">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-br from-noorea-gold/20 to-noorea-rose-gold/20"></div>
                        <img src="https://images.pexels.com/photos/1130626/pexels-photo-1130626.jpeg?auto=compress&cs=tinysrgb&w=300&h=300&fit=crop" 
                             alt="Fatou Sow" 
                             class="rounded-full w-28 h-28 object-cover absolute inset-2 group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h5 class="text-lg font-serif font-medium text-noorea-dark mb-2">Fatou Sow</h5>
                    <p class="text-noorea-gold text-sm">Responsable R&D</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center">
            <div class="bg-white rounded-2xl p-8 md:p-12 shadow-lg border border-noorea-gold/10">
                <h3 class="text-2xl font-serif font-medium text-noorea-dark mb-4">
                    Rejoignez l'aventure Noorea
                </h3>
                <p class="text-noorea-dark/70 mb-8 max-w-2xl mx-auto">
                    Découvrez nos produits cosmétiques naturels et authentiques, 
                    et laissez-vous séduire par la beauté multiculturelle.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products') }}" 
                       class="bg-noorea-gold hover:bg-noorea-gold/80 text-white font-semibold px-8 py-3 rounded-xl transition-all duration-300 hover:shadow-lg flex items-center justify-center">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        Découvrir nos produits
                    </a>
                    <a href="{{ route('brands') }}" 
                       class="border-2 border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white font-semibold px-8 py-3 rounded-xl transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-crown mr-2"></i>
                        Nos marques
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// JavaScript SIMPLE pour À propos
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page À propos chargée - Version SIMPLE');
    
    // Animation pour les cartes d'équipe
    const teamCards = document.querySelectorAll('.group');
    teamCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    console.log('Page À propos initialisée avec succès');
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
</style>
@endpush
