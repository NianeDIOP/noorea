<?php
    $seo_title = "Noorea - Boutique de cosmétiques et parfums multiculturels premium au Sénégal";
    $seo_description = "Découvrez Noorea, votre destination beauté multiculturelle à Dakar. Cosmétiques authentiques, parfums d'exception et soins naturels issus des traditions du monde entier. Livraison gratuite dès 50 000 FCFA.";
    $seo_keywords = "cosmétiques Sénégal, parfums Dakar, beauté multiculturelle, maquillage africain, soins naturels, Noorea boutique, cosmétiques authentiques, parfumerie Dakar, produits beauté Sénégal";
    $og_title = "Noorea - L'expérience beauté multiculturelle au Sénégal";
    $og_description = "Révélez votre lumière avec Noorea. Découvrez notre sélection exclusive de cosmétiques et parfums authentiques issus des traditions beauté du monde entier.";
    $og_image = asset('images/hero/hero1.jpg');
?>

<?php $__env->startPush('head'); ?>
<!-- Meta tags et polices d'origine -->
<?php $__env->stopPush(); ?>

<?php $__env->startSection('navbar'); ?>
<!-- Navbar Supérieur -->
<header class="absolute top-0 left-0 w-full z-50 transition-all duration-300">
    <!-- Barre supérieure avec logo, recherche et icônes -->
    <div class="backdrop-blur-sm bg-white/5 border-b border-white/10">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Logo à gauche -->
                <div class="flex-shrink-0">
                    <a href="<?php echo e(route('home')); ?>" class="flex items-center">
                        <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Noorea - L'élégance multiculturelle" class="h-14 md:h-16 w-auto">
                    </a>
                </div>
                
                <!-- Barre de recherche centrale - Desktop uniquement -->
                <div class="desktop-search flex-1 max-w-2xl mx-8">
                    <div class="relative">
                        <input 
                            type="search" 
                            placeholder="Rechercher des produits, marques, catégories..." 
                            class="w-full px-5 py-3 pl-12 pr-14 bg-white border-2 border-white/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-all duration-300 shadow-xl text-gray-800 placeholder-gray-500 font-medium"
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
                        <?php if(auth()->guard()->check()): ?>
                            <!-- Utilisateur connecté -->
                            <div class="relative group">
                                <a href="<?php echo e(route('account.dashboard')); ?>" class="navbar-icon-top" title="Mon compte">
                                    <i class="fas fa-user text-xl"></i>
                                </a>
                                <!-- Menu déroulant -->
                                <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                    <div class="py-2">
                                        <a href="<?php echo e(route('account.dashboard')); ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                            <i class="fas fa-user mr-2"></i>Mon compte
                                        </a>
                                        <a href="<?php echo e(route('wishlist')); ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                            <i class="fas fa-heart mr-2"></i>Ma wishlist
                                        </a>
                                        <hr class="my-1">
                                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Wishlist -->
                            <a href="<?php echo e(route('wishlist')); ?>" class="navbar-icon-top relative" title="Ma wishlist">
                                <i class="fas fa-heart text-xl"></i>
                                <span class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">3</span>
                            </a>
                        <?php else: ?>
                            <!-- Utilisateur non connecté -->
                            <a href="<?php echo e(route('login')); ?>" class="navbar-icon-top" title="Se connecter">
                                <i class="fas fa-sign-in-alt text-xl"></i>
                            </a>
                            
                            <a href="<?php echo e(route('register')); ?>" class="navbar-icon-top" title="S'inscrire">
                                <i class="fas fa-user-plus text-xl"></i>
                            </a>
                        <?php endif; ?>
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
    <div class="backdrop-blur-sm border-t border-noorea-gold/20" style="background-color: #F7EAD5;">
        <div class="container mx-auto px-4">
            <!-- Navigation principale - desktop -->
            <nav class="hidden md:flex items-center justify-center py-3">
                <div class="flex space-x-8">
                    <a href="<?php echo e(route('home')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('home') ? 'active-gold' : ''); ?> flex items-center">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                    <a href="<?php echo e(route('products')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('products') ? 'active-gold' : ''); ?> flex items-center">
                        <i class="fas fa-shopping-bag mr-2"></i>Boutique
                    </a>
                    <a href="<?php echo e(route('categories')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('categories') ? 'active-gold' : ''); ?> flex items-center">
                        <i class="fas fa-th-large mr-2"></i>Catégories
                    </a>
                    <a href="<?php echo e(route('brands')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('brands') ? 'active-gold' : ''); ?> flex items-center">
                        <i class="fas fa-crown mr-2"></i>Marques
                    </a>
                    <a href="<?php echo e(route('blog')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('blog') ? 'active-gold' : ''); ?> flex items-center">
                        <i class="fas fa-globe mr-2"></i>Beauté du Monde
                    </a>
                    <a href="<?php echo e(route('about')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('about') ? 'active-gold' : ''); ?> flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>À propos
                    </a>
                </div>
            </nav>
            
            <!-- Menu mobile -->
            <div class="hidden" id="mobile-menu">
                <nav class="flex flex-col space-y-1 p-4 bg-white border-t border-gray-200 shadow-lg">
                    <a href="<?php echo e(route('home')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('home') ? 'active-gold' : ''); ?> flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-home mr-3 w-5"></i>Accueil
                    </a>
                    <a href="<?php echo e(route('products')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('products') ? 'active-gold' : ''); ?> flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-shopping-bag mr-3 w-5"></i>Boutique
                    </a>
                    <a href="<?php echo e(route('categories')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('categories') ? 'active-gold' : ''); ?> flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-th-large mr-3 w-5"></i>Catégories
                    </a>
                    <a href="<?php echo e(route('brands')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('brands') ? 'active-gold' : ''); ?> flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-crown mr-3 w-5"></i>Marques
                    </a>
                    <a href="<?php echo e(route('blog')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('blog') ? 'active-gold' : ''); ?> flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-globe mr-3 w-5"></i>Beauté du Monde
                    </a>
                    <a href="<?php echo e(route('about')); ?>" class="nav-link-gold <?php echo e(request()->routeIs('about') ? 'active-gold' : ''); ?> flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-info-circle mr-3 w-5"></i>À propos
                    </a>
                    
                    <!-- Séparateur -->
                    <hr class="my-3 border-gray-200">
                    
                    <!-- Liens d'authentification mobile -->
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('account.dashboard')); ?>" class="nav-link-gold flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-user mr-3 w-5"></i>Mon compte
                        </a>
                        <a href="<?php echo e(route('wishlist')); ?>" class="nav-link-gold flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-heart mr-3 w-5"></i>Ma wishlist
                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="nav-link-gold flex items-center py-3 px-2 rounded-lg hover:bg-gray-50 w-full text-left">
                                <i class="fas fa-sign-out-alt mr-3 w-5"></i>Déconnexion
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="nav-link-gold flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-sign-in-alt mr-3 w-5"></i>Se connecter
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="nav-link-gold flex items-center py-3 px-2 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-user-plus mr-3 w-5"></i>S'inscrire
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </div>
</header>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="relative h-screen overflow-hidden pt-0">
    <!-- Image hero unique en arrière-plan -->
    <div class="absolute inset-0 z-0">
        <img src="<?php echo e(asset('images/hero/hero1.jpg')); ?>" alt="Noorea Beauty - L'élégance multiculturelle" 
             class="w-full h-full object-cover object-center" 
             style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
        
        <!-- Overlay léger pour la lisibilité du texte -->
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/10"></div>
    </div>
    
    <!-- Contenu principal centré -->
    <div class="relative z-30 flex items-center justify-center h-full pt-20 md:pt-24">
        <div class="text-center max-w-4xl mx-auto px-6 md:px-12">
            <!-- Logo/Nom NOOREA -->
            <div class="mb-8">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold mb-4">
                    <span class="bg-gradient-to-r from-noorea-gold via-yellow-400 to-noorea-gold bg-clip-text text-transparent drop-shadow-2xl">
                        NOOREA
                    </span>
                </h1>
                <!-- Ligne décorative -->
                <div class="w-20 md:w-28 h-1 bg-gradient-to-r from-transparent via-noorea-gold to-transparent mx-auto mb-6"></div>
            </div>
            
            <!-- Message principal -->
            <div>
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-serif font-bold text-white mb-8 leading-tight text-center drop-shadow-lg">
                    Découvrez la beauté 
                    <span class="text-noorea-gold bg-gradient-to-r from-noorea-gold to-yellow-300 bg-clip-text text-transparent">
                        multiculturelle
                    </span>
                </h2>
                
                <div class="flex justify-center">
                    <a href="<?php echo e(route('products')); ?>" class="text-base md:text-lg px-8 py-4 bg-noorea-gold hover:bg-yellow-600 text-noorea-dark font-medium transition-all duration-300 shadow-xl rounded-lg">
                        <i class="fas fa-crown mr-2"></i>
                        Découvrir la collection
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Styles et Script pour le carousel -->
<style>
.hero-slide {
    opacity: 0;
    transition: opacity 1.5s ease-in-out;
}
.hero-slide.active {
    opacity: 1;
}
.hero-indicator.active {
    background-color: #d4af37 !important;
    transform: scale(1.2);
}

