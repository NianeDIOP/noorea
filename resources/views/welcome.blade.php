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
<!-- Hero Section -->
<section class="relative h-screen overflow-hidden bg-gradient-to-br from-noorea-dark via-noorea-cream to-noorea-gold/30 pt-0">
    <!-- Arrière-plans multiples avec effets -->
    <div class="absolute inset-0 z-0">
        <!-- Arrière-plan principal -->
        <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&fit=crop')] bg-cover bg-center bg-no-repeat opacity-40 hero-bg-1"></div>
        
        <!-- Arrière-plan secondaire en mouvement -->
        <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&fit=crop')] bg-cover bg-right bg-no-repeat opacity-25 hero-bg-2"></div>
        
        <!-- Arrière-plan tertiaire -->
        <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3762879/pexels-photo-3762879.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&fit=crop')] bg-cover bg-left bg-no-repeat opacity-20 hero-bg-3"></div>
        
        <!-- Overlay gradient pour la lisibilité -->
        <div class="absolute inset-0 bg-gradient-to-r from-noorea-dark/60 via-transparent to-noorea-gold/40"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/70 via-transparent to-transparent"></div>
    </div>
    
    <!-- Images cosmétiques flottantes avec plus d'effets -->
    <div class="absolute inset-0 z-20 overflow-hidden">
        <!-- Groupe 1 - Produits de maquillage -->
        <div class="absolute top-16 right-8 md:right-16 hero-float-1 opacity-85">
            <img src="https://images.pexels.com/photos/3762879/pexels-photo-3762879.jpeg?auto=compress&cs=tinysrgb&w=400&h=500&fit=crop" 
                 alt="Rouge à lèvres premium" class="w-40 h-50 md:w-56 md:h-70 object-cover rounded-2xl shadow-2xl border-2 border-noorea-gold/30">
        </div>
        
        <!-- Groupe 2 - Parfums luxueux -->
        <div class="absolute bottom-24 left-8 md:left-16 hero-float-2 opacity-80">
            <img src="https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=350&h=450&fit=crop" 
                 alt="Parfum de luxe" class="w-32 h-42 md:w-44 md:h-58 object-cover rounded-2xl shadow-2xl border-2 border-noorea-emerald/30">
        </div>
        
        <!-- Groupe 3 - Palettes colorées -->
        <div class="absolute top-32 left-1/5 hero-float-3 opacity-75">
            <img src="https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg?auto=compress&cs=tinysrgb&w=450&h=350&fit=crop" 
                 alt="Palette maquillage multiculturelle" class="w-44 h-32 md:w-60 md:h-44 object-cover rounded-2xl shadow-2xl border-2 border-noorea-rose/30">
        </div>
        
        <!-- Groupe 4 - Soins visage -->
        <div class="absolute bottom-16 right-1/5 hero-float-4 opacity-70">
            <img src="https://images.pexels.com/photos/4465124/pexels-photo-4465124.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" 
                 alt="Crème visage naturelle" class="w-28 h-28 md:w-40 md:h-40 object-cover rounded-full shadow-2xl border-4 border-noorea-cream/50">
        </div>
        
        <!-- Groupe 5 - Fonds de teint -->
        <div class="absolute top-1/2 right-1/4 hero-float-5 opacity-65">
            <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=300&h=400&fit=crop" 
                 alt="Fond de teint inclusif" class="w-24 h-32 md:w-32 md:h-44 object-cover rounded-xl shadow-2xl border-2 border-noorea-gold/40">
        </div>
        
        <!-- Groupe 6 - Accessoires beauté -->
        <div class="absolute top-20 left-1/3 hero-float-6 opacity-60">
            <img src="https://images.pexels.com/photos/4465659/pexels-photo-4465659.jpeg?auto=compress&cs=tinysrgb&w=250&h=300&fit=crop" 
                 alt="Pinceaux maquillage" class="w-20 h-24 md:w-28 md:h-36 object-cover rounded-xl shadow-xl border border-noorea-emerald/40">
        </div>
        
        <!-- Groupe 7 - Vernis et couleurs -->
        <div class="absolute bottom-1/3 left-1/6 hero-float-7 opacity-55">
            <img src="https://images.pexels.com/photos/3992206/pexels-photo-3992206.jpeg?auto=compress&cs=tinysrgb&w=200&h=250&fit=crop" 
                 alt="Vernis à ongles" class="w-16 h-20 md:w-24 md:h-30 object-cover rounded-lg shadow-xl border border-noorea-rose/40">
        </div>
    </div>
    
    <!-- Contenu principal centré -->
    <div class="relative z-30 flex items-center justify-center h-full pt-20 md:pt-24">
        <div class="text-center max-w-4xl mx-auto px-6 md:px-12">
            <!-- Logo/Nom NOOREA -->
            <div class="mb-8 hero-brand-animation">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif font-bold mb-4">
                    <span class="noorea-logo-text bg-gradient-to-r from-noorea-gold via-yellow-400 to-noorea-gold bg-clip-text text-transparent drop-shadow-2xl">
                        NOOREA
                    </span>
                </h1>
                <!-- Ligne décorative -->
                <div class="w-24 md:w-32 h-1 bg-gradient-to-r from-transparent via-noorea-gold to-transparent mx-auto mb-6"></div>
            </div>
            
            <!-- Message principal -->
            <div class="hero-content-animation">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-white mb-6 leading-tight text-center">
                    Découvrez la beauté 
                    <span class="text-noorea-gold bg-gradient-to-r from-noorea-gold to-yellow-300 bg-clip-text text-transparent">
                        multiculturelle
                    </span>
                </h2>
                <p class="text-lg md:text-xl text-white/90 mb-8 leading-relaxed max-w-4xl mx-auto text-center">
                    Une collection exclusive de cosmétiques et parfums premium, célébrant la diversité et l'authenticité 
                    des traditions de beauté du monde entier.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="{{ route('products') }}" class="btn-primary text-lg px-10 py-5 transform transition-all duration-300 hover:scale-110 hover:shadow-2xl bg-gradient-to-r from-noorea-gold to-yellow-500 hover:from-yellow-500 hover:to-noorea-gold">
                        <i class="fas fa-crown mr-3"></i>
                        Découvrir la collection
                    </a>
                    <a href="{{ route('categories') }}" class="btn-secondary text-lg px-10 py-5 transform transition-all duration-300 hover:scale-110 hover:shadow-2xl border-2 border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-noorea-dark">
                        <i class="fas fa-palette mr-3"></i>
                        Explorer les univers
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Particules et effets visuels avancés -->
    <div class="absolute inset-0 z-10 pointer-events-none">
        <!-- Particules dorées principales -->
        <div class="hero-particle hero-particle-1"></div>
        <div class="hero-particle hero-particle-2"></div>
        <div class="hero-particle hero-particle-3"></div>
        <div class="hero-particle hero-particle-4"></div>
        <div class="hero-particle hero-particle-5"></div>
        <div class="hero-particle hero-particle-6"></div>
        <div class="hero-particle hero-particle-7"></div>
        <div class="hero-particle hero-particle-8"></div>
        
        <!-- Cercles lumineux flottants -->
        <div class="hero-light-circle hero-light-1"></div>
        <div class="hero-light-circle hero-light-2"></div>
        <div class="hero-light-circle hero-light-3"></div>
        <div class="hero-light-circle hero-light-4"></div>
        
        <!-- Étoiles scintillantes -->
        <div class="hero-star hero-star-1"><i class="fas fa-star"></i></div>
        <div class="hero-star hero-star-2"><i class="fas fa-star"></i></div>
        <div class="hero-star hero-star-3"><i class="fas fa-star"></i></div>
        <div class="hero-star hero-star-4"><i class="fas fa-star"></i></div>
        <div class="hero-star hero-star-5"><i class="fas fa-star"></i></div>
        
        <!-- Lignes de lumière -->
        <div class="hero-light-beam hero-beam-1"></div>
        <div class="hero-light-beam hero-beam-2"></div>
        <div class="hero-light-beam hero-beam-3"></div>
    </div>
