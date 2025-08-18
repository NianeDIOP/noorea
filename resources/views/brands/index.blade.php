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
                    <span class="absolute -top-2 -right-2 bg-noorea-rose text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">0</span>
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
<!-- Hero Section Marques -->
<section class="relative h-96 overflow-hidden bg-gradient-to-br from-noorea-dark via-noorea-cream to-noorea-gold/30 pt-24 md:pt-28">
    <!-- Images de fond cosmétiques -->
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=1920&h=600&fit=crop')] bg-cover bg-center opacity-30"></div>
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=1920&h=600&fit=crop')] bg-cover bg-right opacity-20"></div>
    
    <!-- Overlay gradient -->
    <div class="absolute inset-0 bg-gradient-to-r from-noorea-dark/85 via-noorea-dark/50 to-transparent"></div>
    
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
                    Nos Marques
                </h1>
                <p class="text-xl text-gray-200 leading-relaxed">
                    Découvrez nos marques partenaires sélectionnées avec passion pour leur qualité, 
                    leur authenticité et leur respect des traditions cosmétiques du monde entier.
                </p>
                <div class="flex items-center gap-6 mt-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-noorea-gold">25+</div>
                        <div class="text-sm text-gray-300">Marques</div>
                    </div>
                    <div class="w-px h-12 bg-gray-400"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-noorea-gold">12</div>
                        <div class="text-sm text-gray-300">Pays</div>
                    </div>
                    <div class="w-px h-12 bg-gray-400"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-noorea-gold">100%</div>
                        <div class="text-sm text-gray-300">Authentique</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section marques principales -->