/* Styles pour les indicateurs du carousel */
.hero-indicator.active {
    background-color: #d4af37 !important;
    transform: scale(1.2);
}

/* Optimisation de la netteté des images hero */
.hero-slide img {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: -moz-crisp-edges;
    image-rendering: crisp-edges;
    image-rendering: high-quality;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transform: translateZ(0) scale(1.0, 1.0);
    -moz-transform: translateZ(0) scale(1.0, 1.0);
    -ms-transform: translateZ(0) scale(1.0, 1.0);
    -o-transform: translateZ(0) scale(1.0, 1.0);
    transform: translateZ(0) scale(1.0, 1.0);
    filter: contrast(1.1) saturate(1.1);
}

/* Styles pour la navbar supérieure */
.navbar-icon-top {
    color: #ffffff;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 50%;
    transform: scale(1);
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(2px);
    text-shadow: 0 1px 3px rgba(0,0,0,0.6);
    border: 1px solid rgba(255, 255, 255, 0.15);
}

.navbar-icon-top:hover {
    color: #d4af37;
    background-color: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    border: 1px solid rgba(212, 175, 55, 0.4);
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


<!-- Bannière USP -->
<section class="bg-noorea-dark text-white py-4 relative overflow-hidden">
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
<section class="py-20 bg-gradient-to-br from-noorea-cream/20 via-white to-noorea-cream/10 relative overflow-hidden">
    <!-- Éléments décoratifs -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-noorea-gold/10 rounded-full blur-xl"></div>
    <div class="absolute bottom-20 right-20 w-32 h-32 bg-noorea-emerald/10 rounded-full blur-xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <!-- En-tête de section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-light text-noorea-dark mb-4 tracking-wide">
                Nos Catégories Phares
            </h2>
            <div class="flex items-center justify-center mb-6">
                <div class="h-px bg-noorea-gold/30 w-20"></div>
                <i class="fas fa-th-large text-noorea-gold text-lg mx-4"></i>
                <div class="h-px bg-noorea-gold/30 w-20"></div>
            </div>
            <p class="text-noorea-dark/70 max-w-2xl mx-auto text-lg">
                Découvrez notre sélection de produits de beauté authentiques par catégorie
            </p>
        </div>
        
        <!-- Grille des catégories -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('categories')); ?>?category=<?php echo e($category->slug); ?>" class="group">
                <article class="bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/10">
                    <div class="relative h-56 overflow-hidden">
                        <?php if($category->image): ?>
                            <?php if(filter_var($category->image, FILTER_VALIDATE_URL)): ?>
                                
                                <img src="<?php echo e($category->image); ?>" alt="<?php echo e($category->name); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <?php else: ?>
                                
                                <img src="<?php echo e($category->image_url); ?>" alt="<?php echo e($category->name); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <?php endif; ?>
                        <?php else: ?>
                            
                            <div class="w-full h-full bg-gradient-to-br from-noorea-cream to-noorea-gold flex items-center justify-center">
                                <i class="fas fa-spa text-4xl text-white/70"></i>
                            </div>
                        <?php endif; ?>
                        
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    <!-- Contenu de la carte -->
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-semibold text-noorea-dark mb-4 group-hover:text-noorea-gold transition-colors duration-300">
                            <?php echo e($category->name); ?>

                        </h3>
                        
                        <!-- Lien découvrir -->
                        <div class="inline-flex items-center text-noorea-gold font-medium text-sm group-hover:text-noorea-emerald transition-colors duration-300">
                            Découvrir
                            <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                        </div>
                    </div>
                </article>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Bouton voir toutes les catégories -->
        <div class="text-center mt-12">
            <a href="<?php echo e(route('categories')); ?>" class="inline-flex items-center text-noorea-gold font-medium text-sm hover:text-noorea-emerald transition-colors duration-300">
                Voir toutes les catégories
                <i class="fas fa-arrow-right ml-2 transform translate-x-0 hover:translate-x-2 transition-transform duration-300"></i>
            </a>
        </div>
    </div>
