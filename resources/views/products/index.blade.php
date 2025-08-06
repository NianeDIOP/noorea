@extends('layouts.app')

@section('navbar')
<header class="absolute top-0 left-0 w-full z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between bg-transparent backdrop-blur-none px-4 py-3">
            <!-- Logo Premium -->
            <a href="{{ route('home') }}" class="flex items-center group navbar-logo">
                <div class="relative">
                    <!-- Logo principal -->
                    <div class="relative p-2 transition-all duration-300 rounded-xl">
                        <img src="{{ asset('images/logo.png') }}" alt="Noorea - L'élégance multiculturelle" class="h-12 md:h-16 lg:h-20 w-auto transition-all duration-300">
                    </div>
                    <!-- Particules décoratives -->
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-noorea-gold rounded-full animate-pulse opacity-30"></div>
                    <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-noorea-gold rounded-full animate-pulse opacity-20" style="animation-delay: 0.5s;"></div>
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
                <a href="{{ route('cart') }}" class="navbar-icon text-lg relative" aria-label="Mon panier">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="absolute -top-2 -right-2 bg-noorea-rose text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg opacity-80">0</span>
                </a>
                <!-- Menu mobile toggle -->
                <button type="button" class="navbar-mobile-icon md:hidden text-lg" id="mobile-menu-button" aria-label="Menu">
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
<!-- Hero Section Boutique -->
<section class="relative h-96 overflow-hidden bg-gradient-to-br from-noorea-dark via-noorea-cream to-noorea-gold/30 pt-24 md:pt-28">
    <!-- Image header professionnelle -->
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=1920&h=600&fit=crop')] bg-cover bg-center opacity-50"></div>
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg?auto=compress&cs=tinysrgb&w=1920&h=600&fit=crop')] bg-cover bg-right opacity-30"></div>
    
    <!-- Overlay gradient -->
    <div class="absolute inset-0 bg-gradient-to-r from-noorea-dark/80 via-noorea-dark/50 to-transparent"></div>
    
    <!-- Contenu centré -->
    <div class="relative z-30 flex items-center h-full">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <nav class="text-noorea-gold mb-6 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-yellow-300 transition-colors"></a>
                    <span class="mx-2 text-white"></span>
                    <span class="text-white font-medium"></span>
                </nav>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-4 leading-tight">
                    Collection Premium
                </h1>
                <p class="text-xl text-gray-200 leading-relaxed mb-6">
                    Explorez notre sélection exclusive de cosmétiques multiculturels, 
                    où traditions ancestrales et innovation moderne se rencontrent pour sublimer votre beauté naturelle.
                </p>
                <div class="flex items-center gap-8 mt-8">
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">85+</div>
                        <div class="text-sm text-gray-300">Produits</div>
                    </div>
                    <div class="w-px h-12 bg-gray-400/50"></div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">15+</div>
                        <div class="text-sm text-gray-300">Marques</div>
                    </div>
                    <div class="w-px h-12 bg-gray-400/50"></div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">8</div>
                        <div class="text-sm text-gray-300">Pays</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="bg-noorea-cream/30 py-16">