</section>

<!-- Bannière USP -->
<section class="bg-noorea-dark text-white py-8 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-[url('https://images.unsplash.com/photo-1560204992-c55246444654?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80')] bg-no-repeat bg-cover opacity-20"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex items-center transform transition-all duration-500 hover:translate-y-[-5px]">
                <div class="w-12 h-12 rounded-full bg-noorea-gold/20 flex items-center justify-center mr-4">
                    <i class="fas fa-leaf text-noorea-gold text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-medium text-lg">Ingrédients naturels</h3>
                    <p class="text-sm text-gray-300">Formules à base de plantes et d'ingrédients naturels</p>
                </div>
            </div>
            <div class="flex items-center transform transition-all duration-500 hover:translate-y-[-5px]">
                <div class="w-12 h-12 rounded-full bg-noorea-gold/20 flex items-center justify-center mr-4">
                    <i class="fas fa-shipping-fast text-noorea-gold text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-medium text-lg">Livraison rapide</h3>
                    <p class="text-sm text-gray-300">Livraison offerte dès 30 000 CFA d'achat</p>
                </div>
            </div>
            <div class="flex items-center transform transition-all duration-500 hover:translate-y-[-5px]">
                <div class="w-12 h-12 rounded-full bg-noorea-gold/20 flex items-center justify-center mr-4">
                    <i class="fas fa-heart text-noorea-gold text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-medium text-lg">Produits testés et approuvés</h3>
                    <p class="text-sm text-gray-300">Non testés on les animaux</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Catégories Phares -->