</section>

<!-- Section Nos Coups de Cœur -->
<section class="py-20 relative overflow-hidden" style="background-color: #F7EAD5;">
    <!-- Éléments décoratifs -->
    <div class="absolute top-20 right-10 w-24 h-24 bg-noorea-rose-gold/10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-10 left-20 w-32 h-32 bg-noorea-gold/10 rounded-full blur-2xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <!-- En-tête de section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-light text-noorea-dark mb-4 tracking-wide">
                Nos Coups de <span class="text-noorea-rose-gold font-medium">Cœur</span>
            </h2>
            <div class="flex items-center justify-center mb-6">
                <div class="h-px bg-noorea-gold/30 w-20"></div>
                <i class="fas fa-heart text-noorea-rose-gold text-lg mx-4"></i>
                <div class="h-px bg-noorea-gold/30 w-20"></div>
            </div>
            <p class="text-noorea-dark/70 max-w-2xl mx-auto text-lg">
                Découvrez notre sélection exclusive de produits chouchous, plébiscités par nos clientes
            </p>
        </div>

        <!-- Grille des produits coups de cœur - 1 ligne de 4 produits -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
            <?php $__currentLoopData = $featuredProducts->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/10">
                <a href="<?php echo e(route('products.show', $product->slug ?? $product->id)); ?>" class="group block">
                    <div class="relative h-64 overflow-hidden">
                        <?php if($product->main_image): ?>
                            <?php if(filter_var($product->main_image, FILTER_VALIDATE_URL)): ?>
                                
                                <img src="<?php echo e($product->main_image); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <?php else: ?>
                                
                                <img src="<?php echo e($product->main_image_url); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <?php endif; ?>
                        <?php else: ?>
                            
                            <div class="w-full h-full bg-gradient-to-br from-noorea-cream to-noorea-rose-gold flex items-center justify-center">
                                <i class="fas fa-heart text-4xl text-white/70"></i>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Badge catégorie -->
                        <?php if($product->category): ?>
                        <div class="absolute top-3 left-3 bg-noorea-gold text-white px-3 py-1 rounded-full text-xs font-medium flex items-center">
                            <i class="fas fa-tag mr-1"></i>
                            <?php echo e($product->category->name); ?>

                        </div>
                        <?php endif; ?>
                        
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    <!-- Contenu de la carte compact avec fond navbar -->
                    <div class="p-4" style="background-color: #F7EAD5;">
                        <h3 class="text-base font-semibold text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300 leading-tight text-center">
                            <?php echo e($product->name); ?>

                        </h3>
                        
                        <!-- Prix compact -->
                        <div class="text-center mb-3">
                            <div class="text-noorea-gold font-bold text-lg">
                                <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA
                            </div>
                        </div>
                        
                        <!-- Bouton compact -->
                        <div class="text-center">
                            <button onclick="NooreaCart.addToCart(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->name)); ?>', <?php echo e($product->price); ?>, '<?php echo e($product->main_image_url ?? asset('images/logo.jpg')); ?>', 1); event.stopPropagation();" 
                                    class="w-full bg-noorea-gold hover:bg-noorea-gold/80 text-white py-2 px-3 rounded-full text-sm font-medium transition-all duration-300 hover:shadow-lg flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-1 text-xs"></i>
                                Ajouter
                            </button>
                        </div>
                    </div>
                </a>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Bouton voir tous les produits -->
        <div class="text-center mt-12">
            <a href="<?php echo e(route('products')); ?>" class="inline-flex items-center bg-noorea-rose-gold hover:bg-noorea-gold text-white font-semibold text-base px-8 py-3 rounded-full transition-all duration-300 hover:shadow-lg hover:scale-105">
                Voir tous les produits
                <i class="fas fa-arrow-right ml-3 transform translate-x-0 hover:translate-x-2 transition-transform duration-300"></i>
            </a>
        </div>
    </div>
