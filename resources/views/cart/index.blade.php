@extends('layouts.app')

@section('navbar')
<header class="absolute top-0 left-0 w-full z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between bg-transparent backdrop-blur-none px-4 py-3">
            <!-- Logo Premium -->
            <a href="{{ route('home') }}" class="flex items-center group">
                <div class="relative">
                    <!-- Logo principal -->
                    <div class="relative p-2 group-hover:scale-110 transition-all duration-300 rounded-xl">
                        <img src="{{ asset('images/logo.png') }}" alt="Noorea - L'élégance multiculturelle" class="h-12 md:h-16 lg:h-20 w-auto drop-shadow-sm transition-all duration-300">
                    </div>
                    <!-- Particules décoratives -->
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-noorea-gold rounded-full animate-pulse opacity-80"></div>
                    <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-noorea-gold rounded-full animate-pulse opacity-70" style="animation-delay: 0.5s;"></div>
                </div>
            </a>
            <!-- Navigation principale - desktop -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="nav-link-dark {{ request()->routeIs('home') ? 'active-dark' : '' }}">Accueil</a>
                <a href="{{ route('products') }}" class="nav-link-dark {{ request()->routeIs('products') ? 'active-dark' : '' }}">Boutique</a>
                <a href="{{ route('categories') }}" class="nav-link-dark {{ request()->routeIs('categories') ? 'active-dark' : '' }}">Catégories</a>
                <a href="{{ route('brands') }}" class="nav-link-dark {{ request()->routeIs('brands') ? 'active-dark' : '' }}">Marques</a>
                <a href="{{ route('blog') }}" class="nav-link-dark {{ request()->routeIs('blog') ? 'active-dark' : '' }}">Beauté du Monde</a>
                <a href="{{ route('about') }}" class="nav-link-dark {{ request()->routeIs('about') ? 'active-dark' : '' }}">À propos</a>
            </nav>
            <!-- Actions utilisateur -->
            <div class="flex items-center space-x-5">
                <!-- Recherche -->
                <button type="button" class="navbar-icon text-lg" aria-label="Rechercher">
                    <i class="fas fa-search"></i>
                </button>
                <!-- Compte utilisateur -->
                <a href="{{ route('account') }}" class="navbar-icon text-lg" aria-label="Mon compte">
                    <i class="fas fa-user"></i>
                </a>
                <!-- Wishlist -->
                <a href="{{ route('wishlist') }}" class="navbar-icon text-lg" aria-label="Ma wishlist">
                    <i class="fas fa-heart"></i>
                </a>
                <!-- Panier -->
                <a href="{{ route('cart') }}" class="text-noorea-gold drop-shadow-lg transition-all duration-300 text-lg relative" aria-label="Mon panier">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="absolute -top-2 -right-2 bg-noorea-rose text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">3</span>
                </a>
                <!-- Menu mobile toggle -->
                <button type="button" class="text-white drop-shadow-lg md:hidden transition-all duration-300 text-lg hover:scale-110" id="mobile-menu-button" aria-label="Menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <!-- Menu mobile -->
        <div class="md:hidden hidden bg-black/80 backdrop-blur-md rounded-lg mt-4 border border-noorea-gold/30" id="mobile-menu">
            <nav class="flex flex-col space-y-4 p-6">
                <a href="{{ route('home') }}" class="nav-link-dark {{ request()->routeIs('home') ? 'active-dark' : '' }}">Accueil</a>
                <a href="{{ route('products') }}" class="nav-link-dark {{ request()->routeIs('products') ? 'active-dark' : '' }}">Boutique</a>
                <a href="{{ route('categories') }}" class="nav-link-dark {{ request()->routeIs('categories') ? 'active-dark' : '' }}">Catégories</a>
                <a href="{{ route('brands') }}" class="nav-link-dark {{ request()->routeIs('brands') ? 'active-dark' : '' }}">Marques</a>
                <a href="{{ route('blog') }}" class="nav-link-dark {{ request()->routeIs('blog') ? 'active-dark' : '' }}">Beauté du Monde</a>
                <a href="{{ route('about') }}" class="nav-link-dark {{ request()->routeIs('about') ? 'active-dark' : '' }}">À propos</a>
            </nav>
        </div>
    </div>