<div class="container mx-auto px-4">
    <!-- Filtres de recherche premium -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-12 border border-noorea-gold/20">
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between mb-6">
            <h2 class="text-2xl font-serif font-bold text-noorea-dark mb-4 lg:mb-0">Filtrer les produits</h2>
            <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium transition-colors" onclick="resetFilters()">
                <i class="fas fa-redo mr-2"></i>Réinitialiser
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="space-y-2">
                <label for="category" class="block text-sm font-semibold text-gray-700">Catégorie</label>
                <select id="category" class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:border-noorea-gold focus:ring-0 focus:outline-none transition-all duration-300 bg-white shadow-sm hover:shadow-md">
                    <option value="">Toutes les catégories</option>
                    <option value="1">Soins du visage</option>
                    <option value="2">Maquillage</option>
                    <option value="3">Parfums</option>
                    <option value="4">Soins des cheveux</option>
                </select>
            </div>
            
            <div class="space-y-2">
                <label for="brand" class="block text-sm font-semibold text-gray-700">Marque</label>
                <select id="brand" class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:border-noorea-gold focus:ring-0 focus:outline-none transition-all duration-300 bg-white shadow-sm hover:shadow-md">
                    <option value="">Toutes les marques</option>
                    <option value="1">Noorea</option>
                    <option value="2">Afro Naturel</option>
                    <option value="3">Argan d'Or</option>
                    <option value="4">Sahel Beauty</option>
                </select>
            </div>
            
            <div class="space-y-2">
                <label for="price" class="block text-sm font-semibold text-gray-700">Gamme de prix</label>
                <select id="price" class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:border-noorea-gold focus:ring-0 focus:outline-none transition-all duration-300 bg-white shadow-sm hover:shadow-md">
                    <option value="">Tous les prix</option>
                    <option value="1">Moins de 15 000 CFA</option>
                    <option value="2">15 000 - 35 000 CFA</option>
                    <option value="3">35 000 - 65 000 CFA</option>
                    <option value="4">Plus de 65 000 CFA</option>
                </select>
            </div>
            
            <div class="space-y-2">
                <label for="origin" class="block text-sm font-semibold text-gray-700">Origine</label>
                <select id="origin" class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 focus:border-noorea-gold focus:ring-0 focus:outline-none transition-all duration-300 bg-white shadow-sm hover:shadow-md">
                    <option value="">Toutes origines</option>
                    <option value="senegal">Sénégal</option>
                    <option value="maroc">Maroc</option>
                    <option value="ghana">Ghana</option>
                    <option value="mali">Mali</option>
                    <option value="coree">Corée du Sud</option>
                </select>
            </div>
        </div>
        
        <!-- Barre de recherche -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="relative max-w-md mx-auto">
                <input type="text" placeholder="Rechercher un produit..." 
                       class="w-full rounded-xl border-2 border-gray-200 pl-12 pr-4 py-3 focus:border-noorea-gold focus:ring-0 focus:outline-none transition-all duration-300 bg-white shadow-sm hover:shadow-md">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Section des produits -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Produit 1 -->
        <a href="{{ route('products.show', 1) }}" class="product-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group block">
            <div class="relative">
                <span class="absolute top-3 right-3 bg-noorea-gold text-white text-xs px-3 py-1 rounded-full font-medium z-10">Nouveau</span>
                <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" 
                     alt="Crème hydratante karité" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-500">
                <button class="absolute bottom-3 right-3 bg-white text-noorea-dark p-2 rounded-full shadow-lg hover:bg-noorea-gold hover:text-white transition-all duration-300 transform hover:scale-110" onclick="event.preventDefault(); event.stopPropagation();">
                    <i class="fas fa-shopping-bag"></i>
                </button>
                <!-- Bouton WhatsApp -->
                <a href="https://wa.me/+221775551234?text=Bonjour, je suis intéressé(e) par la Crème Hydratante au Karité à 23 500 CFA. Pouvez-vous me donner plus d'informations ?" 
                   class="absolute bottom-3 left-3 bg-noorea-dark text-white p-2 rounded-full shadow-lg hover:bg-noorea-emerald transition-all duration-300 transform hover:scale-110 opacity-0 group-hover:opacity-100" 
                   target="_blank" aria-label="Commander via WhatsApp" onclick="event.preventDefault(); event.stopPropagation(); window.open(this.href, '_blank');">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
            <div class="p-5">
                <h3 class="text-lg font-semibold text-noorea-dark mb-1">Crème Hydratante au Karité</h3>
                <p class="text-sm text-gray-600 mb-3">Hydratation intense 24h • 50ml</p>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-noorea-emerald">23 500 CFA</span>
                    <div class="flex text-noorea-gold text-sm">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </a>
        
        <!-- Produit 2 -->
        <a href="{{ route('products.show', 2) }}" class="product-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group block">
            <div class="relative">
                <img src="https://images.pexels.com/photos/4465659/pexels-photo-4465659.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" 
                     alt="Sérum vitamine C" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-500">
                <button class="absolute bottom-3 right-3 bg-white text-noorea-dark p-2 rounded-full shadow-lg hover:bg-noorea-gold hover:text-white transition-all duration-300 transform hover:scale-110" onclick="event.preventDefault(); event.stopPropagation();">
                    <i class="fas fa-shopping-bag"></i>
                </button>
                <!-- Bouton WhatsApp -->
                <a href="https://wa.me/+221775551234?text=Bonjour, je suis intéressé(e) par le Sérum Vitamine C Éclat à 28 900 CFA. Pouvez-vous me donner plus d'informations ?" 
                   class="absolute bottom-3 left-3 bg-noorea-dark text-white p-2 rounded-full shadow-lg hover:bg-noorea-emerald transition-all duration-300 transform hover:scale-110 opacity-0 group-hover:opacity-100" 
                   target="_blank" aria-label="Commander via WhatsApp" onclick="event.preventDefault(); event.stopPropagation(); window.open(this.href, '_blank');">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
            <div class="p-5">
                <h3 class="text-lg font-semibold text-noorea-dark mb-1">Sérum Vitamine C Éclat</h3>
                <p class="text-sm text-gray-600 mb-3">Anti-âge et illuminateur • 30ml</p>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-noorea-emerald">28 900 CFA</span>
                    <div class="flex text-noorea-gold text-sm">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </a>
        
        <!-- Produit 3 -->
        <a href="{{ route('products.show', 3) }}" class="product-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group block">
            <div class="relative">
                <span class="absolute top-3 right-3 bg-noorea-rose text-white text-xs px-3 py-1 rounded-full font-medium z-10">-25%</span>
                <img src="https://images.pexels.com/photos/4465124/pexels-photo-4465124.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" 
                     alt="Huile d'argan pure" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-500">
                <button class="absolute bottom-3 right-3 bg-white text-noorea-dark p-2 rounded-full shadow-lg hover:bg-noorea-gold hover:text-white transition-all duration-300 transform hover:scale-110">
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </div>
            <div class="p-5">
                <h3 class="text-lg font-semibold text-noorea-dark mb-1">Huile d'Argan Pure Bio</h3>
                <p class="text-sm text-gray-600 mb-3">100% naturelle • 50ml</p>
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-xl font-bold text-noorea-emerald">19 500 CFA</span>
                        <span class="text-gray-500 line-through text-sm ml-2">26 000 CFA</span>
                    </div>
                    <div class="flex text-noorea-gold text-sm">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Produit 4 -->
        <div class="product-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
            <div class="relative">
                <img src="https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" 
                     alt="Eau de parfum floral" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-500">
                <button class="absolute bottom-3 right-3 bg-white text-noorea-dark p-2 rounded-full shadow-lg hover:bg-noorea-gold hover:text-white transition-all duration-300 transform hover:scale-110">
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </div>
            <div class="p-5">
                <h3 class="text-lg font-semibold text-noorea-dark mb-1">Eau de Parfum Jasmin</h3>
                <p class="text-sm text-gray-600 mb-3">Fragrance orientale • 50ml</p>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-noorea-emerald">45 000 CFA</span>
                    <div class="flex text-noorea-gold text-sm">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produit 5 -->
        <div class="product-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
            <div class="relative">
                <span class="absolute top-3 right-3 bg-noorea-emerald text-white text-xs px-3 py-1 rounded-full font-medium z-10">Bio</span>
                <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" 
                     alt="Masque à l'argile" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-500">
                <button class="absolute bottom-3 right-3 bg-white text-noorea-dark p-2 rounded-full shadow-lg hover:bg-noorea-gold hover:text-white transition-all duration-300 transform hover:scale-110">
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </div>
            <div class="p-5">
                <h3 class="text-lg font-semibold text-noorea-dark mb-1">Masque Argile Rhassoul</h3>
                <p class="text-sm text-gray-600 mb-3">Purifiant et détoxifiant • 100g</p>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-noorea-emerald">16 500 CFA</span>
                    <div class="flex text-noorea-gold text-sm">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produit 6 -->
        <div class="product-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
            <div class="relative">
                <img src="https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" 
                     alt="Fond de teint" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-500">
                <button class="absolute bottom-3 right-3 bg-white text-noorea-dark p-2 rounded-full shadow-lg hover:bg-noorea-gold hover:text-white transition-all duration-300 transform hover:scale-110">
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </div>
            <div class="p-5">
                <h3 class="text-lg font-semibold text-noorea-dark mb-1">Fond de Teint Inclusif</h3>
                <p class="text-sm text-gray-600 mb-3">30 teintes disponibles • 30ml</p>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-noorea-emerald">32 000 CFA</span>
                    <div class="flex text-noorea-gold text-sm">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produit 7 -->
        <div class="product-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
            <div class="relative">
                <span class="absolute top-3 right-3 bg-noorea-gold text-white text-xs px-3 py-1 rounded-full font-medium z-10">Bestseller</span>
                <img src="https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" 
                     alt="Palette maquillage" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-500">
                <button class="absolute bottom-3 right-3 bg-white text-noorea-dark p-2 rounded-full shadow-lg hover:bg-noorea-gold hover:text-white transition-all duration-300 transform hover:scale-110">
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </div>
            <div class="p-5">
                <h3 class="text-lg font-semibold text-noorea-dark mb-1">Palette Sahara Sunset</h3>
                <p class="text-sm text-gray-600 mb-3">12 ombres à paupières • Édition limitée</p>
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-noorea-emerald">38 500 CFA</span>
                    <div class="flex text-noorea-gold text-sm">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produit 8 -->
        <div class="product-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
            <div class="relative">
                <span class="absolute top-3 right-3 bg-noorea-rose text-white text-xs px-3 py-1 rounded-full font-medium z-10">-15%</span>
                <img src="https://images.pexels.com/photos/3992206/pexels-photo-3992206.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" 
                     alt="Rouge à lèvres" class="w-full h-60 object-cover group-hover:scale-110 transition-transform duration-500">
                <button class="absolute bottom-3 right-3 bg-white text-noorea-dark p-2 rounded-full shadow-lg hover:bg-noorea-gold hover:text-white transition-all duration-300 transform hover:scale-110">
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </div>
            <div class="p-5">
                <h3 class="text-lg font-semibold text-noorea-dark mb-1">Rouge à Lèvres Mat</h3>
                <p class="text-sm text-gray-600 mb-3">Longue tenue • 4g</p>
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-xl font-bold text-noorea-emerald">12 750 CFA</span>
                        <span class="text-gray-500 line-through text-sm ml-2">15 000 CFA</span>
                    </div>
                    <div class="flex text-noorea-gold text-sm">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        <nav class="inline-flex rounded-xl shadow-lg overflow-hidden">
            <a href="#" class="px-4 py-3 bg-white border-r border-gray-200 text-sm font-medium text-gray-500 hover:bg-noorea-gold hover:text-white transition-colors">
                <i class="fas fa-chevron-left mr-2"></i>Précédent
            </a>
            <a href="#" class="px-4 py-3 bg-noorea-gold text-white text-sm font-medium">
                1
            </a>
            <a href="#" class="px-4 py-3 bg-white border-l border-r border-gray-200 text-sm font-medium text-gray-700 hover:bg-noorea-gold hover:text-white transition-colors">
                2
            </a>
            <a href="#" class="px-4 py-3 bg-white border-r border-gray-200 text-sm font-medium text-gray-700 hover:bg-noorea-gold hover:text-white transition-colors">
                3
            </a>
            <a href="#" class="px-4 py-3 bg-white border-r border-gray-200 text-sm font-medium text-gray-500">
                ...
            </a>
            <a href="#" class="px-4 py-3 bg-white text-sm font-medium text-gray-500 hover:bg-noorea-gold hover:text-white transition-colors">
                Suivant<i class="fas fa-chevron-right ml-2"></i>
            </a>
        </nav>
    </div>