</section>
                        
                        
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-base font-bold text-noorea-dark drop-shadow-2xl leading-tight">
    </div>
</section>

<!-- Section Nos Partenaires d'Excellence -->
<section class="py-20 relative overflow-hidden" style="background-color: #F7EAD5;">
    <!-- Éléments décoratifs -->
    <div class="absolute top-20 left-10 w-24 h-24 bg-noorea-gold/10 rounded-full blur-2xl"></div>
    <div class="absolute bottom-10 right-20 w-32 h-32 bg-noorea-rose-gold/10 rounded-full blur-2xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <!-- En-tête de section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-light text-noorea-dark mb-4 tracking-wide">
                Nos Partenaires d'<span class="text-noorea-gold font-medium">Excellence</span>
            </h2>
            <div class="flex items-center justify-center mb-6">
                <div class="h-px bg-noorea-gold/30 w-20"></div>
                <i class="fas fa-crown text-noorea-gold text-lg mx-4"></i>
                <div class="h-px bg-noorea-gold/30 w-20"></div>
            </div>
            <p class="text-noorea-dark/70 max-w-2xl mx-auto text-lg">
                Découvrez les marques de prestige qui nous font confiance pour offrir l'excellence à nos clientes
            </p>
        </div>

        <!-- Grille des marques -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
            <?php $__currentLoopData = $brands->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="bg-white/90 backdrop-blur-sm rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-4px] border border-noorea-gold/10 group">
                <div class="p-6 h-40 flex items-center justify-center">
                    <?php if($brand->logo): ?>
                        <?php if(Str::startsWith($brand->logo, ['http://', 'https://'])): ?>
                            
                            <img src="<?php echo e($brand->logo); ?>" alt="<?php echo e($brand->name); ?>" class="max-w-full max-h-24 object-contain filter grayscale group-hover:grayscale-0 transition-all duration-300 group-hover:scale-110">
                        <?php else: ?>
                            
                            <img src="<?php echo e($brand->logo_url); ?>" alt="<?php echo e($brand->name); ?>" class="max-w-full max-h-24 object-contain filter grayscale group-hover:grayscale-0 transition-all duration-300 group-hover:scale-110">
                        <?php endif; ?>
                    <?php else: ?>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-noorea-gold to-noorea-rose-gold rounded-full flex items-center justify-center mb-3 mx-auto group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-crown text-white text-xl"></i>
                            </div>
                            <h3 class="text-sm font-semibold text-noorea-dark group-hover:text-noorea-gold transition-colors duration-300">
                                <?php echo e($brand->name); ?>

                            </h3>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Bouton voir toutes les marques -->
        <div class="text-center mt-12">
            <a href="<?php echo e(route('brands')); ?>" class="inline-flex items-center bg-noorea-gold hover:bg-noorea-rose-gold text-white font-semibold text-base px-8 py-3 rounded-full transition-all duration-300 hover:shadow-lg hover:scale-105">
                Découvrir toutes nos marques
                <i class="fas fa-arrow-right ml-3 transform translate-x-0 hover:translate-x-2 transition-transform duration-300"></i>
            </a>
        </div>
    </div>