<div class="bg-noorea-cream/30 py-10">
    <div class="container mx-auto px-4">
        <!-- Filtres par région -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="px-6 py-3 bg-noorea-gold text-white rounded-full font-medium shadow-lg hover:shadow-xl transition-all duration-300 active">Toutes</button>
            <button class="px-6 py-3 border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white rounded-full font-medium transition-colors duration-300">Afrique</button>
            <button class="px-6 py-3 border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white rounded-full font-medium transition-colors duration-300">Maghreb</button>
            <button class="px-6 py-3 border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white rounded-full font-medium transition-colors duration-300">Asie</button>
            <button class="px-6 py-3 border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white rounded-full font-medium transition-colors duration-300">Europe</button>
        </div>
        
        <!-- Grille des marques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Marque 1 - Noorea (Maison) -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=500&h=300&fit=crop" 
                         alt="Noorea - Marque Maison" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-noorea-gold text-white px-3 py-1 rounded-full text-sm font-medium">
                        Notre Marque
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-200 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-noorea-gold/20 rounded-full flex items-center justify-center">
                            <span class="text-noorea-gold font-bold text-lg">N</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-noorea-dark">Noorea</h3>
                            <p class="text-sm text-gray-600">Sénégal • Marque Maison</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Notre marque exclusive qui célèbre la beauté multiculturelle à travers des formulations naturelles 
                        inspirées des traditions cosmétiques africaines.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">28 produits</span>
                        </div>
                        <button class="bg-noorea-gold hover:bg-noorea-gold/90 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 hover:scale-105">
                            Découvrir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Marque 2 - Afro Naturel -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.pexels.com/photos/4465124/pexels-photo-4465124.jpeg?auto=compress&cs=tinysrgb&w=500&h=300&fit=crop" 
                         alt="Afro Naturel" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-noorea-emerald text-white px-3 py-1 rounded-full text-sm font-medium">
                        100% Bio
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-noorea-emerald/20 rounded-full flex items-center justify-center">
                            <span class="text-noorea-emerald font-bold text-lg">AN</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-noorea-dark">Afro Naturel</h3>
                            <p class="text-sm text-gray-600">Ghana • Soins Capillaires</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Spécialiste des soins pour cheveux afro et texturés, Afro Naturel utilise exclusivement 
                        des ingrédients naturels d'Afrique de l'Ouest.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">15 produits</span>
                        </div>
                        <button class="bg-noorea-emerald hover:bg-noorea-emerald/90 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 hover:scale-105">
                            Découvrir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Marque 3 - Argan d'Or -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=500&h=300&fit=crop" 
                         alt="Argan d'Or" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-yellow-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                        Premium
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-yellow-600/20 rounded-full flex items-center justify-center">
                            <span class="text-yellow-600 font-bold text-lg">AO</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-noorea-dark">Argan d'Or</h3>
                            <p class="text-sm text-gray-600">Maroc • Huiles Précieuses</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Producteur traditionnel d'huile d'argan pure, Argan d'Or travaille directement avec 
                        les coopératives de femmes berbères du sud du Maroc.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">8 produits</span>
                        </div>
                        <button class="bg-yellow-600 hover:bg-yellow-600/90 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 hover:scale-105">
                            Découvrir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Marque 4 - Sahel Beauty -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=500&h=300&fit=crop" 
                         alt="Sahel Beauty" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-noorea-rose text-white px-3 py-1 rounded-full text-sm font-medium">
                        Tendance
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-noorea-rose/20 rounded-full flex items-center justify-center">
                            <span class="text-noorea-rose font-bold text-lg">SB</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-noorea-dark">Sahel Beauty</h3>
                            <p class="text-sm text-gray-600">Mali • Maquillage</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Marque de maquillage moderne qui met en valeur la beauté des peaux noires et métissées 
                        avec des teintes inspirées des paysages du Sahel.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">22 produits</span>
                        </div>
                        <button class="bg-noorea-rose hover:bg-noorea-rose/90 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 hover:scale-105">
                            Découvrir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Marque 5 - Oriental Essence -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=500&h=300&fit=crop" 
                         alt="Oriental Essence" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                        Luxe
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-purple-600/20 rounded-full flex items-center justify-center">
                            <span class="text-purple-600 font-bold text-lg">OE</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-noorea-dark">Oriental Essence</h3>
                            <p class="text-sm text-gray-600">Tunisie • Parfums</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Maison de parfumerie artisanale qui crée des fragrances uniques à base d'essences 
                        traditionnelles du Maghreb et du Moyen-Orient.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">12 produits</span>
                        </div>
                        <button class="bg-purple-600 hover:bg-purple-600/90 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 hover:scale-105">
                            Découvrir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Marque 6 - K-Glow Seoul -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.pexels.com/photos/4465659/pexels-photo-4465659.jpeg?auto=compress&cs=tinysrgb&w=500&h=300&fit=crop" 
                         alt="K-Glow Seoul" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-pink-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                        K-Beauty
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-pink-500/20 rounded-full flex items-center justify-center">
                            <span class="text-pink-500 font-bold text-lg">KG</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-noorea-dark">K-Glow Seoul</h3>
                            <p class="text-sm text-gray-600">Corée du Sud • Soins</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Marque coréenne innovante spécialisée dans les soins hydratants et anti-âge, 
                        adaptés aux besoins spécifiques des peaux africaines et méditerranéennes.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">18 produits</span>
                        </div>
                        <button class="bg-pink-500 hover:bg-pink-500/90 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 hover:scale-105">
                            Découvrir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section marques partenaires -->
        <div class="mt-16">
            <h2 class="text-3xl font-serif font-bold text-noorea-dark text-center mb-8">Nos Autres Partenaires</h2>
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 items-center opacity-60 hover:opacity-80 transition-opacity duration-300">
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <span class="text-gray-600 font-bold">BK</span>
                        </div>
                        <p class="text-xs text-gray-600">Burkina Karité</p>
                    </div>
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <span class="text-gray-600 font-bold">IV</span>
                        </div>
                        <p class="text-xs text-gray-600">Ivory Nature</p>
                    </div>
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <span class="text-gray-600 font-bold">ML</span>
                        </div>
                        <p class="text-xs text-gray-600">Marrakech Luxe</p>
                    </div>
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <span class="text-gray-600 font-bold">EB</span>
                        </div>
                        <p class="text-xs text-gray-600">Ethiopian Beauty</p>
                    </div>
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <span class="text-gray-600 font-bold">TP</span>
                        </div>
                        <p class="text-xs text-gray-600">Tokyo Pure</p>
                    </div>
                    <div class="text-center p-4 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <span class="text-gray-600 font-bold">MD</span>
                        </div>
                        <p class="text-xs text-gray-600">Méditerranée</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section CTA devenir partenaire -->
<section class="py-16 bg-gradient-to-r from-noorea-dark to-noorea-emerald">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-4">
            Vous êtes une marque ?
        </h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
            Rejoignez notre sélection de marques d'exception et partagez votre vision de la beauté multiculturelle avec notre communauté.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="bg-noorea-gold hover:bg-noorea-gold/90 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 hover:scale-105 shadow-lg">
                Devenir Partenaire
            </button>
            <button class="border-2 border-white text-white hover:bg-white hover:text-noorea-dark px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300">
                En savoir plus
            </button>
        </div>
    </div>
</section>

<script>
// Mobile menu toggle
document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
});

// Filtres par région
document.querySelectorAll('button[class*="px-6 py-3"]').forEach(button => {
    button.addEventListener('click', function() {
        // Retirer la classe active de tous les boutons
        document.querySelectorAll('button[class*="px-6 py-3"]').forEach(btn => {
            btn.classList.remove('bg-noorea-gold', 'text-white');
            btn.classList.add('border', 'border-noorea-gold', 'text-noorea-gold', 'hover:bg-noorea-gold', 'hover:text-white');
        });
        
        // Ajouter la classe active au bouton cliqué
        this.classList.remove('border', 'border-noorea-gold', 'text-noorea-gold', 'hover:bg-noorea-gold', 'hover:text-white');
        this.classList.add('bg-noorea-gold', 'text-white');
        
        // Ici vous pouvez ajouter la logique de filtrage
        console.log('Filtre région:', this.textContent);
    });
});
</script>
@endsection