</div>
</div>

<script>
// Mobile menu toggle
document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
});

// Fonction pour réinitialiser les filtres
function resetFilters() {
    document.querySelectorAll('select').forEach(select => {
        select.value = '';
    });
    document.querySelector('input[type="text"]')?.value && (document.querySelector('input[type="text"]').value = '');
    
    // Animation de confirmation
    const resetButton = document.querySelector('button[onclick="resetFilters()"]');
    const originalText = resetButton.innerHTML;
    resetButton.innerHTML = '<i class="fas fa-check mr-2"></i>Réinitialisé';
    resetButton.classList.add('text-noorea-emerald');
    
    setTimeout(() => {
        resetButton.innerHTML = originalText;
        resetButton.classList.remove('text-noorea-emerald');
    }, 1000);
}

// Filtres de produits avec animations
document.querySelectorAll('select').forEach(select => {
    select.addEventListener('change', function() {
        // Animation lors du changement
        this.classList.add('border-noorea-gold', 'shadow-lg');
        setTimeout(() => {
            this.classList.remove('shadow-lg');
        }, 300);
        
        console.log('Filtre changé:', this.id, this.value);
    });
});

// Recherche en temps réel
document.querySelector('input[type="text"]')?.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    console.log('Recherche:', searchTerm);
    
    // Animation de recherche
    if (searchTerm.length > 2) {
        this.classList.add('border-noorea-emerald');
    } else {
        this.classList.remove('border-noorea-emerald');
    }
});