</section>

</section>

<!-- Bannière promotionnelle -->
<section class="py-16 text-white relative overflow-hidden">
    <!-- Fond simplifié -->
    <div class="absolute inset-0 bg-gradient-to-br from-noorea-dark to-noorea-emerald"></div>
    
    <!-- Motifs subtils -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-20 w-32 h-32 border border-white rounded-full"></div>
        <div class="absolute bottom-20 right-20 w-24 h-24 border border-white rounded-full"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-lg mx-auto text-center">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                <!-- Titre principal -->
                <h2 class="text-3xl font-serif font-bold mb-3">
                    <span class="text-noorea-gold text-4xl">10%</span> de réduction<br>
                    sur votre première commande
                </h2>
                
                <!-- Description -->
                <p class="text-base mb-6 text-white/90">
                    Inscrivez-vous à notre newsletter et recevez un code promo exclusif
                </p>
                
                <!-- Formulaire simplifié -->
                <form class="space-y-4">
                    <input 
                        type="email" 
                        placeholder="Votre adresse email" 
                        class="w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold text-noorea-dark bg-white placeholder-gray-500"
                    >
                    
                    <button 
                        type="submit" 
                        class="w-full bg-noorea-gold hover:bg-noorea-rose-gold text-noorea-dark font-semibold px-6 py-3 rounded-lg transition-colors duration-300"
                    >
                        Obtenir mon code promo
                    </button>
                </form>
                
                <!-- Note de confidentialité -->
                <p class="text-white/70 text-xs mt-4">
                    Vos données sont protégées. Désabonnement possible à tout moment.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Témoignages -->
