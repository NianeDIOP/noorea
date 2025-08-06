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
<!-- Hero Section - Mini banner produit -->
<section class="relative h-80 overflow-hidden bg-gradient-to-br from-noorea-dark via-noorea-cream to-noorea-gold/30 pt-24 md:pt-28">
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=1920&h=400&fit=crop')] bg-cover bg-center opacity-20"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-noorea-dark/70 to-transparent"></div>
    
    <div class="relative z-30 flex items-center h-full">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl">
                <nav class="text-noorea-gold mb-4 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-yellow-300">Accueil</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('products') }}" class="hover:text-yellow-300">Boutique</a>
                    <span class="mx-2">/</span>
                    <span class="text-white">Crème Hydratante Premium</span>
                </nav>
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">
                    Détail Produit
                </h1>
                <p class="text-xl text-gray-200">
                    Découvrez tous les détails de nos produits premium
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contenu principal produit -->
<div class="bg-noorea-cream/30 py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Galerie d'images -->
            <div class="space-y-4">
                <!-- Image principale -->
                <div class="relative overflow-hidden rounded-2xl shadow-2xl bg-white p-4">
                    <img id="main-image" src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=600&h=600&fit=crop" 
                         alt="Crème Hydratante Premium" class="w-full h-96 object-cover rounded-xl">
                    
                    <!-- Badge promotion -->
                    <div class="absolute top-6 left-6 bg-noorea-rose text-white px-3 py-1 rounded-full text-sm font-medium">
                        -15%
                    </div>
                    
                    <!-- Badge nouveau -->
                    <div class="absolute top-6 right-6 bg-noorea-emerald text-white px-3 py-1 rounded-full text-sm font-medium">
                        Nouveau
                    </div>
                </div>
                
                <!-- Miniatures -->
                <div class="grid grid-cols-4 gap-3">
                    <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=150&h=150&fit=crop" 
                         alt="Vue 1" class="w-full h-20 object-cover rounded-lg cursor-pointer opacity-60 hover:opacity-200 transition-opacity border-2 border-transparent hover:border-noorea-gold thumbnail-image">
                    <img src="https://images.pexels.com/photos/4465124/pexels-photo-4465124.jpeg?auto=compress&cs=tinysrgb&w=150&h=150&fit=crop" 
                         alt="Vue 2" class="w-full h-20 object-cover rounded-lg cursor-pointer opacity-60 hover:opacity-200 transition-opacity border-2 border-transparent hover:border-noorea-gold thumbnail-image">
                    <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=150&h=150&fit=crop" 
                         alt="Vue 3" class="w-full h-20 object-cover rounded-lg cursor-pointer opacity-60 hover:opacity-200 transition-opacity border-2 border-transparent hover:border-noorea-gold thumbnail-image">
                    <img src="https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=150&h=150&fit=crop" 
                         alt="Vue 4" class="w-full h-20 object-cover rounded-lg cursor-pointer opacity-60 hover:opacity-200 transition-opacity border-2 border-transparent hover:border-noorea-gold thumbnail-image">
                </div>
            </div>
            
            <!-- Informations produit -->
            <div class="space-y-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-sm font-medium text-noorea-emerald bg-noorea-emerald/10 px-2 py-1 rounded-full">Soins du visage</span>
                        <span class="text-sm text-gray-500">•</span>
                        <span class="text-sm font-medium text-noorea-gold bg-noorea-gold/10 px-2 py-1 rounded-full">Noorea Premium</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-serif font-bold text-noorea-dark mb-4">
                        Crème Hydratante Premium aux Extraits de Karité
                    </h1>
                    
                    <!-- Étoiles et avis -->
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex items-center">
                            <div class="flex text-noorea-gold">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="ml-2 text-sm text-gray-600">(4.8)</span>
                        </div>
                        <span class="text-sm text-gray-500">•</span>
                        <span class="text-sm text-gray-600">127 avis</span>
                        <span class="text-sm text-gray-500">•</span>
                        <span class="text-sm text-noorea-emerald font-medium">En stock</span>
                    </div>
                    
                    <p class="text-gray-700 leading-relaxed">
                        Une crème hydratante luxueuse formulée avec du beurre de karité pur du Burkina Faso et des huiles précieuses d'argan du Maroc. 
                        Cette formule unique nourrit intensément votre peau tout en respectant sa beauté naturelle.
                    </p>
                </div>
                
                <!-- Prix -->
                <div class="border-t border-b border-gray-200 py-6">
                    <div class="flex items-baseline gap-4">
                        <span class="text-3xl font-bold text-noorea-dark">22 900 CFA</span>
                        <span class="text-xl text-gray-400 line-through">26 900 CFA</span>
                        <span class="bg-noorea-rose text-white px-2 py-1 rounded text-sm font-medium">-15%</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Prix TTC • Livraison gratuite dès 30 000 CFA</p>
                </div>
                
                <!-- Options produit -->
                <div class="space-y-4">
                    <!-- Taille -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Taille</label>
                        <div class="flex gap-3">
                            <button class="border-2 border-noorea-gold bg-noorea-gold/10 text-noorea-dark px-4 py-2 rounded-lg font-medium">50ml</button>
                            <button class="border border-gray-300 hover:border-noorea-gold text-gray-700 px-4 py-2 rounded-lg">100ml (+6 500 CFA)</button>
                            <button class="border border-gray-300 hover:border-noorea-gold text-gray-700 px-4 py-2 rounded-lg">200ml (+11 800 CFA)</button>
                        </div>
                    </div>
                    
                    <!-- Quantité -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantité</label>
                        <div class="flex items-center gap-3">
                            <button class="w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50">-</button>
                            <span class="w-12 text-center">1</span>
                            <button class="w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50">+</button>
                        </div>
                    </div>
                </div>
                
                <!-- Boutons d'action -->
                <div class="space-y-4 pt-6">
                    <!-- Bouton WhatsApp principal -->
                    <a href="https://wa.me/221775551234?text=Bonjour%20Noorea%21%20Je%20suis%20intéressé(e)%20par%20la%20Crème%20hydratante%20visage%20Karité%20%26%20Argan%20à%2022%20900%20CFA%20(en%20promotion%20-15%25).%20Pouvez-vous%20me%20donner%20plus%20d'informations%20sur%20ce%20produit%20et%20les%20modalités%20de%20commande%20%3F" 
                       target="_blank"
                       class="w-full bg-green-500 hover:bg-green-600 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-300 hover:scale-105 shadow-lg flex items-center justify-center gap-3">
                        <i class="fab fa-whatsapp text-xl"></i>
                        Commander via WhatsApp
                    </a>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <a href="tel:+221775551234" 
                           class="border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white py-3 rounded-xl font-medium transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-phone"></i>
                            Appeler
                        </a>
                        <button class="border border-gray-300 text-gray-700 hover:bg-gray-50 py-3 rounded-xl font-medium transition-all duration-300">
                            <i class="fas fa-heart mr-2"></i>
                            Favoris
                        </button>
                    </div>
                    
                    <!-- Bouton partage avec message WhatsApp -->
                    <button onclick="shareProduct()" class="w-full border border-gray-300 text-gray-700 hover:bg-gray-50 py-3 rounded-xl font-medium transition-all duration-300">
                        <i class="fas fa-share-alt mr-2"></i>
                        Partager ce produit
                    </button>
                </div>
                
                <!-- Script de partage -->
                <script>
                function shareProduct() {
                    const productName = "Crème hydratante visage Karité & Argan";
                    const productPrice = "22 900 CFA";
                    const productUrl = window.location.href;
                    const message = `Découvrez ce produit Noorea : ${productName} à ${productPrice} ! ${productUrl}`;
                    
                    if (navigator.share) {
                        navigator.share({
                            title: productName,
                            text: message,
                            url: productUrl
                        });
                    } else {
                        // Fallback vers WhatsApp
                        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
                        window.open(whatsappUrl, '_blank');
                    }
                }
                </script>
                
                <!-- Informations de livraison -->
                <div class="bg-noorea-cream/50 rounded-xl p-4 space-y-3">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-truck text-noorea-emerald"></i>
                        <span class="text-sm text-gray-700">Livraison gratuite dès 30 000 CFA (Standard 3-5 jours)</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fab fa-whatsapp text-green-500"></i>
                        <span class="text-sm text-gray-700">Commande rapide via WhatsApp</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-phone text-noorea-gold"></i>
                        <span class="text-sm text-gray-700">Conseil personnalisé par téléphone</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-shield-alt text-noorea-emerald"></i>
                        <span class="text-sm text-gray-700">Produits 100% authentiques</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Onglets d'informations -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="border-b border-gray-200">
                <nav class="flex">
                    <button class="px-6 py-4 text-sm font-medium border-b-2 border-noorea-gold text-noorea-gold bg-noorea-gold/5 tab-button active" data-tab="description">
                        Description
                    </button>
                    <button class="px-6 py-4 text-sm font-medium text-gray-700 hover:text-noorea-gold tab-button" data-tab="ingredients">
                        Ingrédients
                    </button>
                    <button class="px-6 py-4 text-sm font-medium text-gray-700 hover:text-noorea-gold tab-button" data-tab="reviews">
                        Avis (127)
                    </button>
                    <button class="px-6 py-4 text-sm font-medium text-gray-700 hover:text-noorea-gold tab-button" data-tab="usage">
                        Utilisation
                    </button>
                </nav>
            </div>
            
            <!-- Contenu des onglets -->
            <div class="p-8">
                <!-- Description -->
                <div id="tab-description" class="tab-content">
                    <h3 class="text-xl font-semibold text-noorea-dark mb-4">Description détaillée</h3>
                    <div class="prose max-w-none text-gray-700">
                        <p class="mb-4">
                            Notre Crème Hydratante Premium est le fruit d'une collaboration exclusive avec les coopératives de femmes du Burkina Faso et du Maroc. 
                            Cette formule unique combine les bienfaits ancestraux du beurre de karité pur avec les propriétés régénérantes de l'huile d'argan.
                        </p>
                        <p class="mb-4">
                            Enrichie en vitamines E et A, cette crème offre une hydratation profonde et durable, tout en protégeant votre peau des agressions extérieures. 
                            Sa texture onctueuse pénètre rapidement sans laisser de film gras.
                        </p>
                        <h4 class="font-semibold text-noorea-dark mb-2">Bienfaits :</h4>
                        <ul class="list-disc list-inside space-y-1 mb-4">
                            <li>Hydratation intense 24h</li>
                            <li>Apaise les peaux sensibles</li>
                            <li>Améliore l'élasticité de la peau</li>
                            <li>Protection antioxydante naturelle</li>
                            <li>Convient à tous types de peaux</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Ingrédients -->
                <div id="tab-ingredients" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-noorea-dark mb-4">Composition INCI</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="font-semibold text-noorea-emerald mb-3">Ingrédients actifs</h4>
                            <ul class="space-y-2 text-gray-700">
                                <li><strong>Butyrospermum Parkii Butter</strong> - Beurre de karité (30%)</li>
                                <li><strong>Argania Spinosa Kernel Oil</strong> - Huile d'argan (15%)</li>
                                <li><strong>Tocopherol</strong> - Vitamine E (2%)</li>
                                <li><strong>Retinyl Palmitate</strong> - Vitamine A (1%)</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-noorea-emerald mb-3">Base hydratante</h4>
                            <ul class="space-y-2 text-gray-700">
                                <li><strong>Aqua</strong> - Eau purifiée</li>
                                <li><strong>Glycerin</strong> - Glycérine végétale</li>
                                <li><strong>Cetearyl Alcohol</strong> - Alcool émulsifiant</li>
                                <li><strong>Phenoxyethanol</strong> - Conservateur naturel</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 p-4 bg-noorea-emerald/10 rounded-lg">
                        <p class="text-sm text-gray-700">
                            <i class="fas fa-leaf text-noorea-emerald mr-2"></i>
                            97% d'ingrédients d'origine naturelle • Sans parabènes • Sans sulfates • Commerce équitable
                        </p>
                    </div>
                </div>
                
                <!-- Avis -->
                <div id="tab-reviews" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-noorea-dark mb-6">Avis clients</h3>
                    
                    <!-- Résumé des notes -->
                    <div class="bg-noorea-cream/30 rounded-xl p-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-noorea-dark mb-2">4.8/5</div>
                                <div class="flex justify-center text-noorea-gold text-lg mb-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <p class="text-gray-600">Basé sur 127 avis</p>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm w-8">5★</span>
                                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                                        <div class="bg-noorea-gold h-2 rounded-full w-[85%]"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">85%</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm w-8">4★</span>
                                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                                        <div class="bg-noorea-gold h-2 rounded-full w-[12%]"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">12%</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm w-8">3★</span>
                                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                                        <div class="bg-noorea-gold h-2 rounded-full w-[2%]"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">2%</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm w-8">2★</span>
                                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                                        <div class="bg-gray-300 h-2 rounded-full w-[1%]"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">1%</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm w-8">1★</span>
                                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                                        <div class="bg-gray-300 h-2 rounded-full w-[0%]"></div>
                                    </div>
                                    <span class="text-sm text-gray-600">0%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Avis individuels -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-noorea-gold/20 rounded-full flex items-center justify-center">
                                    <span class="font-semibold text-noorea-dark">A</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-4 mb-2">
                                        <h4 class="font-semibold text-noorea-dark">Aïssatou D.</h4>
                                        <div class="flex text-noorea-gold text-sm">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <span class="text-sm text-gray-500">Il y a 3 jours</span>
                                    </div>
                                    <p class="text-gray-700 mb-2">
                                        Excellente crème ! Ma peau n'a jamais été aussi douce. L'odeur est subtile et la texture parfaite. 
                                        Je recommande vivement pour les peaux sèches.
                                    </p>
                                    <p class="text-sm text-gray-500">Achat vérifié • Peau : Sèche</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-noorea-emerald/20 rounded-full flex items-center justify-center">
                                    <span class="font-semibold text-noorea-dark">M</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-4 mb-2">
                                        <h4 class="font-semibold text-noorea-dark">Mariama S.</h4>
                                        <div class="flex text-noorea-gold text-sm">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <span class="text-sm text-gray-500">Il y a 1 semaine</span>
                                    </div>
                                    <p class="text-gray-700 mb-2">
                                        Très bonne qualité, j'adore que ce soit des ingrédients naturels d'Afrique. 
                                        La livraison était rapide et l'emballage soigné.
                                    </p>
                                    <p class="text-sm text-gray-500">Achat vérifié • Peau : Mixte</p>
                                </div>
                            </div>
                        </div>
                        
                        <button class="w-full border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white py-3 rounded-xl font-medium transition-all duration-300">
                            Voir tous les avis
                        </button>
                    </div>
                </div>
                
                <!-- Utilisation -->
                <div id="tab-usage" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-noorea-dark mb-6">Mode d'emploi</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="font-semibold text-noorea-emerald mb-4">Application quotidienne</h4>
                            <ol class="space-y-3">
                                <li class="flex gap-3">
                                    <span class="w-6 h-6 bg-noorea-gold text-white rounded-full flex items-center justify-center text-sm font-semibold">1</span>
                                    <span class="text-gray-700">Nettoyez votre visage avec un nettoyant doux</span>
                                </li>
                                <li class="flex gap-3">
                                    <span class="w-6 h-6 bg-noorea-gold text-white rounded-full flex items-center justify-center text-sm font-semibold">2</span>
                                    <span class="text-gray-700">Appliquez la crème sur peau légèrement humide</span>
                                </li>
                                <li class="flex gap-3">
                                    <span class="w-6 h-6 bg-noorea-gold text-white rounded-full flex items-center justify-center text-sm font-semibold">3</span>
                                    <span class="text-gray-700">Massez délicatement par mouvements circulaires</span>
                                </li>
                                <li class="flex gap-3">
                                    <span class="w-6 h-6 bg-noorea-gold text-white rounded-full flex items-center justify-center text-sm font-semibold">4</span>
                                    <span class="text-gray-700">Laissez pénétrer 2-3 minutes avant le maquillage</span>
                                </li>
                            </ol>
                        </div>
                        
                        <div>
                            <h4 class="font-semibold text-noorea-emerald mb-4">Conseils d'utilisation</h4>
                            <ul class="space-y-3 text-gray-700">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-sun text-noorea-gold mt-1"></i>
                                    <span>Utilisez matin et soir pour une hydratation optimale</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-snowflake text-noorea-emerald mt-1"></i>
                                    <span>Conservez au frais pour un effet rafraîchissant</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-droplet text-noorea-gold mt-1"></i>
                                    <span>Une noisette suffit pour l'ensemble du visage</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-heart text-noorea-rose mt-1"></i>
                                    <span>Peut être utilisée sur le cou et le décolleté</span>
                                </li>
                            </ul>
                            
                            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <h5 class="font-semibold text-yellow-800 mb-2">⚠️ Précautions</h5>
                                <p class="text-sm text-yellow-700">
                                    Évitez le contour des yeux. En cas d'irritation, cessez l'utilisation. 
                                    Testez sur une petite zone avant la première utilisation.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section produits similaires -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-noorea-dark mb-4">Produits similaires</h2>
            <p class="text-gray-600">Découvrez d'autres produits qui pourraient vous plaire</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Produit 1 -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/4465659/pexels-photo-4465659.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Sérum Visage" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-emerald text-white px-2 py-1 rounded-full text-xs">
                        Nouveau
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-noorea-dark mb-2">Sérum Vitamine C</h3>
                    <p class="text-sm text-gray-600 mb-3">Sérum éclaircissant à la vitamine C</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-noorea-emerald">18 950 CFA</span>
                        <button class="bg-noorea-gold text-white px-3 py-1 rounded-lg text-sm hover:bg-noorea-gold/90">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Produit 2 -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Masque Argile" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-rose text-white px-2 py-1 rounded-full text-xs">
                        -20%
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-noorea-dark mb-2">Masque à l'Argile</h3>
                    <p class="text-sm text-gray-600 mb-3">Masque purifiant argile blanche</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-lg font-bold text-noorea-emerald">13 050 CFA</span>
                            <span class="text-sm text-gray-400 line-through ml-2">16 350 CFA</span>
                        </div>
                        <button class="bg-noorea-gold text-white px-3 py-1 rounded-lg text-sm hover:bg-noorea-gold/90">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Produit 3 -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/4465124/pexels-photo-4465124.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Huile Argan" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-noorea-dark mb-2">Huile d'Argan Pure</h3>
                    <p class="text-sm text-gray-600 mb-3">Huile d'argan bio du Maroc</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-noorea-emerald">21 300 CFA</span>
                        <button class="bg-noorea-gold text-white px-3 py-1 rounded-lg text-sm hover:bg-noorea-gold/90">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Produit 4 -->
            <div class="product-card bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Beurre Karité" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-noorea-dark mb-2">Beurre de Karité Pur</h3>
                    <p class="text-sm text-gray-600 mb-3">Beurre de karité brut du Burkina</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-noorea-emerald">10 450 CFA</span>
                        <button class="bg-noorea-gold text-white px-3 py-1 rounded-lg text-sm hover:bg-noorea-gold/90">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Gestion des onglets
