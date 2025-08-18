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
                        <img src="{{ asset('images/logo.jpg') }}" alt="Noorea - L'élégance multiculturelle" class="h-12 md:h-16 lg:h-20 w-auto transition-all duration-300">
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
                <a href="{{ route('account.dashboard') }}" class="navbar-icon text-lg" aria-label="Mon compte">
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
<!-- Hero Section Categories -->
<section class="relative h-96 overflow-hidden bg-gradient-to-br from-noorea-dark via-noorea-cream to-noorea-gold/30 pt-24 md:pt-28">
    <!-- Images de fond cosmétiques -->
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=1920&h=600&fit=crop')] bg-cover bg-center opacity-40"></div>
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
                    Nos Catégories
                </h1>
                <p class="text-xl text-gray-200 leading-relaxed mb-6">
                    Explorez notre sélection organisée de produits cosmétiques par catégorie. 
                    De la beauté du visage aux soins capillaires, trouvez exactement ce qu'il vous faut.
                </p>
                <div class="flex items-center gap-8 mt-8">
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">6</div>
                        <div class="text-sm text-gray-300">Catégories</div>
                    </div>
                    <div class="w-px h-12 bg-gray-400/50"></div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">85+</div>
                        <div class="text-sm text-gray-300">Produits</div>
                    </div>
                    <div class="w-px h-12 bg-gray-400/50"></div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">100%</div>
                        <div class="text-sm text-gray-300">Qualité</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="bg-noorea-cream/30 py-10">
<div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Catégorie 1 -->
            <a href="#" class="category-card bg-gradient-to-br from-noorea-cream/50 to-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-80 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Soins du visage" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-2xl font-medium text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">Soins du visage</h3>
                    <p class="text-gray-600">Découvrez notre sélection de produits pour sublimer votre peau</p>
                    <span class="inline-block mt-4 text-noorea-gold font-medium group-hover:text-noorea-emerald transition-colors duration-300 flex items-center justify-center">
                        Explorer
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
            
            <!-- Catégorie 2 -->
            <a href="#" class="category-card bg-gradient-to-br from-noorea-cream/50 to-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-80 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1599733589046-d8a49e9ec159?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Maquillage" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-2xl font-medium text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">Maquillage</h3>
                    <p class="text-gray-600">Des produits de qualité pour un maquillage impeccable</p>
                    <span class="inline-block mt-4 text-noorea-gold font-medium group-hover:text-noorea-emerald transition-colors duration-300 flex items-center justify-center">
                        Explorer
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
            
            <!-- Catégorie 3 -->
            <a href="#" class="category-card bg-gradient-to-br from-noorea-cream/50 to-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-80 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1617384111729-bc90e50fb7d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Parfums" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-2xl font-medium text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">Parfums</h3>
                    <p class="text-gray-600">Des fragrances exclusives pour tous les goûts</p>
                    <span class="inline-block mt-4 text-noorea-gold font-medium group-hover:text-noorea-emerald transition-colors duration-300 flex items-center justify-center">
                        Explorer
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
        
            <!-- Catégorie 4 -->
            <a href="#" class="category-card bg-gradient-to-br from-noorea-cream/50 to-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-80 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Soins des cheveux" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-2xl font-medium text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">Soins des cheveux</h3>
                    <p class="text-gray-600">Tout pour des cheveux sains et brillants</p>
                    <span class="inline-block mt-4 text-noorea-gold font-medium group-hover:text-noorea-emerald transition-colors duration-300 flex items-center justify-center">
                        Explorer
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
        
            <!-- Catégorie 5 -->
            <a href="#" class="category-card bg-gradient-to-br from-noorea-cream/50 to-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-80 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1559831261-11c4dd18b0fb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Soins du corps" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-2xl font-medium text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">Soins du corps</h3>
                    <p class="text-gray-600">Des produits nourrissants pour votre peau</p>
                    <span class="inline-block mt-4 text-noorea-gold font-medium group-hover:text-noorea-emerald transition-colors duration-300 flex items-center justify-center">
                        Explorer
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
        
            <!-- Catégorie 6 -->
            <a href="#" class="category-card bg-gradient-to-br from-noorea-cream/50 to-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-80 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1515688594390-b649af70d282?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Accessoires" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-2xl font-medium text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">Accessoires</h3>
                    <p class="text-gray-600">Les indispensables pour compléter votre routine beauté</p>
                    <span class="inline-block mt-4 text-noorea-gold font-medium group-hover:text-noorea-emerald transition-colors duration-300 flex items-center justify-center">
                        Explorer
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