<section class="py-20 relative overflow-hidden bg-noorea-dark">
    <!-- Éléments décoratifs -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-noorea-gold/10 rounded-full blur-xl"></div>
    <div class="absolute bottom-20 right-20 w-32 h-32 bg-noorea-rose-gold/10 rounded-full blur-xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <!-- En-tête de section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-light text-white mb-4 tracking-wide">
                Témoignages de nos Clientes
            </h2>
            <div class="flex items-center justify-center mb-6">
                <div class="h-px bg-noorea-gold/30 w-20"></div>
                <i class="fas fa-heart text-noorea-gold text-lg mx-4"></i>
                <div class="h-px bg-noorea-gold/30 w-20"></div>
            </div>
            <p class="text-white/70 max-w-2xl mx-auto text-lg">
                Découvrez les expériences authentiques de celles qui nous font confiance
            </p>
        </div>
        
        <!-- Grille des témoignages -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Témoignage 1 -->
            <div class="group bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/10">
                <!-- Citation -->
                <div class="text-noorea-gold/30 text-4xl mb-4">
                    <i class="fas fa-quote-left"></i>
                </div>
                
                <!-- Étoiles -->
                <div class="flex text-noorea-gold mb-6 text-lg">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                
                <!-- Texte du témoignage -->
                <p class="text-noorea-dark/80 mb-6 text-lg leading-relaxed font-light">
                    J'utilise la crème hydratante depuis un mois et ma peau n'a jamais été aussi douce. Les ingrédients naturels font vraiment la différence!
                </p>
                
                <!-- Profil client -->
                <div class="flex items-center pt-4 border-t border-noorea-gold/10">
                    <div class="w-12 h-12 rounded-full bg-noorea-cream/80 border-2 border-noorea-gold/30 flex items-center justify-center text-noorea-dark font-semibold mr-4">
                        S
                    </div>
                    <div>
                        <h4 class="font-semibold text-noorea-dark">Sophie Martin</h4>
                        <p class="text-sm text-noorea-dark/60">Cliente fidèle</p>
                    </div>
                </div>
            </div>
            
            <!-- Témoignage 2 -->
            <div class="group bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/10">
                <!-- Citation -->
                <div class="text-noorea-gold/30 text-4xl mb-4">
                    <i class="fas fa-quote-left"></i>
                </div>
                
                <!-- Étoiles -->
                <div class="flex text-noorea-gold mb-6 text-lg">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                
                <!-- Texte du témoignage -->
                <p class="text-noorea-dark/80 mb-6 text-lg leading-relaxed font-light">
                    Le sérum éclat a complètement transformé mon teint. Je reçois des compliments tous les jours! L'odeur est divine.
                </p>
                
                <!-- Profil client -->
                <div class="flex items-center pt-4 border-t border-noorea-gold/10">
                    <div class="w-12 h-12 rounded-full bg-noorea-cream/80 border-2 border-noorea-gold/30 flex items-center justify-center text-noorea-dark font-semibold mr-4">
                        A
                    </div>
                    <div>
                        <h4 class="font-semibold text-noorea-dark">Aminata Diallo</h4>
                        <p class="text-sm text-noorea-dark/60">Cliente depuis 2024</p>
                    </div>
                </div>
            </div>
            
            <!-- Témoignage 3 -->
            <div class="group bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/10">
                <!-- Citation -->
                <div class="text-noorea-gold/30 text-4xl mb-4">
                    <i class="fas fa-quote-left"></i>
                </div>
                
                <!-- Étoiles -->
                <div class="flex text-noorea-gold mb-6 text-lg">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                
                <!-- Texte du témoignage -->
                <p class="text-noorea-dark/80 mb-6 text-lg leading-relaxed font-light">
                    L'huile capillaire est un miracle pour mes cheveux bouclés. Ils sont maintenant brillants et bien hydratés sans être alourdis.
                </p>
                
                <!-- Profil client -->
                <div class="flex items-center pt-4 border-t border-noorea-gold/10">
                    <div class="w-12 h-12 rounded-full bg-noorea-cream/80 border-2 border-noorea-gold/30 flex items-center justify-center text-noorea-dark font-semibold mr-4">
                        F
                    </div>
                    <div>
                        <h4 class="font-semibold text-noorea-dark">Fatou Keita</h4>
                        <p class="text-sm text-noorea-dark/60">Cliente satisfaite</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog beauté -->
