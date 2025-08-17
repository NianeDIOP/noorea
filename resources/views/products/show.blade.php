@extends('layouts.app')

@section('title', $product->name ?? 'Produit')

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

@section('content')
<!-- Espacement après navbar pour desktop -->
<div class="hidden md:block h-8"></div>

<!-- Breadcrumbs Mobile-Friendly -->
<nav class="bg-white border-b pt-36 md:pt-40 py-4">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600 overflow-x-auto scrollbar-hide">
            <a href="{{ route('home') }}" class="hover:text-noorea-gold whitespace-nowrap">
                <i class="fas fa-home mr-1"></i>Accueil
            </a>
            <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
            <a href="{{ route('products') }}" class="hover:text-noorea-gold whitespace-nowrap">Boutique</a>
            <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
            <span class="text-noorea-gold font-medium truncate">{{ $product->name }}</span>
        </div>
    </div>
</nav>

<!-- Espacement supplémentaire avant les détails produit pour desktop -->
<div class="hidden md:block h-24"></div>

<!-- Détails produit responsive -->
<section class="py-8 md:py-16 md:pt-28 bg-gradient-to-b from-pink-50 via-white to-amber-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                
                <!-- Galerie d'images - Mobile optimisée -->
                <div class="space-y-4 mb-8 lg:mb-0">
                    <!-- Image principale -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="aspect-square relative group">
                            @if($product->main_image)
                                @php
                                    $imageUrl = Str::startsWith($product->main_image, ['http://', 'https://']) 
                                        ? $product->main_image 
                                        : asset('storage/' . $product->main_image);
                                @endphp
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                
                                <!-- Bouton zoom mobile -->
                                <button class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg hover:bg-white transition-all duration-200 md:opacity-0 group-hover:opacity-100">
                                    <i class="fas fa-expand text-gray-600"></i>
                                </button>
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <div class="text-center text-gray-400">
                                        <i class="fas fa-image text-6xl mb-4"></i>
                                        <p class="text-lg">Image non disponible</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Badge promotion mobile -->
                    @if($product->is_on_sale ?? false)
                        <div class="bg-red-500 text-white px-4 py-2 rounded-lg inline-block">
                            <i class="fas fa-tag mr-2"></i>Promotion
                        </div>
                    @endif
                </div>
                
                <!-- Informations produit - Mobile optimisé -->
                <div class="space-y-4">
                    <!-- En-tête produit -->
                    <div class="space-y-3">
                        <div class="flex flex-wrap gap-1.5 mb-2">
                            @if($product->brand)
                                <span class="bg-noorea-gold/10 text-noorea-gold px-2 py-0.5 rounded-full text-xs font-medium">
                                    <i class="fas fa-crown mr-1"></i>{{ $product->brand->name }}
                                </span>
                            @endif
                            @if($product->category)
                                <span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full text-xs">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">
                                <i class="fas fa-check-circle mr-1"></i>En stock
                            </span>
                        </div>
                        
                        <h1 class="text-xl md:text-2xl lg:text-3xl font-serif text-noorea-dark leading-tight">
                            {{ $product->name }}
                        </h1>
                        
                        <!-- Évaluation mobile -->
                        <div class="flex items-center space-x-2 flex-wrap">
                            <div class="flex items-center space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                                @endfor
                                <span class="text-gray-600 text-xs ml-1">(4.2)</span>
                            </div>
                            <span class="text-gray-400">•</span>
                            <span class="text-gray-600 text-xs">127 avis</span>
                        </div>
                    </div>
                    
                    <!-- Prix responsive -->
                    <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-100">
                        <div class="space-y-2">
                            @if(($product->original_price ?? 0) > ($product->final_price ?? $product->price ?? 0))
                                <div class="flex items-baseline space-x-2 flex-wrap">
                                    <span class="text-2xl md:text-3xl font-bold text-noorea-gold">
                                        {{ number_format($product->final_price ?? $product->price ?? 0, 0, ',', ' ') }} CFA
                                    </span>
                                    <span class="text-lg text-gray-500 line-through">
                                        {{ number_format($product->original_price, 0, ',', ' ') }} CFA
                                    </span>
                                    <span class="bg-red-100 text-red-600 px-2 py-0.5 rounded-full text-xs font-medium">
                                        -{{ round((($product->original_price - $product->final_price) / $product->original_price) * 100) }}%
                                    </span>
                                </div>
                            @else
                                <div class="text-2xl md:text-3xl font-bold text-noorea-gold">
                                    {{ number_format($product->final_price ?? $product->price ?? 0, 0, ',', ' ') }} CFA
                                </div>
                            @endif
                            
                            <!-- Modes de paiement mobile -->
                            <div class="flex flex-wrap gap-1.5 pt-2 border-t">
                                <span class="text-green-600 text-xs bg-green-50 px-2 py-0.5 rounded">
                                    <i class="fas fa-mobile-alt mr-1"></i>Mobile Money
                                </span>
                                <span class="text-blue-600 text-xs bg-blue-50 px-2 py-0.5 rounded">
                                    <i class="fas fa-credit-card mr-1"></i>Carte bancaire
                                </span>
                                <span class="text-orange-600 text-xs bg-orange-50 px-2 py-0.5 rounded">
                                    <i class="fas fa-money-bill-wave mr-1"></i>Paiement livraison
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description courte mobile -->
                    @if($product->short_description)
                        <div class="bg-gradient-to-r from-pink-50 to-amber-50 p-4 rounded-xl border border-pink-100">
                            <h3 class="font-semibold text-gray-800 mb-2 text-sm">
                                <i class="fas fa-info-circle text-noorea-gold mr-2"></i>Description rapide
                            </h3>
                            <p class="text-gray-700 leading-relaxed text-sm">{{ $product->short_description }}</p>
                        </div>
                    @endif
                    
                    <!-- Actions d'achat mobiles optimisées -->
                    <div class="bg-white p-4 rounded-xl shadow-lg space-y-3">
                        <!-- Quantité mobile-friendly -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-sort-numeric-up mr-2"></i>Quantité
                            </label>
                            <div class="flex items-center">
                                <div class="flex items-center bg-gray-100 rounded-lg">
                                    <button id="qty-decrease" class="px-3 py-2 text-gray-600 hover:text-noorea-gold hover:bg-gray-200 rounded-l-lg transition-colors">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" 
                                           id="product-quantity"
                                           value="1" 
                                           min="1" 
                                           max="12"
                                           class="w-12 py-2 text-center bg-transparent border-0 font-semibold focus:outline-none">
                                    <button id="qty-increase" class="px-3 py-2 text-gray-600 hover:text-noorea-gold hover:bg-gray-200 rounded-r-lg transition-colors">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <span class="text-gray-500 text-xs ml-3">12 disponibles</span>
                            </div>
                        </div>
                        
                        <!-- Boutons d'action empilés sur mobile -->
                        <div class="space-y-2">
                            <!-- Bouton principal -->
                            <button class="add-to-cart-btn w-full bg-noorea-gold hover:bg-yellow-600 text-white font-medium py-3 px-4 rounded-xl transition-all duration-200 hover:shadow-lg hover:-translate-y-1 group"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-price="{{ $product->final_price ?? $product->price }}"
                                    data-product-image="{{ $product->main_image }}">
                                <i class="fas fa-shopping-cart mr-2 group-hover:scale-110 transition-transform"></i>
                                <span>Ajouter au panier</span>
                            </button>
                            
                            <!-- Boutons secondaires - Grid responsive -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                <button class="border-2 border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white py-2 px-3 rounded-xl font-medium transition-all duration-300 flex items-center justify-center text-sm">
                                    <i class="fas fa-heart mr-2"></i>
                                    <span class="hidden sm:inline">Favoris</span>
                                    <span class="sm:hidden">♡</span>
                                </button>
                                
                                <button class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white py-2 px-3 rounded-xl font-medium transition-all duration-300 flex items-center justify-center text-sm">
                                    <i class="fas fa-share-alt mr-2"></i>
                                    <span class="hidden sm:inline">Partager</span>
                                    <span class="sm:hidden">⚡</span>
                                </button>
                                
                                <a href="https://wa.me/221777777777?text=Bonjour, je suis intéressé(e) par le produit: {{ urlencode($product->name) }}" 
                                   class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded-xl font-medium transition-all duration-300 flex items-center justify-center text-sm">
                                    <i class="fab fa-whatsapp mr-2"></i>
                                    <span class="hidden sm:inline">WhatsApp</span>
                                    <span class="sm:hidden">📱</span>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Informations de livraison mobiles -->
                        <div class="border-t pt-3 space-y-1.5">
                            <div class="flex items-center text-green-600 text-xs">
                                <i class="fas fa-truck mr-2"></i>
                                <span>Livraison gratuite à partir de 50 000 CFA</span>
                            </div>
                            <div class="flex items-center text-blue-600 text-xs">
                                <i class="fas fa-undo-alt mr-2"></i>
                                <span>Retour gratuit sous 14 jours</span>
                            </div>
                            <div class="flex items-center text-orange-600 text-xs">
                                <i class="fas fa-shield-alt mr-2"></i>
                                <span>Paiement sécurisé</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Description complète - Accordéon mobile -->
            @if($product->description)
                <div class="mt-12 bg-white rounded-xl shadow-lg overflow-hidden">
                    <button class="w-full p-4 text-left border-b hover:bg-gray-50 transition-colors" onclick="toggleDescription()">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg md:text-xl font-serif text-noorea-dark">
                                <i class="fas fa-file-alt mr-2"></i>Description détaillée
                            </h2>
                            <i class="fas fa-chevron-down transition-transform duration-200" id="description-icon"></i>
                        </div>
                    </button>
                    <div class="hidden p-4 bg-gradient-to-br from-pink-50 to-amber-50" id="description-content">
                        <div class="prose max-w-none text-gray-700 leading-relaxed text-sm">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Caractéristiques techniques - Mobile friendly -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <button class="w-full p-4 text-left border-b hover:bg-gray-50 transition-colors" onclick="toggleSpecs()">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg md:text-xl font-serif text-noorea-dark">
                            <i class="fas fa-list-ul mr-2"></i>Caractéristiques
                        </h2>
                        <i class="fas fa-chevron-down transition-transform duration-200" id="specs-icon"></i>
                    </div>
                </button>
                <div class="hidden p-4" id="specs-content">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="flex justify-between py-2 border-b border-gray-100 text-sm">
                            <span class="text-gray-600">Marque:</span>
                            <span class="font-medium">{{ $product->brand->name ?? 'Non spécifiée' }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100 text-sm">
                            <span class="text-gray-600">Catégorie:</span>
                            <span class="font-medium">{{ $product->category->name ?? 'Non spécifiée' }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100 text-sm">
                            <span class="text-gray-600">Référence:</span>
                            <span class="font-medium">{{ $product->sku ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100 text-sm">
                            <span class="text-gray-600">Stock:</span>
                            <span class="font-medium text-green-600">En stock</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript pour les accordéons et intégration avec le système de panier global -->
<script>
    // Fonctions accordéons
    function toggleDescription() {
        const content = document.getElementById('description-content');
        const icon = document.getElementById('description-icon');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }
    
    function toggleSpecs() {
        const content = document.getElementById('specs-content');
        const icon = document.getElementById('specs-icon');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }
    
    // Gestion des quantités et système de panier SIMPLE (comme dans la boutique)
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('product-quantity');
        const decreaseBtn = document.getElementById('qty-decrease');
        const increaseBtn = document.getElementById('qty-increase');
        
        // Gestion des quantités
        if (decreaseBtn) {
            decreaseBtn.addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
        }
        
        if (increaseBtn) {
            increaseBtn.addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value);
                const maxValue = parseInt(quantityInput.getAttribute('max'));
                if (currentValue < maxValue) {
                    quantityInput.value = currentValue + 1;
                }
            });
        }
        
        // Validation de la quantité
        if (quantityInput) {
            quantityInput.addEventListener('input', function() {
                const value = parseInt(this.value);
                const max = parseInt(this.getAttribute('max'));
                if (value < 1) this.value = 1;
                if (value > max) this.value = max;
            });
        }
        
        // Système de panier SIMPLE - comme dans la boutique (index)
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                
                // Animation simple - comme dans la boutique
                const originalIcon = this.querySelector('i').className;
                this.querySelector('i').className = 'fas fa-check mr-2 group-hover:scale-110 transition-transform';
                this.style.backgroundColor = '#10B981';
                
                console.log('Produit ajouté:', productName);
                
                setTimeout(() => {
                    this.querySelector('i').className = originalIcon;
                    this.style.backgroundColor = '';
                }, 2000);
            });
        });
    });
</script>

@push('styles')
<style>
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