<section class="py-16 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-pattern opacity-5 z-0"></div>
    <div class="container mx-auto px-4 relative z-10">
        <h2 class="text-3xl font-serif font-semibold text-center mb-12 text-noorea-dark relative inline-block mx-auto">
            Nos catégories phares
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-noorea-gold"></span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <a href="#" class="category-card bg-noorea-cream/30 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-60 overflow-hidden">
                    <img src="https://images.pexels.com/photos/3762879/pexels-photo-3762879.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Soins du visage" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="p-4 text-center">
                    <h3 class="text-xl font-medium text-noorea-dark">Soins du visage</h3>
                </div>
            </a>
            
            <a href="#" class="category-card bg-noorea-cream/30 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-60 overflow-hidden">
                    <img src="https://images.pexels.com/photos/2113855/pexels-photo-2113855.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Maquillage" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="p-4 text-center">
                    <h3 class="text-xl font-medium text-noorea-dark">Maquillage</h3>
                </div>
            </a>
            
            <a href="#" class="category-card bg-noorea-cream/30 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-60 overflow-hidden">
                    <img src="https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Parfums" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="p-4 text-center">
                    <h3 class="text-xl font-medium text-noorea-dark">Parfums</h3>
                </div>
            </a>
            
            <a href="#" class="category-card bg-noorea-cream/30 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-60 overflow-hidden">
                    <img src="https://images.pexels.com/photos/3993449/pexels-photo-3993449.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Soins des cheveux" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="p-4 text-center">
                    <h3 class="text-xl font-medium text-noorea-dark">Soins des cheveux</h3>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Produits Tendance -->