<section class="py-20 bg-gradient-to-br from-white via-noorea-cream/5 to-white relative overflow-hidden">
    <!-- Éléments décoratifs -->
    <div class="absolute top-20 right-10 w-24 h-24 bg-noorea-gold/5 rounded-full blur-2xl"></div>
    <div class="absolute bottom-10 left-20 w-32 h-32 bg-noorea-emerald/5 rounded-full blur-2xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <!-- En-tête de section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-light text-noorea-dark mb-4 tracking-wide">
                Magazine Beauté
            </h2>
            <div class="flex items-center justify-center mb-6">
                <div class="h-px bg-noorea-gold/30 w-20"></div>
                <i class="fas fa-feather-alt text-noorea-gold text-lg mx-4"></i>
                <div class="h-px bg-noorea-gold/30 w-20"></div>
            </div>
            <p class="text-noorea-dark/70 max-w-2xl mx-auto text-lg">
                Explorez nos conseils beauté, rituels ancestraux et tendances actuelles
            </p>
        </div>
        
        <!-- Grille des articles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Article 1 -->
            <article class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/5">
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.pexels.com/photos/3762876/pexels-photo-3762876.jpeg?auto=compress&cs=tinysrgb&w=600&h=300&fit=crop" 
                         alt="Rituels de beauté" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Badge catégorie -->
                    <div class="absolute top-4 left-4 bg-noorea-gold text-white px-3 py-1 rounded-full text-xs font-medium">
                        Rituels
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Date -->
                    <div class="flex items-center text-noorea-gold/80 text-sm mb-3">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        12 juillet 2025
                    </div>
                    
                    <!-- Titre -->
                    <h3 class="text-xl font-semibold text-noorea-dark mb-3 group-hover:text-noorea-gold transition-colors duration-300 leading-tight">
                        5 rituels de beauté africains à adopter
                    </h3>
                    
                    <!-- Extrait -->
                    <p class="text-noorea-dark/70 text-sm mb-4 leading-relaxed">
                        Découvrez les secrets de beauté transmis de génération en génération en Afrique, pour une peau éclatante et des cheveux sublimes...
                    </p>
                    
                    <!-- Lien de lecture -->
                    <a href="#" class="inline-flex items-center text-noorea-gold font-medium text-sm hover:text-noorea-emerald transition-colors duration-300">
                        Lire l'article
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </a>
                </div>
            </article>
            
            <!-- Article 2 -->
            <article class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/5">
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.pexels.com/photos/4041392/pexels-photo-4041392.jpeg?auto=compress&cs=tinysrgb&w=600&h=300&fit=crop" 
                         alt="Soins naturels" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Badge catégorie -->
                    <div class="absolute top-4 left-4 bg-noorea-emerald text-white px-3 py-1 rounded-full text-xs font-medium">
                        Soins
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Date -->
                    <div class="flex items-center text-noorea-gold/80 text-sm mb-3">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        5 juillet 2025
                    </div>
                    
                    <!-- Titre -->
                    <h3 class="text-xl font-semibold text-noorea-dark mb-3 group-hover:text-noorea-gold transition-colors duration-300 leading-tight">
                        Les bienfaits du karité pour la peau et les cheveux
                    </h3>
                    
                    <!-- Extrait -->
                    <p class="text-noorea-dark/70 text-sm mb-4 leading-relaxed">
                        Ce beurre précieux est un véritable trésor de beauté aux multiples vertus, découvrez comment l'intégrer à votre routine...
                    </p>
                    
                    <!-- Lien de lecture -->
                    <a href="#" class="inline-flex items-center text-noorea-gold font-medium text-sm hover:text-noorea-emerald transition-colors duration-300">
                        Lire l'article
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </a>
                </div>
            </article>
            
            <!-- Article 3 -->
            <article class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/5">
                <div class="relative h-64 overflow-hidden">
                    <img src="https://images.pexels.com/photos/2113855/pexels-photo-2113855.jpeg?auto=compress&cs=tinysrgb&w=600&h=300&fit=crop" 
                         alt="Maquillage" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Badge catégorie -->
                    <div class="absolute top-4 left-4 bg-noorea-rose-gold text-white px-3 py-1 rounded-full text-xs font-medium">
                        Maquillage
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Date -->
                    <div class="flex items-center text-noorea-gold/80 text-sm mb-3">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        1 juillet 2025
                    </div>
                    
                    <!-- Titre -->
                    <h3 class="text-xl font-semibold text-noorea-dark mb-3 group-hover:text-noorea-gold transition-colors duration-300 leading-tight">
                        Comment créer un maquillage lumineux pour l'été
                    </h3>
                    
                    <!-- Extrait -->
                    <p class="text-noorea-dark/70 text-sm mb-4 leading-relaxed">
                        Nos conseils pour un teint éclatant et une mise en beauté qui résiste à la chaleur et sublime votre peau naturelle...
                    </p>
                    
                    <!-- Lien de lecture -->
                    <a href="#" class="inline-flex items-center text-noorea-gold font-medium text-sm hover:text-noorea-emerald transition-colors duration-300">
                        Lire l'article
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </a>
                </div>
            </article>
                    <span class="text-noorea-gold text-sm font-medium inline-flex items-center">
                        Lire la suite 
                        <i class="fas fa-arrow-right ml-2 transform translate-x-0 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </div>
            </a>
        </div>
        
        <div class="text-center mt-10">
            <a href="<?php echo e(route('blog')); ?>" class="btn-secondary inline-block transform transition-transform hover:scale-105">
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser NooreaCart si pas déjà fait
    if (typeof NooreaCart !== 'undefined') {
        console.log('NooreaCart disponible pour la page welcome');
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/welcome.blade.php ENDPATH**/ ?>