document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', () => {
        const tabId = button.getAttribute('data-tab');
        
        // Retirer la classe active de tous les boutons et contenus
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('active', 'border-noorea-gold', 'text-noorea-gold', 'bg-noorea-gold/5');
            btn.classList.add('text-gray-700');
        });
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Ajouter la classe active au bouton cliqué
        button.classList.add('active', 'border-b-2', 'border-noorea-gold', 'text-noorea-gold', 'bg-noorea-gold/5');
        button.classList.remove('text-gray-700');
        
        // Afficher le contenu correspondant
        document.getElementById(`tab-${tabId}`).classList.remove('hidden');
    });
});

// Gestion de la galerie d'images
document.querySelectorAll('.thumbnail-image').forEach(thumb => {
    thumb.addEventListener('click', () => {
        const mainImage = document.getElementById('main-image');
        mainImage.src = thumb.src.replace('w=150&h=150', 'w=600&h=600');
        
        // Retirer la classe active de toutes les miniatures
        document.querySelectorAll('.thumbnail-image').forEach(t => {
            t.classList.remove('opacity-200', 'border-noorea-gold');
            t.classList.add('opacity-60', 'border-transparent');
        });
        
        // Ajouter la classe active à la miniature cliquée
        thumb.classList.remove('opacity-60', 'border-transparent');
        thumb.classList.add('opacity-200', 'border-noorea-gold');
    });
});

// Activer la première miniature par défaut
document.querySelector('.thumbnail-image').classList.remove('opacity-60', 'border-transparent');
document.querySelector('.thumbnail-image').classList.add('opacity-200', 'border-noorea-gold');
</script>
@endsection
