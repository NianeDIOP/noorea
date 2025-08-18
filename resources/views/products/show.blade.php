@extends('layouts.app')

@push('head')
<!-- Meta tags et polices d'origine -->
@endpush

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
    background-color: rgba(212, 175, 55, 0.1);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.15);
    border: 1px solid rgba(212, 175, 55, 0.2);
}

.nav-link-gold.active-gold {
    color: #d4af37;
    background-color: rgba(212, 175, 55, 0.15);
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(212, 175, 55, 0.2);
    border: 1px solid rgba(212, 175, 55, 0.3);
}

/* Mobile search bar */
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
    padding-top: 140px;
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
</style>
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

<!-- Contenu compact -->
<div class="pt-32 md:pt-36 pb-8">
    <div class="container mx-auto px-4 py-4">
        
        <!-- Fil d'Ariane -->
        <nav class="text-sm mb-6 text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-noorea-gold">Accueil</a>
            <span class="mx-2">›</span>
            <a href="{{ route('products') }}" class="hover:text-noorea-gold">Boutique</a>
            <span class="mx-2">›</span>
            <span class="text-noorea-gold">{{ $product->name }}</span>
        </nav>

        <!-- Section produit principale -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Image produit -->
                <div>
                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                        @if($product->main_image_url)
                            <img src="{{ $product->main_image_url }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-6xl"></i>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Informations produit -->
                <div class="space-y-4">
                    
                    <!-- Titre et marque -->
                    <div>
                        @if($product->brand)
                        <p class="text-sm text-noorea-gold mb-1">{{ $product->brand->name }}</p>
                        @endif
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                        @if($product->category)
                        <span class="inline-block bg-gray-100 px-3 py-1 rounded-full text-xs text-gray-600">
                            {{ $product->category->name }}
                        </span>
                        @endif
                    </div>
                    
                    <!-- Prix -->
                    <div class="py-2">
                        <div class="text-3xl font-bold text-noorea-gold">
                            {{ number_format($product->price ?? 0, 0, ',', ' ') }} FCFA
                        </div>
                    </div>
                    
                    <!-- Description courte -->
                    @if($product->short_description)
                    <div class="py-2">
                        <p class="text-gray-600">{{ $product->short_description }}</p>
                    </div>
                    @endif
                    
                    <!-- Actions d'achat -->
                    <div class="space-y-4 pt-4">
                        
                        <!-- Quantité -->
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">Quantité :</span>
                            <div class="flex items-center border rounded">
                                <button type="button" id="decrease-qty" class="p-2 hover:bg-gray-50">
                                    <i class="fas fa-minus text-sm"></i>
                                </button>
                                <input type="number" id="quantity" value="1" min="1" max="999" class="w-12 text-center border-0 text-sm">
                                <button type="button" id="increase-qty" class="p-2 hover:bg-gray-50">
                                    <i class="fas fa-plus text-sm"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Bouton principal -->
                        <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" id="cart-quantity" value="1">
                            <button type="submit" id="add-to-cart-btn" class="w-full bg-noorea-gold hover:bg-yellow-600 text-white py-3 rounded font-medium transition-colors">
                                <i class="fas fa-shopping-cart mr-2"></i>Ajouter au panier
                            </button>
                        </form>
                        
                        <!-- Boutons secondaires -->
                        <div class="grid grid-cols-2 gap-3">
                            <button class="border border-gray-300 py-2 rounded text-sm hover:border-noorea-gold">
                                <i class="fas fa-heart mr-1"></i>Favoris
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white py-2 rounded text-sm">
                                <i class="fab fa-whatsapp mr-1"></i>WhatsApp
                            </button>
                        </div>
                        
                        <!-- Infos livraison -->
                        <div class="bg-gray-50 rounded p-3 text-sm text-gray-600">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-truck mr-2 text-green-500"></i>
                                Livraison gratuite dès 50 000 FCFA
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt mr-2 text-blue-500"></i>
                                Garantie incluse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description détaillée -->
        @if($product->description)
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-bold mb-3">Description</h3>
            <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
        </div>
        @endif        <!-- Produits similaires -->
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-bold mb-4">Produits similaires</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relatedProducts as $similar)
                <div class="group">
                    <a href="{{ route('products.show', $similar->slug) }}" class="block">
                        <div class="bg-gray-100 aspect-square rounded-lg overflow-hidden mb-2">
                            @if($similar->main_image_url)
                                <img src="{{ $similar->main_image_url }}" 
                                     alt="{{ $similar->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        <h4 class="text-sm font-medium text-gray-800 mb-1 line-clamp-2">{{ $similar->name }}</h4>
                        <div class="text-sm font-bold text-noorea-gold">
                            {{ number_format($similar->price ?? 0, 0, ',', ' ') }} FCFA
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attendre que NooreaCart soit initialisé
        const initializeProductDetailPage = () => {
            // Vérifier si NooreaCart est disponible
            if (!window.NooreaCart) {
                console.log('NooreaCart non encore disponible, retry dans 100ms...');
                setTimeout(initializeProductDetailPage, 100);
                return;
            }
            
            console.log('NooreaCart disponible, initialisation de la page détail produit');
            
            // Éléments
            const quantityInput = document.getElementById('quantity');
            const cartQuantityInput = document.getElementById('cart-quantity');
            const decreaseBtn = document.getElementById('decrease-qty');
            const increaseBtn = document.getElementById('increase-qty');
            const addToCartForm = document.getElementById('add-to-cart-form');
            const addToCartBtn = document.getElementById('add-to-cart-btn');

            // Fonction pour mettre à jour la quantité
            function updateQuantity(newValue) {
                if (newValue >= 1 && newValue <= 999) {
                    quantityInput.value = newValue;
                    cartQuantityInput.value = newValue;
                }
            }

            // Bouton diminuer
            decreaseBtn.addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value) || 1;
                updateQuantity(currentValue - 1);
            });

            // Bouton augmenter  
            increaseBtn.addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value) || 1;
                updateQuantity(currentValue + 1);
            });

            // Input quantité change
            quantityInput.addEventListener('input', function() {
                const value = parseInt(this.value) || 1;
                updateQuantity(value);
            });

            // Soumission du formulaire - utiliser le système global NooreaCart
            addToCartForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Désactiver le bouton temporairement
                addToCartBtn.disabled = true;
                addToCartBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Ajout en cours...';

                // Données du produit
                const productId = this.querySelector('input[name="product_id"]').value;
                const quantity = parseInt(this.querySelector('input[name="quantity"]').value);
                const productName = '{{ $product->name }}';
                const productPrice = '{{ $product->final_price }}';
                const productImage = '{{ $product->main_image_url ?? asset("images/logo.svg") }}';

                console.log('Ajout au panier via NooreaCart:', { productId, quantity, productName, productPrice });

                // Utiliser le système global NooreaCart
                window.NooreaCart.addToCart(productId, productName, productPrice, productImage, quantity)
                    .then(success => {
                        if (success) {
                            // Succès - changer le bouton temporairement
                            addToCartBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Ajouté !';
                            addToCartBtn.classList.remove('bg-noorea-gold', 'hover:bg-yellow-600');
                            addToCartBtn.classList.add('bg-green-500');
                            
                            // Restaurer le bouton après 2 secondes
                            setTimeout(() => {
                                addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart mr-2"></i>Ajouter au panier';
                                addToCartBtn.classList.remove('bg-green-500');
                                addToCartBtn.classList.add('bg-noorea-gold', 'hover:bg-yellow-600');
                                addToCartBtn.disabled = false;
                            }, 2000);
                            
                        } else {
                            throw new Error('Erreur lors de l\'ajout au panier');
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        
                        // Erreur - restaurer le bouton
                        addToCartBtn.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>Erreur';
                        addToCartBtn.classList.remove('bg-noorea-gold', 'hover:bg-yellow-600');
                        addToCartBtn.classList.add('bg-red-500');
                        
                        // Restaurer après 3 secondes
                        setTimeout(() => {
                            addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart mr-2"></i>Ajouter au panier';
                            addToCartBtn.classList.remove('bg-red-500');
                            addToCartBtn.classList.add('bg-noorea-gold', 'hover:bg-yellow-600');
                            addToCartBtn.disabled = false;
                        }, 3000);
                        
                        // Afficher l'erreur
                        alert('Erreur lors de l\'ajout au panier. Veuillez réessayer.');
                    });
            });
        };
        
        // Démarrer l'initialisation
        initializeProductDetailPage();
    });
    </script>
</div>
@endsection