@extends('layouts.app')

@section('title', 'Mon Panier')

@section('navbar')
<!-- Navbar Supérieur -->
<header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <!-- Barre supérieure avec logo, recherche et icônes -->
    <div class="backdrop-blur-sm bg-white border-b border-gray-200 shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
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
                            class="w-full px-5 py-3 pl-12 pr-14 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-all duration-300 shadow-sm text-gray-800 placeholder-gray-500 font-medium"
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
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">{{ $itemCount ?? 0 }}</span>
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
    <div class="backdrop-blur-sm border-t border-gray-200" style="background-color: #F7EAD5;">
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
                    
                    <!-- Actions utilisateur mobiles -->
                    @auth
                        <a href="{{ route('account.dashboard') }}" class="flex items-center py-3 px-2 text-noorea-gold hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-user mr-3 w-5"></i>Mon compte
                        </a>
                        <a href="{{ route('wishlist') }}" class="flex items-center py-3 px-2 text-noorea-gold hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-heart mr-3 w-5"></i>Ma wishlist
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full flex items-center py-3 px-2 text-red-600 hover:bg-gray-50 rounded-lg">
                                <i class="fas fa-sign-out-alt mr-3 w-5"></i>Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center py-3 px-2 text-noorea-gold hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-sign-in-alt mr-3 w-5"></i>Se connecter
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center py-3 px-2 text-noorea-gold hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-user-plus mr-3 w-5"></i>S'inscrire
                        </a>
                    @endauth
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
<div class="min-h-screen bg-gray-50 pt-24 md:pt-32 pb-12">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header du panier - plus compact -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Mon Panier</h1>
                    <p class="text-sm text-gray-600">
                        @if($itemCount > 0)
                            {{ $itemCount }} {{ $itemCount > 1 ? 'articles' : 'article' }} dans votre panier
                        @else
                            Votre panier est vide
                        @endif
                    </p>
                </div>
                <div class="mt-3 sm:mt-0">
                    <a href="{{ route('products') }}" 
                       class="inline-flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                        <i class="fas fa-arrow-left mr-2 text-xs"></i>
                        Continuer mes achats
                    </a>
                </div>
            </div>

            @if($itemCount > 0)
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <!-- Articles du panier - 3 colonnes -->
                    <div class="lg:col-span-3">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                            <!-- En-têtes (desktop seulement) -->
                            <div class="hidden md:grid md:grid-cols-12 md:gap-4 px-4 py-3 border-b border-gray-100 bg-gray-50">
                                <div class="col-span-6 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Produit
                                </div>
                                <div class="col-span-2 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Prix
                                </div>
                                <div class="col-span-2 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Quantité
                                </div>
                                <div class="col-span-2 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Total
                                </div>
                            </div>

                            <!-- Articles -->
                            <div class="divide-y divide-gray-100">
                                @foreach($cart as $productId => $item)
                                    <div class="p-4">
                                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                                            <!-- Produit (mobile + desktop) -->
                                            <div class="col-span-1 md:col-span-6">
                                                <div class="flex items-start space-x-3">
                                                    <!-- Image - plus petite -->
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ $item['image'] ?? asset('images/logo.png') }}" 
                                                             alt="{{ $item['name'] }}" 
                                                             class="w-16 h-16 object-cover rounded-lg border border-gray-100"
                                                             onerror="this.src='{{ asset('images/logo.png') }}';">
                                                    </div>
                                                    
                                                    <!-- Informations - plus compactes -->
                                                    <div class="flex-1 min-w-0">
                                                        <h3 class="font-semibold text-gray-900 text-base mb-1">{{ $item['name'] }}</h3>
                                                        <p class="text-xs text-gray-500 mb-1">{{ $item['brand'] ?? 'Noorea' }}</p>
                                                        
                                                        <!-- Prix (mobile seulement) -->
                                                        <div class="md:hidden text-base font-semibold text-noorea-gold mb-2">
                                                            {{ number_format($item['price'], 0, ',', '.') }} FCFA
                                                        </div>
                                                        
                                                        <!-- Actions mobiles -->
                                                        <div class="md:hidden flex items-center justify-between">
                                                            <!-- Quantité mobile - plus petite -->
                                                            <div class="flex items-center space-x-2 bg-gray-50 rounded-md px-2 py-1">
                                                                <button class="decrease-qty w-6 h-6 bg-white border border-gray-200 text-gray-700 rounded-full flex items-center justify-center hover:border-noorea-gold hover:text-noorea-gold transition-colors text-xs" 
                                                                        data-id="{{ $productId }}">
                                                                    <i class="fas fa-minus text-xs"></i>
                                                                </button>
                                                                <span class="font-medium text-sm w-6 text-center" id="qty-{{ $productId }}">{{ $item['quantity'] }}</span>
                                                                <button class="increase-qty w-6 h-6 bg-noorea-gold text-white rounded-full flex items-center justify-center hover:bg-yellow-600 transition-colors" 
                                                                        data-id="{{ $productId }}">
                                                                    <i class="fas fa-plus text-xs"></i>
                                                                </button>
                                                            </div>
                                                            
                                                            <!-- Total mobile -->
                                                            <div class="text-right">
                                                                <div class="text-base font-bold text-gray-900" id="total-{{ $productId }}">
                                                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} FCFA
                                                                </div>
                                                                <button class="remove-item text-red-500 hover:text-red-700 text-xs mt-1" 
                                                                        data-id="{{ $productId }}">
                                                                    <i class="fas fa-trash mr-1"></i>Supprimer
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Prix (desktop seulement) -->
                                            <div class="col-span-2 text-center hidden md:block">
                                                <span class="text-base font-semibold text-noorea-gold">
                                                    {{ number_format($item['price'], 0, ',', '.') }} FCFA
                                                </span>
                                            </div>
                                            
                                            <!-- Quantité (desktop seulement) -->
                                            <div class="col-span-2 hidden md:flex md:justify-center">
                                                <div class="flex items-center space-x-2 bg-gray-50 rounded-md px-2 py-1">
                                                    <button class="decrease-qty w-6 h-6 bg-white border border-gray-200 text-gray-700 rounded-full flex items-center justify-center hover:border-noorea-gold hover:text-noorea-gold transition-colors" 
                                                            data-id="{{ $productId }}">
                                                        <i class="fas fa-minus text-xs"></i>
                                                    </button>
                                                    <span class="font-medium text-sm w-6 text-center" id="qty-desktop-{{ $productId }}">{{ $item['quantity'] }}</span>
                                                    <button class="increase-qty w-6 h-6 bg-noorea-gold text-white rounded-full flex items-center justify-center hover:bg-yellow-600 transition-colors" 
                                                            data-id="{{ $productId }}">
                                                        <i class="fas fa-plus text-xs"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <!-- Total (desktop seulement) -->
                                            <div class="col-span-2 text-center hidden md:block">
                                                <div class="text-base font-bold text-gray-900" id="total-desktop-{{ $productId }}">
                                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} FCFA
                                                </div>
                                                <button class="remove-item text-red-500 hover:text-red-700 text-xs mt-1" 
                                                        data-id="{{ $productId }}">
                                                    <i class="fas fa-trash mr-1"></i>Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Résumé de la commande - 1 colonne -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-sm p-4 sticky top-32">
                            <h2 class="text-lg font-bold text-gray-900 mb-4">Résumé</h2>
                            
                            <!-- Détails -->
                            <div class="space-y-3 mb-4">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">Sous-total</span>
                                    <span id="cart-subtotal" class="font-medium">{{ number_format($total, 0, ',', '.') }} FCFA</span>
                                </div>
                                
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">Livraison</span>
                                    <span class="text-gray-600">À calculer</span>
                                </div>
                                
                                <hr class="border-gray-200">
                                
                                <div class="flex justify-between items-center text-base font-bold">
                                    <span>Total</span>
                                    <span id="cart-total" class="text-noorea-gold">{{ number_format($total, 0, ',', '.') }} FCFA</span>
                                </div>
                            </div>
                            
                            <!-- Note livraison - plus compacte -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-info-circle text-blue-500 mt-0.5 text-sm"></i>
                                    <div class="text-xs text-blue-800">
                                        <p class="font-medium mb-1">Livraison Dakar</p>
                                        <p>Frais calculés sur WhatsApp</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Actions - boutons plus petits -->
                            <div class="space-y-2">
                                <!-- Bouton WhatsApp principal -->
                                <button id="whatsapp-order" class="w-full bg-green-500 hover:bg-green-600 text-white py-2.5 px-4 rounded-lg font-medium text-sm transition-colors flex items-center justify-center space-x-2">
                                    <i class="fab fa-whatsapp text-base"></i>
                                    <span>Commander</span>
                                </button>
                                
                                <!-- Bouton Noorea Gold -->
                                <button class="w-full bg-noorea-gold hover:bg-yellow-600 text-white py-2 px-4 rounded-lg font-medium text-sm transition-colors flex items-center justify-center space-x-2">
                                    <i class="fas fa-phone text-xs"></i>
                                    <span>Appeler</span>
                                </button>
                                
                                <!-- Vider le panier -->
                                <button class="clear-cart w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-1.5 px-4 rounded-lg transition-colors text-xs">
                                    <i class="fas fa-trash mr-1"></i>Vider le panier
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Panier vide - plus compact -->
                <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                    <div class="max-w-sm mx-auto">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shopping-cart text-2xl text-gray-400"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Panier vide</h2>
                        <p class="text-gray-600 mb-6 text-sm">Découvrez notre collection de produits de beauté.</p>
                        <a href="{{ route('products') }}" 
                           class="inline-flex items-center bg-noorea-gold text-white px-6 py-2.5 rounded-lg font-medium hover:bg-yellow-600 transition-colors text-sm">
                            <i class="fas fa-shopping-bag mr-2"></i>
                            Voir nos produits
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Synchronisation du mini panier avec la page panier
    function syncMiniCartWithCartPage() {
        // Attendre que NooreaCart soit disponible
        if (window.NooreaCart) {
            console.log('Synchronisation du mini panier avec la page panier');
            // Charger le panier depuis le serveur pour s'assurer que tout est à jour
            window.NooreaCart.loadExistingCart();
        } else {
            // Retry si NooreaCart n'est pas encore chargé
            setTimeout(syncMiniCartWithCartPage, 100);
        }
    }
    
    // Démarrer la synchronisation
    syncMiniCartWithCartPage();
    
    // Fonction pour formater le prix
    function formatPrice(price) {
        return new Intl.NumberFormat('fr-FR').format(price) + ' FCFA';
    }
    
    // Fonction pour mettre à jour les totaux
    function updateTotals() {
        let total = 0;
        let itemCount = 0;
        
        // Calculer le total à partir des éléments visibles
        document.querySelectorAll('[id^="total-"]').forEach(element => {
            const priceText = element.textContent.replace(/[^\d]/g, '');
            total += parseInt(priceText) || 0;
        });
        
        document.querySelectorAll('[id^="qty-"]').forEach(element => {
            itemCount += parseInt(element.textContent) || 0;
        });
        
        // Mettre à jour l'affichage
        document.getElementById('cart-subtotal').textContent = formatPrice(total);
        document.getElementById('cart-total').textContent = formatPrice(total);
        
        // Mettre à jour le badge du panier dans le navbar
        const cartBadge = document.querySelector('.fa-shopping-cart + span');
        if (cartBadge) {
            cartBadge.textContent = Math.floor(itemCount / 2); // Division par 2 car on a mobile + desktop
        }
    }
    
    // Fonction pour synchroniser les quantités mobile/desktop
    function syncQuantity(productId, quantity) {
        const mobileQty = document.getElementById(`qty-${productId}`);
        const desktopQty = document.getElementById(`qty-desktop-${productId}`);
        const mobileTotal = document.getElementById(`total-${productId}`);
        const desktopTotal = document.getElementById(`total-desktop-${productId}`);
        
        if (mobileQty) mobileQty.textContent = quantity;
        if (desktopQty) desktopQty.textContent = quantity;
        
        // Recalculer le total (prix sera récupéré depuis l'élément prix)
        const priceElements = document.querySelectorAll('.text-noorea-gold');
        let price = 0;
        priceElements.forEach(el => {
            const parentRow = el.closest('[data-product-id="' + productId + '"]') || 
                             el.closest('.grid').querySelector(`[data-id="${productId}"]`)?.closest('.grid');
            if (parentRow && parentRow.contains(el)) {
                price = parseInt(el.textContent.replace(/[^\d]/g, ''));
            }
        });
        
        const newTotal = price * quantity;
        if (mobileTotal) mobileTotal.textContent = formatPrice(newTotal);
        if (desktopTotal) desktopTotal.textContent = formatPrice(newTotal);
    }
    
    // Événements pour augmenter la quantité
    document.querySelectorAll('.increase-qty').forEach(btn => {
        btn.addEventListener('click', async function() {
            const productId = this.getAttribute('data-id');
            const qtyElement = document.getElementById(`qty-${productId}`) || 
                              document.getElementById(`qty-desktop-${productId}`);
            const currentQty = parseInt(qtyElement.textContent);
            const newQty = currentQty + 1;
            
            try {
                const response = await fetch(`/panier/modifier/${productId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ quantity: newQty })
                });
                
                if (response.ok) {
                    syncQuantity(productId, newQty);
                    updateTotals();
                    // Synchroniser le mini panier
                    if (window.NooreaCart) {
                        window.NooreaCart.loadExistingCart();
                    }
                }
            } catch (error) {
                console.error('Erreur:', error);
            }
        });
    });
    
    // Événements pour diminuer la quantité
    document.querySelectorAll('.decrease-qty').forEach(btn => {
        btn.addEventListener('click', async function() {
            const productId = this.getAttribute('data-id');
            const qtyElement = document.getElementById(`qty-${productId}`) || 
                              document.getElementById(`qty-desktop-${productId}`);
            const currentQty = parseInt(qtyElement.textContent);
            
            if (currentQty <= 1) {
                if (confirm('Voulez-vous supprimer cet article du panier ?')) {
                    removeItem(productId);
                }
                return;
            }
            
            const newQty = currentQty - 1;
            
            try {
                const response = await fetch(`/panier/modifier/${productId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ quantity: newQty })
                });
                
                if (response.ok) {
                    syncQuantity(productId, newQty);
                    updateTotals();
                    // Synchroniser le mini panier
                    if (window.NooreaCart) {
                        window.NooreaCart.loadExistingCart();
                    }
                }
            } catch (error) {
                console.error('Erreur:', error);
            }
        });
    });
    
    // Fonction pour supprimer un article
    async function removeItem(productId) {
        try {
            const response = await fetch(`/panier/supprimer/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });
            
            if (response.ok) {
                // Synchroniser le mini panier avant de recharger la page
                if (window.NooreaCart) {
                    window.NooreaCart.loadExistingCart();
                }
                location.reload();
            }
        } catch (error) {
            console.error('Erreur:', error);
        }
    }
    
    // Événements pour supprimer un article
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            if (confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
                removeItem(productId);
            }
        });
    });
    
    // Événement pour vider le panier
    document.querySelector('.clear-cart')?.addEventListener('click', async function() {
        if (confirm('Êtes-vous sûr de vouloir vider votre panier ?')) {
            try {
                const response = await fetch('/panier/vider', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    // Synchroniser le mini panier avant de recharger la page
                    if (window.NooreaCart) {
                        window.NooreaCart.loadExistingCart();
                    }
                    location.reload();
                }
            } catch (error) {
                console.error('Erreur:', error);
            }
        }
    });
    
    // Commande WhatsApp
    document.getElementById('whatsapp-order')?.addEventListener('click', function() {
        // Construire le message de commande
        let message = "🛒 *Nouvelle commande Noorea Beauty*\\n\\n";
        message += "📋 *Détails de la commande :*\\n";
        
        @if($itemCount > 0)
            @foreach($cart as $productId => $item)
                message += "• {{ addslashes($item['name']) }} ({{ $item['quantity'] }}x) - {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} FCFA\\n";
            @endforeach
        @endif
        
        message += "\\n💰 *Total estimé :* {{ number_format($total, 0, ',', '.') }} FCFA";
        message += "\\n\\n📍 *Informations de livraison :*\\n";
        message += "- Nom complet : \\n";
        message += "- Téléphone : \\n";
        message += "- Adresse complète : \\n";
        message += "- Commune/Ville : \\n";
        
        message += "\\n\\n✨ *Merci de choisir Noorea Beauty !*";
        
        // Numéro WhatsApp de Noorea
        const whatsappNumber = "221781029818"; // Format : code pays + numéro (+221 78 102 98 18)
        const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
        
        window.open(whatsappUrl, '_blank');
    });
});
</script>
@endpush

@push('head')
<style>
/* Styles pour la navbar supérieure - pages intérieures */
.navbar-icon-top {
    color: #d4af37;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 50%;
    transform: scale(1);
    background-color: rgba(212, 175, 55, 0.1);
    backdrop-filter: blur(2px);
    border: 1px solid rgba(212, 175, 55, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 3rem;
    height: 3rem;
}

.navbar-icon-top:hover {
    color: #d4af37;
    background-color: rgba(212, 175, 55, 0.2);
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
    border: 1px solid rgba(212, 175, 55, 0.4);
}

/* Masquer recherche mobile sur desktop */
@media (min-width: 768px) {
    .mobile-only {
        display: none !important;
    }
    .desktop-auth {
        display: flex !important;
    }
    .desktop-search {
        display: flex !important;
    }
}

/* Masquer éléments desktop sur mobile */
@media (max-width: 767px) {
    .desktop-auth {
        display: none !important;
    }
    .desktop-search {
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

/* Styles pour la navbar inférieure */
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

/* Styles pour le header */
header {
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
}
</style>
@endpush
@endsection