</header>
@endsection

@section('content')
<!-- Hero Section - Mini banner panier -->
<section class="relative h-80 overflow-hidden bg-gradient-to-br from-noorea-dark via-noorea-cream to-noorea-gold/30 pt-24 md:pt-28">
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=1920&h=400&fit=crop')] bg-cover bg-center opacity-20"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-noorea-dark/70 to-transparent"></div>
    
    <div class="relative z-30 flex items-center h-full">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl">
                <nav class="text-noorea-gold mb-4 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-yellow-300">Accueil</a>
                    <span class="mx-2">/</span>
                    <span class="text-white">Mon panier</span>
                </nav>
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">
                    Mon Panier
                </h1>
                <p class="text-xl text-gray-200">
                    3 produits sélectionnés avec soin
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contenu principal panier -->
<div class="bg-noorea-cream/30 py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Liste des produits -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Produit 1 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="relative">
                            <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop" 
                                 alt="Crème Hydratante Premium" class="w-32 h-32 object-cover rounded-xl">
                            <button class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full text-xs hover:bg-red-600 transition-colors">
                                ×
                            </button>
                        </div>
                        
                        <div class="flex-1 space-y-4">
                            <div>
                                <h3 class="text-xl font-semibold text-noorea-dark mb-2">Crème Hydratante Premium aux Extraits de Karité</h3>
                                <p class="text-sm text-gray-600">Taille: 50ml • Marque: Noorea Premium</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="text-sm bg-noorea-emerald/10 text-noorea-emerald px-2 py-1 rounded-full">En stock</span>
                                    <span class="text-sm bg-noorea-rose/10 text-noorea-rose px-2 py-1 rounded-full">-15%</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <button class="w-8 h-8 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 text-gray-600">-</button>
                                    <span class="w-12 text-center font-medium">1</span>
                                    <button class="w-8 h-8 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 text-gray-600">+</button>
                                </div>
                                
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-noorea-dark">34,90€</div>
                                    <div class="text-sm text-gray-400 line-through">41,00€</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Produit 2 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="relative">
                            <img src="https://images.pexels.com/photos/4465659/pexels-photo-4465659.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop" 
                                 alt="Sérum Vitamine C" class="w-32 h-32 object-cover rounded-xl">
                            <button class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full text-xs hover:bg-red-600 transition-colors">
                                ×
                            </button>
                        </div>
                        
                        <div class="flex-1 space-y-4">
                            <div>
                                <h3 class="text-xl font-semibold text-noorea-dark mb-2">Sérum Vitamine C Éclaircissant</h3>
                                <p class="text-sm text-gray-600">Taille: 30ml • Marque: Noorea Premium</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="text-sm bg-noorea-emerald/10 text-noorea-emerald px-2 py-1 rounded-full">En stock</span>
                                    <span class="text-sm bg-noorea-gold/10 text-noorea-gold px-2 py-1 rounded-full">Nouveau</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <button class="w-8 h-8 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 text-gray-600">-</button>
                                    <span class="w-12 text-center font-medium">2</span>
                                    <button class="w-8 h-8 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 text-gray-600">+</button>
                                </div>
                                
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-noorea-dark">57,80€</div>
                                    <div class="text-sm text-gray-500">28,90€ x 2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Produit 3 -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="relative">
                            <img src="https://images.pexels.com/photos/4465124/pexels-photo-4465124.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop" 
                                 alt="Huile d'Argan" class="w-32 h-32 object-cover rounded-xl">
                            <button class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full text-xs hover:bg-red-600 transition-colors">
                                ×
                            </button>
                        </div>
                        
                        <div class="flex-1 space-y-4">
                            <div>
                                <h3 class="text-xl font-semibold text-noorea-dark mb-2">Huile d'Argan Pure Bio</h3>
                                <p class="text-sm text-gray-600">Taille: 50ml • Marque: Noorea Naturel</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="text-sm bg-noorea-emerald/10 text-noorea-emerald px-2 py-1 rounded-full">En stock</span>
                                    <span class="text-sm bg-green-100 text-green-700 px-2 py-1 rounded-full">Bio</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <button class="w-8 h-8 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 text-gray-600">-</button>
                                    <span class="w-12 text-center font-medium">1</span>
                                    <button class="w-8 h-8 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 text-gray-600">+</button>
                                </div>
                                
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-noorea-dark">32,50€</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions panier -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button class="flex-1 border border-gray-300 text-gray-700 hover:bg-gray-50 py-3 rounded-xl font-medium transition-all duration-300">
                        <i class="fas fa-trash mr-2"></i>
                        Vider le panier
                    </button>
                    <button class="flex-1 border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white py-3 rounded-xl font-medium transition-all duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Continuer mes achats
                    </button>
                </div>
            </div>
            
            <!-- Résumé de commande -->
            <div class="space-y-6">
                <!-- Résumé -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-serif font-bold text-noorea-dark mb-6">Résumé</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sous-total (4 articles)</span>
                            <span class="font-medium">125,20€</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Réduction</span>
                            <span class="text-noorea-rose font-medium">-6,10€</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Livraison</span>
                            <span class="text-noorea-emerald font-medium">Gratuite</span>
                        </div>
                        <div class="border-t pt-4">
                            <div class="flex justify-between text-lg">
                                <span class="font-semibold text-noorea-dark">Total</span>
                                <span class="font-bold text-noorea-dark">119,10€</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">TVA incluse</p>
                        </div>
                    </div>
                    
                    <button class="w-full bg-noorea-gold hover:bg-noorea-gold/90 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-300 hover:scale-105 shadow-lg mb-4">
                        <i class="fas fa-lock mr-2"></i>
                        Passer la commande
                    </button>
                    
                    <!-- Méthodes de paiement -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-3">Paiement sécurisé par :</p>
                        <div class="flex justify-center items-center gap-3">
                            <div class="w-10 h-6 bg-blue-600 rounded text-white text-xs flex items-center justify-center font-bold">VISA</div>
                            <div class="w-10 h-6 bg-red-600 rounded text-white text-xs flex items-center justify-center font-bold">MC</div>
                            <div class="w-10 h-6 bg-blue-500 rounded text-white text-xs flex items-center justify-center font-bold">PP</div>
                            <div class="w-10 h-6 bg-gray-800 rounded text-white text-xs flex items-center justify-center font-bold">AE</div>
                        </div>
                    </div>
                </div>
                
                <!-- Code promo -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-noorea-dark mb-4">Code promo</h3>
                    
                    <div class="flex gap-3">
                        <input type="text" placeholder="Code de réduction" 
                               class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-noorea-gold focus:ring-1 focus:ring-noorea-gold">
                        <button class="bg-noorea-emerald hover:bg-noorea-emerald/90 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Appliquer
                        </button>
                    </div>
                    
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Profitez de -10% avec le code NOOREA10
                    </p>
                </div>
                
                <!-- Livraison -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-noorea-dark mb-4">Livraison</h3>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-noorea-gold bg-noorea-gold/5 rounded-lg cursor-pointer">
                            <input type="radio" name="shipping" value="standard" checked class="text-noorea-gold">
                            <div class="ml-3 flex-1">
                                <div class="font-medium text-noorea-dark">Standard (Gratuit)</div>
                                <div class="text-sm text-gray-600">3-5 jours ouvrés</div>
                            </div>
                            <div class="text-noorea-emerald font-semibold">0€</div>
                        </label>
                        
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-noorea-gold">
                            <input type="radio" name="shipping" value="express" class="text-noorea-gold">
                            <div class="ml-3 flex-1">
                                <div class="font-medium text-noorea-dark">Express</div>
                                <div class="text-sm text-gray-600">1-2 jours ouvrés</div>
                            </div>
                            <div class="font-semibold">7,90€</div>
                        </label>
                        
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-noorea-gold">
                            <input type="radio" name="shipping" value="same-day" class="text-noorea-gold">
                            <div class="ml-3 flex-1">
                                <div class="font-medium text-noorea-dark">Même jour</div>
                                <div class="text-sm text-gray-600">Avant 18h (Dakar)</div>
                            </div>
                            <div class="font-semibold">15,00€</div>
                        </label>
                    </div>
                </div>
                
                <!-- Garanties -->
                <div class="bg-noorea-cream/30 rounded-xl p-4 space-y-3">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-shield-alt text-noorea-emerald"></i>
                        <span class="text-sm text-gray-700">Paiement 100% sécurisé</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-undo text-noorea-gold"></i>
                        <span class="text-sm text-gray-700">Retours gratuits sous 30 jours</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-headset text-noorea-emerald"></i>
                        <span class="text-sm text-gray-700">Service client 7j/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section vous pourriez aimer -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-noorea-dark mb-4">Vous pourriez aussi aimer</h2>
            <p class="text-gray-600">Complétez votre routine beauté</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Produit recommandé 1 -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Masque Argile" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-rose text-white px-2 py-1 rounded-full text-xs">
                        Recommandé
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-noorea-dark mb-2">Masque à l'Argile Blanche</h3>
                    <p class="text-sm text-gray-600 mb-3">Masque purifiant hebdomadaire</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-noorea-emerald">19,90€</span>
                        <button class="bg-noorea-gold text-white px-3 py-1 rounded-lg text-sm hover:bg-noorea-gold/90 transition-colors">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Produit recommandé 2 -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Nettoyant Visage" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-noorea-dark mb-2">Nettoyant Doux Visage</h3>
                    <p class="text-sm text-gray-600 mb-3">Gel nettoyant pour tous types de peau</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-noorea-emerald">16,50€</span>
                        <button class="bg-noorea-gold text-white px-3 py-1 rounded-lg text-sm hover:bg-noorea-gold/90 transition-colors">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Produit recommandé 3 -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Exfoliant Doux" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-emerald text-white px-2 py-1 rounded-full text-xs">
                        Nouveau
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-noorea-dark mb-2">Exfoliant Doux Grains de Riz</h3>
                    <p class="text-sm text-gray-600 mb-3">Gommage naturel délicat</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-noorea-emerald">22,90€</span>
                        <button class="bg-noorea-gold text-white px-3 py-1 rounded-lg text-sm hover:bg-noorea-gold/90 transition-colors">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Produit recommandé 4 -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Brume Hydratante" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-noorea-dark mb-2">Brume Hydratante Rose</h3>
                    <p class="text-sm text-gray-600 mb-3">Spray rafraîchissant à l'eau de rose</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-noorea-emerald">13,90€</span>
                        <button class="bg-noorea-gold text-white px-3 py-1 rounded-lg text-sm hover:bg-noorea-gold/90 transition-colors">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Mobile menu toggle
document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
});

// Gestion des quantités
document.querySelectorAll('.quantity-minus').forEach(button => {
    button.addEventListener('click', function() {
        // Logique pour diminuer la quantité
    });
});

document.querySelectorAll('.quantity-plus').forEach(button => {
    button.addEventListener('click', function() {
        // Logique pour augmenter la quantité
    });
});

// Gestion des options de livraison
document.querySelectorAll('input[name="shipping"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // Mettre à jour le total avec les frais de livraison
    });
});
</script>
@endsection