<section class="py-16 bg-gradient-to-b from-noorea-cream/20 to-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-[url('https://images.unsplash.com/photo-1596704017254-9759879b0456?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80')] bg-fixed bg-no-repeat bg-cover opacity-5"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-noorea-dark inline-block relative">
                Produits tendance
                <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-noorea-gold"></span>
            </h2>
            <p class="text-gray-600 mt-4">Découvrez nos produits les plus populaires</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Produit 1 -->
            <div class="product-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="relative">
                    <span class="absolute top-2 right-2 bg-noorea-gold text-white text-xs px-2 py-1 rounded z-10">Nouveau</span>
                    <a href="{{ route('products.show', 1) }}" class="block">
                        <img src="https://images.pexels.com/photos/5938567/pexels-photo-5938567.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Crème hydratante" class="w-full h-60 object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="bg-white/90 text-noorea-dark px-4 py-2 rounded-full font-medium shadow-lg">
                                <i class="fas fa-eye mr-2"></i>Voir détails
                            </span>
                        </div>
                    </a>
                    <button class="absolute bottom-2 right-2 bg-white text-noorea-dark p-2 rounded-full shadow hover:bg-noorea-gold hover:text-white transition-colors transform transition-transform duration-300 group-hover:translate-y-[-5px]">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-medium text-noorea-dark">Crème hydratante visage</h3>
                    <p class="text-sm text-gray-500 mb-2">Hydratation intense</p>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-noorea-dark font-bold">26 200 CFA</span>
                        <div class="flex text-noorea-gold">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <!-- Boutons d'action élégants -->
                    <div class="flex gap-2">
                        <a href="{{ route('products.show', 1) }}" 
                           class="flex-1 bg-noorea-gold hover:bg-yellow-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-300 text-center">
                            Voir détails
                        </a>
                        <a href="https://wa.me/221775551234?text=Bonjour%20Noorea%21%20Je%20suis%20intéressé(e)%20par%20la%20Crème%20hydratante%20visage%20à%2026%20200%20CFA.%20Pouvez-vous%20me%20donner%20plus%20d'informations%20%3F" 
                           target="_blank"
                           class="bg-noorea-dark hover:bg-gray-800 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-300 flex items-center justify-center" 
                           title="Contacter via WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Produit 2 -->
            <div class="product-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="relative">
                    <a href="{{ route('products.show', 2) }}" class="block">
                        <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Sérum visage" class="w-full h-60 object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="bg-white/90 text-noorea-dark px-4 py-2 rounded-full font-medium shadow-lg">
                                <i class="fas fa-eye mr-2"></i>Voir détails
                            </span>
                        </div>
                    </a>
                    <button class="absolute bottom-2 right-2 bg-white text-noorea-dark p-2 rounded-full shadow hover:bg-noorea-gold hover:text-white transition-colors transform transition-transform duration-300 group-hover:translate-y-[-5px]">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-medium text-noorea-dark">Sérum éclat</h3>
                    <p class="text-sm text-gray-500 mb-2">Vitamine C</p>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-noorea-dark font-bold">29 500 CFA</span>
                        <div class="flex text-noorea-gold">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <!-- Boutons d'action élégants -->
                    <div class="flex gap-2">
                        <a href="{{ route('products.show', 2) }}" 
                           class="flex-1 bg-noorea-gold hover:bg-yellow-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-300 text-center">
                            Voir détails
                        </a>
                        <a href="https://wa.me/221775551234?text=Bonjour%20Noorea%21%20Je%20suis%20intéressé(e)%20par%20le%20Sérum%20éclat%20à%2029%20500%20CFA.%20Pouvez-vous%20me%20donner%20plus%20d'informations%20%3F" 
                           target="_blank"
                           class="bg-noorea-dark hover:bg-gray-800 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-300 flex items-center justify-center" 
                           title="Contacter via WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Produit 3 -->
            <div class="product-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="relative">
                    <span class="absolute top-2 right-2 bg-noorea-emerald text-white text-xs px-2 py-1 rounded z-10">Promo -20%</span>
                    <a href="{{ route('products.show', 3) }}" class="block">
                        <img src="https://images.pexels.com/photos/4041392/pexels-photo-4041392.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Huile capillaire" class="w-full h-60 object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="bg-white/90 text-noorea-dark px-4 py-2 rounded-full font-medium shadow-lg">
                                <i class="fas fa-eye mr-2"></i>Voir détails
                            </span>
                        </div>
                    </a>
                    <button class="absolute bottom-2 right-2 bg-white text-noorea-dark p-2 rounded-full shadow hover:bg-noorea-gold hover:text-white transition-colors transform transition-transform duration-300 group-hover:translate-y-[-5px]">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-medium text-noorea-dark">Huile capillaire</h3>
                    <p class="text-sm text-gray-500 mb-2">Argan et Karité</p>
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <span class="text-noorea-dark font-bold">18 950 CFA</span>
                            <span class="text-gray-500 line-through text-sm ml-2">23 600 CFA</span>
                        </div>
                        <div class="flex text-noorea-gold">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                    <!-- Boutons d'action élégants -->
                    <div class="flex gap-2">
                        <a href="{{ route('products.show', 3) }}" 
                           class="flex-1 bg-noorea-gold hover:bg-yellow-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-300 text-center">
                            Voir détails
                        </a>
                        <a href="https://wa.me/221775551234?text=Bonjour%20Noorea%21%20Je%20suis%20intéressé(e)%20par%20l'Huile%20capillaire%20en%20PROMO%20à%2018%20950%20CFA%20(au%20lieu%20de%2023%20600%20CFA).%20Cette%20offre%20est-elle%20toujours%20disponible%20%3F" 
                           target="_blank"
                           class="bg-noorea-dark hover:bg-gray-800 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-300 flex items-center justify-center" 
                           title="Contacter via WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Produit 4 -->
            <div class="product-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="relative">
                    <a href="{{ route('products.show', 4) }}" class="block">
                        <img src="https://images.pexels.com/photos/1190829/pexels-photo-1190829.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Parfum floral" class="w-full h-60 object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="bg-white/90 text-noorea-dark px-4 py-2 rounded-full font-medium shadow-lg">
                                <i class="fas fa-eye mr-2"></i>Voir détails
                            </span>
                        </div>
                    </a>
                    <button class="absolute bottom-2 right-2 bg-white text-noorea-dark p-2 rounded-full shadow hover:bg-noorea-gold hover:text-white transition-colors transform transition-transform duration-300 group-hover:translate-y-[-5px]">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-medium text-noorea-dark">Eau de parfum</h3>
                    <p class="text-sm text-gray-500 mb-2">Fleur de vanille</p>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-noorea-dark font-bold">49 200 CFA</span>
                        <div class="flex text-noorea-gold">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <!-- Boutons d'action élégants -->
                    <div class="flex gap-2">
                        <a href="{{ route('products.show', 4) }}" 
                           class="flex-1 bg-noorea-gold hover:bg-yellow-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-300 text-center">
                            Voir détails
                        </a>
                        <a href="https://wa.me/221775551234?text=Bonjour%20Noorea%21%20Je%20suis%20intéressé(e)%20par%20l'Eau%20de%20parfum%20Fleur%20de%20vanille%20à%2049%20200%20CFA.%20Puis-je%20avoir%20des%20détails%20sur%20ce%20parfum%20%3F" 
                           target="_blank"
                           class="bg-noorea-dark hover:bg-gray-800 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors duration-300 flex items-center justify-center" 
                           title="Contacter via WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('products') }}" class="inline-block bg-gradient-to-r from-noorea-gold to-yellow-500 hover:from-yellow-500 hover:to-noorea-gold text-noorea-dark font-semibold py-4 px-8 rounded-xl shadow-xl hover:shadow-2xl transform transition-all duration-300 hover:scale-105 border border-yellow-400/30">
                <i class="fas fa-shopping-bag mr-2"></i>
                Voir tous les produits
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
<!-- Bannière promotionnelle -->
<section class="py-20 text-white relative overflow-hidden newsletter-shine">
    <!-- Image de fond floue -->
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=1200&q=80')] bg-no-repeat bg-cover bg-fixed filter blur-sm"></div>
    
    <!-- Overlay avec gradient dynamique -->
    <div class="absolute inset-0 bg-gradient-to-br from-noorea-dark/85 via-noorea-emerald/75 to-noorea-dark/85"></div>
    
    <!-- Particules flottantes -->
    <div class="particles">
        <div class="particle" style="left: 10%; animation-delay: 0s; width: 4px; height: 4px;"></div>
        <div class="particle" style="left: 20%; animation-delay: 1s; width: 2px; height: 2px;"></div>
        <div class="particle" style="left: 30%; animation-delay: 2s; width: 3px; height: 3px;"></div>
        <div class="particle" style="left: 40%; animation-delay: 3s; width: 2px; height: 2px;"></div>
        <div class="particle" style="left: 50%; animation-delay: 4s; width: 4px; height: 4px;"></div>
        <div class="particle" style="left: 60%; animation-delay: 5s; width: 3px; height: 3px;"></div>
        <div class="particle" style="left: 70%; animation-delay: 1.5s; width: 2px; height: 2px;"></div>
        <div class="particle" style="left: 80%; animation-delay: 2.5s; width: 4px; height: 4px;"></div>
        <div class="particle" style="left: 90%; animation-delay: 3.5s; width: 3px; height: 3px;"></div>
    </div>
    
    <!-- Icônes flottantes animées -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Icône cœur - animation flottante -->
        <div class="absolute top-20 left-10 text-noorea-gold/40 text-4xl animate-float">
            <i class="fas fa-heart"></i>
        </div>
        
        <!-- Icône étoile - animation de dérive -->
        <div class="absolute top-32 right-20 text-noorea-cream/50 text-3xl animate-drift">
            <i class="fas fa-star"></i>
        </div>
        
        <!-- Icône feuille - rotation lente -->
        <div class="absolute bottom-32 left-16 text-noorea-gold/35 text-5xl animate-rotate-slow">
            <i class="fas fa-leaf"></i>
        </div>
        
        <!-- Icône spa - flottement inverse -->
        <div class="absolute top-48 left-1/4 text-noorea-cream/40 text-2xl animate-float-reverse">
            <i class="fas fa-spa"></i>
        </div>
        
        <!-- Icône fleur - pulsation brillante -->
        <div class="absolute bottom-20 right-16 text-noorea-gold/45 text-3xl animate-pulse-glow">
            <i class="fas fa-seedling"></i>
        </div>
        
        <!-- Icône magie - scintillement -->
        <div class="absolute top-16 right-1/3 text-noorea-cream/35 text-4xl animate-sparkle">
            <i class="fas fa-magic"></i>
        </div>
        
        <!-- Icône gemme - animation flottante -->
        <div class="absolute bottom-40 left-1/3 text-noorea-gold/30 text-2xl animate-float">
            <i class="fas fa-gem"></i>
        </div>
        
        <!-- Icône papillon - dérive -->
        <div class="absolute top-60 right-10 text-noorea-cream/40 text-3xl animate-drift">
            <i class="fas fa-dove"></i>
        </div>
    </div>
    
    <div class="container mx-auto px-4 py-16 relative z-10">
        <div class="max-w-xl mx-auto text-center">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                <h2 class="text-3xl md:text-4xl font-serif font-bold mb-4 animate-fadeIn text-shadow-lg">
                    10% de réduction sur votre première commande
                </h2>
                <p class="text-lg mb-8 animate-fadeIn delay-100 text-noorea-cream">
                    Inscrivez-vous à notre newsletter et recevez un code promo exclusif
                </p>
                
                <form class="flex flex-col md:flex-row gap-4 justify-center animate-fadeIn delay-200">
                    <input 
                        type="email" 
                        placeholder="Votre adresse email" 
                        class="px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-noorea-gold text-noorea-dark w-full md:w-auto backdrop-blur-sm bg-white/90 border border-white/30 placeholder-gray-500"
                    >
                    <button 
                        type="submit" 
                        class="bg-gradient-to-r from-noorea-gold to-noorea-rose-gold text-noorea-dark font-semibold px-6 py-3 rounded-md transform transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-noorea-gold/50"
                    >
                        S'inscrire
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Témoignages -->
<section class="py-16 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-[url('https://images.unsplash.com/photo-1576426863848-c21f53c60b19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80')] bg-fixed bg-no-repeat bg-cover opacity-5"></div>
    <div class="container mx-auto px-4 relative z-10">
        <h2 class="text-3xl font-serif font-semibold text-center mb-12 text-noorea-dark relative inline-block mx-auto">
            Ce que nos clients disent
            <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-noorea-gold"></span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Témoignage 1 -->
            <div class="bg-gradient-to-br from-noorea-cream/50 to-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px]">
                <div class="flex text-noorea-gold mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-700 mb-4 italic">"J'utilise la crème hydratante depuis un mois et ma peau n'a jamais été aussi douce. Les ingrédients naturels font vraiment la différence!"</p>
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sophie M." class="w-10 h-10 rounded-full mr-4">
                    <div>
                        <h4 class="font-medium text-noorea-dark">Sophie M.</h4>
                        <p class="text-xs text-gray-500">Cliente fidèle</p>
                    </div>
                </div>
            </div>
            
            <!-- Témoignage 2 -->
            <div class="bg-gradient-to-br from-noorea-cream/50 to-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-5px]">
                <div class="flex text-noorea-gold mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-700 mb-4 italic">"Le sérum éclat a complètement transformé mon teint. Je reçois des compliments tous les jours! Et l'odeur est divine."</p>
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Marc T." class="w-10 h-10 rounded-full mr-4">
                    <div>
                        <h4 class="font-medium text-noorea-dark">Marc T.</h4>
                        <p class="text-xs text-gray-500">Client depuis 2024</p>
                    </div>
                </div>
            </div>
            
            <!-- Témoignage 3 -->
            <div class="bg-gradient-to-br from-noorea-cream/50 to-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-5px]">
                <div class="flex text-noorea-gold mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text-gray-700 mb-4 italic">"L'huile capillaire est un miracle pour mes cheveux bouclés. Ils sont maintenant brillants et bien hydratés sans être alourdis."</p>
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Amina K." class="w-10 h-10 rounded-full mr-4">
                    <div>
                        <h4 class="font-medium text-noorea-dark">Amina K.</h4>
                        <p class="text-xs text-gray-500">Cliente satisfaite</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog beauté -->
