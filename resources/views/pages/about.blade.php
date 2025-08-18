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
<!-- Hero Section À propos -->
<section class="relative h-96 overflow-hidden bg-gradient-to-br from-noorea-dark via-noorea-emerald/30 to-noorea-gold/40 pt-24 md:pt-28">
    <!-- Images de fond cosmétiques -->
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3785077/pexels-photo-3785077.jpeg?auto=compress&cs=tinysrgb&w=1920&h=600&fit=crop')] bg-cover bg-center opacity-50"></div>
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3762800/pexels-photo-3762800.jpeg?auto=compress&cs=tinysrgb&w=1920&h=600&fit=crop')] bg-cover bg-right opacity-30"></div>
    
    <!-- Overlay gradient -->
    <div class="absolute inset-0 bg-gradient-to-r from-noorea-dark/85 via-noorea-dark/60 to-transparent"></div>
    
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
                    À propos de Noorea
                </h1>
                <p class="text-xl text-gray-200 leading-relaxed mb-6">
                    Découvrez notre histoire, nos valeurs et notre passion pour la beauté multiculturelle. 
                    Noorea illumine votre beauté naturelle grâce à des produits authentiques et respectueux.
                </p>
                <div class="flex items-center gap-8 mt-8">
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">2023</div>
                        <div class="text-sm text-gray-300">Fondation</div>
                    </div>
                    <div class="w-px h-12 bg-gray-400/50"></div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">100%</div>
                        <div class="text-sm text-gray-300">Naturel</div>
                    </div>
                    <div class="w-px h-12 bg-gray-400/50"></div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">∞</div>
                        <div class="text-sm text-gray-300">Passion</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-serif font-semibold text-noorea-dark mb-8">À propos de Noorea</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        <div>
            <img src="https://images.pexels.com/photos/3762800/pexels-photo-3762800.jpeg?auto=compress&cs=tinysrgb&w=600&h=400&fit=crop" alt="Noorea - Notre histoire" class="rounded-lg shadow-lg w-full h-auto">
        </div>
        <div>
            <h2 class="text-2xl font-serif font-medium text-noorea-dark mb-4">Notre histoire</h2>
            <p class="text-gray-700 mb-4">
                Fondée en 2023, Noorea est née d'une passion pour la beauté multiculturelle et d'une volonté de mettre en lumière les trésors cosmétiques du monde entier, en particulier ceux d'Afrique et du Sénégal.
            </p>
            <p class="text-gray-700 mb-4">
                Notre fondatrice, Aïssatou Diop, a grandi au Sénégal entourée des rituels de beauté transmis de génération en génération. Après des études en cosmétologie en France et plusieurs années d'expérience dans l'industrie, elle a décidé de créer Noorea pour partager ces traditions avec le monde.
            </p>
            <p class="text-gray-700">
                Le nom "Noorea" vient du mot arabe "Noor" qui signifie "lumière" - une référence à notre mission d'illuminer la beauté naturelle de chacun grâce à des produits de qualité qui respectent la peau et l'environnement.
            </p>
        </div>
    </div>
    
    <!-- Nos valeurs -->
    <div class="mb-16">
        <h2 class="text-2xl font-serif font-medium text-noorea-dark mb-8 text-center">Nos valeurs</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-noorea-cream/20 p-8 rounded-lg text-center">
                <div class="w-16 h-16 bg-noorea-gold/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-leaf text-noorea-gold text-2xl"></i>
                </div>
                <h3 class="text-xl font-medium text-noorea-dark mb-2">Naturel</h3>
                <p class="text-gray-600">
                    Nous privilégions les ingrédients naturels, issus de sources durables et éthiques. Nos produits sont formulés pour être efficaces tout en respectant votre peau.
                </p>
            </div>
            
            <div class="bg-noorea-cream/20 p-8 rounded-lg text-center">
                <div class="w-16 h-16 bg-noorea-gold/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-globe-africa text-noorea-gold text-2xl"></i>
                </div>
                <h3 class="text-xl font-medium text-noorea-dark mb-2">Multiculturel</h3>
                <p class="text-gray-600">
                    Nous célébrons la diversité des traditions de beauté à travers le monde. Chaque produit raconte une histoire et porte en lui un savoir-faire ancestral.
                </p>
            </div>
            
            <div class="bg-noorea-cream/20 p-8 rounded-lg text-center">
                <div class="w-16 h-16 bg-noorea-gold/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-noorea-gold text-2xl"></i>
                </div>
                <h3 class="text-xl font-medium text-noorea-dark mb-2">Responsable</h3>
                <p class="text-gray-600">
                    Nous nous engageons à avoir un impact positif sur les communautés avec lesquelles nous travaillons. Nos emballages sont éco-responsables et nos produits ne sont jamais testés sur les animaux.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Notre équipe -->
    <div class="mb-16">
        <h2 class="text-2xl font-serif font-medium text-noorea-dark mb-8 text-center">Notre équipe</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="relative mb-4 w-48 h-48 mx-auto">
                    <div class="absolute inset-0 rounded-full bg-noorea-gold/20"></div>
                    <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Aïssatou Diop" class="rounded-full w-44 h-44 object-cover absolute inset-2">
                </div>
                <h3 class="text-xl font-medium text-noorea-dark">Aïssatou Diop</h3>
                <p class="text-noorea-gold">Fondatrice & CEO</p>
            </div>
            
            <div class="text-center">
                <div class="relative mb-4 w-48 h-48 mx-auto">
                    <div class="absolute inset-0 rounded-full bg-noorea-gold/20"></div>
                    <img src="https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Marie Faye" class="rounded-full w-44 h-44 object-cover absolute inset-2">
                </div>
                <h3 class="text-xl font-medium text-noorea-dark">Marie Faye</h3>
                <p class="text-noorea-gold">Directrice Produit</p>
            </div>
            
            <div class="text-center">
                <div class="relative mb-4 w-48 h-48 mx-auto">
                    <div class="absolute inset-0 rounded-full bg-noorea-gold/20"></div>
                    <img src="https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Omar Ndiaye" class="rounded-full w-44 h-44 object-cover absolute inset-2">
                </div>
                <h3 class="text-xl font-medium text-noorea-dark">Omar Ndiaye</h3>
                <p class="text-noorea-gold">Directeur Marketing</p>
            </div>
            
            <div class="text-center">
                <div class="relative mb-4 w-48 h-48 mx-auto">
                    <div class="absolute inset-0 rounded-full bg-noorea-gold/20"></div>
                    <img src="https://images.pexels.com/photos/1130626/pexels-photo-1130626.jpeg?auto=compress&cs=tinysrgb&w=400&h=400&fit=crop" alt="Fatou Sow" class="rounded-full w-44 h-44 object-cover absolute inset-2">
                </div>
                <h3 class="text-xl font-medium text-noorea-dark">Fatou Sow</h3>
                <p class="text-noorea-gold">Responsable R&D</p>
            </div>
        </div>
    </div>
    
    <!-- Partenaires -->
    <div>
        <h2 class="text-2xl font-serif font-medium text-noorea-dark mb-8 text-center">Nos partenaires</h2>
        
        <div class="flex flex-wrap justify-center gap-12 items-center">
            <img src="https://via.placeholder.com/120x40/D4AF37/FFFFFF?text=PARTENAIRE+1" alt="Partenaire" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
            <img src="https://via.placeholder.com/120x40/D4AF37/FFFFFF?text=PARTENAIRE+2" alt="Partenaire" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
            <img src="https://via.placeholder.com/120x40/D4AF37/FFFFFF?text=PARTENAIRE+3" alt="Partenaire" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
            <img src="https://via.placeholder.com/120x40/D4AF37/FFFFFF?text=PARTENAIRE+4" alt="Partenaire" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
            <img src="https://via.placeholder.com/120x40/D4AF37/FFFFFF?text=PARTENAIRE+5" alt="Partenaire" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
        </div>
    </div>
</div>
@endsection