// Ajout au panier avec animation améliorée
document.querySelectorAll('.product-card button').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Animation d'ajout au panier
        const originalContent = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        this.disabled = true;
        
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-check mr-2"></i>Ajouté';
            this.classList.add('bg-noorea-emerald');
            
            setTimeout(() => {
                this.innerHTML = originalContent;
                this.classList.remove('bg-noorea-emerald');
                this.disabled = false;
            }, 1500);
        }, 500);
        
        // Mettre à jour le compteur du panier
        const cartCounter = document.querySelector('.fa-shopping-bag + span');
        if (cartCounter) {
            const currentCount = parseInt(cartCounter.textContent) || 0;
            cartCounter.textContent = currentCount + 1;
            cartCounter.classList.add('animate-pulse');
            setTimeout(() => cartCounter.classList.remove('animate-pulse'), 1000);
        }
    });
});

// Animation des cartes produits au scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Initialiser l'animation au chargement
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.product-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
        
        // Rendre les cartes cliquables pour aller aux détails
        card.style.cursor = 'pointer';
        card.addEventListener('click', function(e) {
            // Ne pas naviguer si on clique sur un bouton
            if (e.target.closest('button') || e.target.closest('a')) {
                return;
            }
            
            // Naviguer vers la page de détail du produit
            const productId = index + 1; // ID basé sur l'index
            window.location.href = `/produit/${productId}`;
        });
    });
});
</script>
@endsection