<section class="py-16 bg-gradient-to-b from-white to-noorea-cream/30 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-[url('https://images.unsplash.com/photo-1596704017254-9759879b0456?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80')] bg-fixed bg-no-repeat bg-cover opacity-5"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-noorea-dark inline-block relative">
                Beauté du monde
                <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-noorea-gold"></span>
            </h2>
            <p class="text-gray-600 mt-4">Explorez nos derniers articles sur la beauté</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Article 1 -->
            <a href="#" class="blog-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.pexels.com/photos/3762876/pexels-photo-3762876.jpeg?auto=compress&cs=tinysrgb&w=600&h=300&fit=crop" alt="Rituels de beauté" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-200 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <div class="text-xs text-noorea-gold mb-2">12 juillet 2025</div>
                    <h3 class="text-xl font-medium text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">5 rituels de beauté africains à adopter</h3>
                    <p class="text-gray-600 text-sm mb-4">Découvrez les secrets de beauté transmis de génération en génération en Afrique...</p>
                    <span class="text-noorea-gold text-sm font-medium inline-flex items-center">
                        Lire la suite 
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
            
            <!-- Article 2 -->
            <a href="#" class="blog-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.pexels.com/photos/4041392/pexels-photo-4041392.jpeg?auto=compress&cs=tinysrgb&w=600&h=300&fit=crop" alt="Soins naturels" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-200 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <div class="text-xs text-noorea-gold mb-2">5 juillet 2025</div>
                    <h3 class="text-xl font-medium text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">Les bienfaits du karité pour la peau et les cheveux</h3>
                    <p class="text-gray-600 text-sm mb-4">Ce beurre précieux est un véritable trésor de beauté aux multiples vertus...</p>
                    <span class="text-noorea-gold text-sm font-medium inline-flex items-center">
                        Lire la suite 
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
            
            <!-- Article 3 -->
            <a href="#" class="blog-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:translate-y-[-10px] group">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.pexels.com/photos/2113855/pexels-photo-2113855.jpeg?auto=compress&cs=tinysrgb&w=600&h=300&fit=crop" alt="Maquillage" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-200 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <div class="text-xs text-noorea-gold mb-2">1 juillet 2025</div>
                    <h3 class="text-xl font-medium text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">Comment créer un maquillage lumineux pour l'été</h3>
                    <p class="text-gray-600 text-sm mb-4">Nos conseils pour un teint éclatant et une mise en beauté qui résiste à la chaleur...</p>
                    <span class="text-noorea-gold text-sm font-medium inline-flex items-center">
                        Lire la suite 
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('blog') }}" class="btn-secondary inline-block transform transition-transform hover:scale-105">
                Tous les articles
            </a>
        </div>
    </div>
</section>

<!-- Instagram Feed -->
<section class="py-16 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-[url('https://images.unsplash.com/photo-1607602618367-0c87513dde1e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80')] bg-fixed bg-no-repeat bg-cover opacity-5"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-noorea-dark inline-block relative">
                Suivez-nous sur Instagram
                <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-noorea-gold"></span>
            </h2>
            <p class="text-gray-600 mt-4 flex items-center justify-center">
                <i class="fab fa-instagram text-noorea-gold mr-2"></i>
                <span>@noorea_beauty</span>
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <a href="#" class="insta-post relative overflow-hidden group rounded-lg">
                <img src="https://images.pexels.com/photos/2113855/pexels-photo-2113855.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Instagram post" class="w-full h-40 object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/80 to-noorea-dark/20 flex items-center justify-center opacity-0 group-hover:opacity-200 transition-opacity duration-300">
                    <i class="fab fa-instagram text-white text-2xl"></i>
                </div>
            </a>
            <a href="#" class="insta-post relative overflow-hidden group rounded-lg">
                <img src="https://images.pexels.com/photos/3762879/pexels-photo-3762879.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Instagram post" class="w-full h-40 object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/80 to-noorea-dark/20 flex items-center justify-center opacity-0 group-hover:opacity-200 transition-opacity duration-300">
                    <i class="fab fa-instagram text-white text-2xl"></i>
                </div>
            </a>
            <a href="#" class="insta-post relative overflow-hidden group rounded-lg">
                <img src="https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Instagram post" class="w-full h-40 object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/80 to-noorea-dark/20 flex items-center justify-center opacity-0 group-hover:opacity-200 transition-opacity duration-300">
                    <i class="fab fa-instagram text-white text-2xl"></i>
                </div>
            </a>
            <a href="#" class="insta-post relative overflow-hidden group rounded-lg">
                <img src="https://images.pexels.com/photos/5938567/pexels-photo-5938567.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Instagram post" class="w-full h-40 object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/80 to-noorea-dark/20 flex items-center justify-center opacity-0 group-hover:opacity-200 transition-opacity duration-300">
                    <i class="fab fa-instagram text-white text-2xl"></i>
                </div>
            </a>
            <a href="#" class="insta-post relative overflow-hidden group rounded-lg">
                <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Instagram post" class="w-full h-40 object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/80 to-noorea-dark/20 flex items-center justify-center opacity-0 group-hover:opacity-200 transition-opacity duration-300">
                    <i class="fab fa-instagram text-white text-2xl"></i>
                </div>
            </a>
            <a href="#" class="insta-post relative overflow-hidden group rounded-lg">
                <img src="https://images.pexels.com/photos/1190829/pexels-photo-1190829.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Instagram post" class="w-full h-40 object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/80 to-noorea-dark/20 flex items-center justify-center opacity-0 group-hover:opacity-200 transition-opacity duration-300">
                    <i class="fab fa-instagram text-white text-2xl"></i>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection
