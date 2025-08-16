

<?php $__env->startPush('head'); ?>
<!-- Meta tags et polices d'origine -->
<?php $__env->stopPush(); ?>

<?php $__env->startSection('navbar'); ?>
<!-- Navbar Supérieur -->
<header class="absolute top-0 left-0 w-full z-50 backdrop-blur-md transition-all duration-300">
    <!-- Barre supérieure avec logo, recherche et icônes -->
    <div class="backdrop-blur-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Logo à gauche -->
                <div class="flex-shrink-0">
                    <a href="<?php echo e(route('home')); ?>" class="flex items-center">
                        <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Noorea - L'élégance multiculturelle" class="h-14 md:h-16 w-auto">
                    </a>
                </div>
                
                <!-- Barre de recherche centrale -->
                <div class="flex-1 max-w-2xl mx-8">
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
                    <!-- Compte utilisateur -->
                    <a href="<?php echo e(route('account.dashboard')); ?>" class="navbar-icon-top" title="Mon compte">
                        <i class="fas fa-user text-xl"></i>
                    </a>
                    
                    <!-- Wishlist -->
                    <a href="<?php echo e(route('wishlist')); ?>" class="navbar-icon-top relative" title="Ma wishlist">
                        <i class="fas fa-heart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">3</span>
                    </a>
                    
                    <!-- Panier -->
                    <button id="navbar-cart-button" type="button" class="navbar-icon-top relative" title="Mon panier">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">0</span>
                    </button>
                    
                    <!-- Menu mobile toggle -->
                    <button type="button" class="navbar-icon-top md:hidden" id="mobile-menu-button" aria-label="Menu">
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
            <div class="md:hidden hidden bg-white border-t border-gray-200 shadow-lg" id="mobile-menu">
                <nav class="flex flex-col space-y-1 p-4">
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
                </nav>
            </div>
        </div>
    </div>
</header>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="relative h-screen overflow-hidden pt-0">
    <!-- Carousel d'images hero en arrière-plan -->
    <div class="absolute inset-0 z-0">
        <!-- Images hero en défilement -->
        <div class="hero-carousel absolute inset-0">
            <?php $__empty_1 = true; $__currentLoopData = $heroImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="hero-slide <?php echo e($index === 0 ? 'active' : ''); ?> absolute inset-0">
                    <img src="<?php echo e(asset($image)); ?>" alt="Hero <?php echo e($index + 1); ?>" 
                         class="w-full h-full object-cover object-center" 
                         style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;"
                         onerror="this.parentElement.style.display='none';">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                
                <div class="hero-slide active absolute inset-0">
                    <div class="w-full h-full bg-gradient-to-br from-noorea-cream to-noorea-gold flex items-center justify-center">
                        <div class="text-center text-noorea-dark">
                            <i class="fas fa-crown text-6xl mb-4"></i>
                            <h2 class="text-3xl font-bold">Noorea Beauty</h2>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Overlay léger pour la lisibilité du texte seulement -->
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
                        BOUTIQUE
                    </span>
                </h1>
            </div>
        </div>
    </div>
    
    <!-- Filtre horizontal en bas du hero -->
    <div class="absolute bottom-8 left-0 right-0 z-30">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap items-center justify-center gap-3 bg-transparent backdrop-blur-sm rounded-full px-6 py-4 shadow-xl border border-noorea-gold/30">
                
                <!-- Liste déroulante des catégories -->
                <div class="relative category-selector">
                    <select id="category-filter" class="bg-white/30 backdrop-blur-md text-white font-medium pr-8 py-2 px-4 rounded-full border-2 border-white/40 focus:border-noorea-gold focus:outline-none appearance-none cursor-pointer hover:bg-white/40 transition-all duration-300 shadow-md">
                        <option value="all" selected class="text-white bg-noorea-brown"><i class="fas fa-th"></i> Toutes les catégories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->slug); ?>" class="text-black"><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-noorea-gold">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                
                <!-- Liste déroulante des marques -->
                <div class="relative brand-selector">
                    <select id="brand-filter" class="bg-white/30 backdrop-blur-md text-white font-medium pr-8 py-2 px-4 rounded-full border-2 border-white/40 focus:border-noorea-gold focus:outline-none appearance-none cursor-pointer hover:bg-white/40 transition-all duration-300 shadow-md">
                        <option value="all" selected class="text-white bg-noorea-brown">Toutes les marques</option>
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($brand->slug); ?>" class="text-black"><?php echo e($brand->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-noorea-gold">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                
                <!-- Prix -->
                <div class="flex items-center border-l border-white/40 pl-3 ml-3">
                    <div class="price-selector relative">
                        <select id="price-filter" class="bg-white/30 backdrop-blur-md text-white font-medium pr-8 py-2 px-4 rounded-full border-2 border-white/40 focus:border-noorea-gold focus:outline-none appearance-none cursor-pointer hover:bg-white/40 transition-all duration-300 shadow-md">
                            <option value="all" selected class="text-white bg-noorea-brown">Prix</option>
                            <option value="0-15000" class="text-black">Moins de 15.000 FCFA</option>
                            <option value="15000-30000" class="text-black">15.000 - 30.000 FCFA</option>
                            <option value="30000-60000" class="text-black">30.000 - 60.000 FCFA</option>
                            <option value="60000+" class="text-black">Plus de 60.000 FCFA</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-noorea-gold">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Bouton Filtrer -->
                <button id="apply-filters" type="button" class="bg-noorea-gold hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full transition-all duration-300 hover:shadow-lg border-2 border-white/30 hover:border-white/50">
                    <i class="fas fa-filter mr-2"></i>Filtrer
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Section des résultats -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <!-- En-tête de section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-noorea-brown mb-4">
                Nos Produits
            </h2>
            <div class="mt-6">
                <span id="results-count" class="inline-flex items-center px-4 py-2 bg-noorea-gold/10 text-noorea-brown rounded-full font-medium">
                    <i class="fas fa-box mr-2"></i>
                    <span id="count-number"><?php echo e($products->count()); ?></span> produit(s) trouvé(s)
                </span>
            </div>
        </div>

        <!-- Grille des produits -->
        <div id="products-grid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 group" 
                     data-category="<?php echo e($product->category ? $product->category->slug : ''); ?>" 
                     data-brand="<?php echo e($product->brand ? $product->brand->slug : ''); ?>"
                     data-price="<?php echo e($product->final_price); ?>">
                    
                    <!-- Lien vers la page produit -->
                    <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="block">
                        <!-- Image du produit -->
                        <div class="relative overflow-hidden rounded-t-xl">
                            <img src="<?php echo e($product->main_image ?? 'https://via.placeholder.com/200x200?text=Noorea+Beauty'); ?>" 
                                 alt="<?php echo e($product->name); ?>" 
                                 class="w-full h-40 sm:h-44 md:h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                            
                            <!-- Badge catégorie -->
                            <?php if($product->category): ?>
                            <div class="absolute top-2 left-2">
                                <span class="inline-flex items-center px-2 py-1 bg-white/90 backdrop-blur-sm text-xs font-medium text-noorea-brown rounded-full">
                                    <?php echo e($product->category->name); ?>

                                </span>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Actions rapides -->
                            <div class="absolute top-2 right-2 flex flex-col space-y-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="p-1.5 bg-white/90 backdrop-blur-sm rounded-full text-gray-600 hover:text-noorea-gold hover:bg-white transition-colors duration-200" onclick="event.stopPropagation(); event.preventDefault();">
                                    <i class="fas fa-heart text-sm"></i>
                                </button>
                                <button class="p-1.5 bg-white/90 backdrop-blur-sm rounded-full text-gray-600 hover:text-noorea-gold hover:bg-white transition-colors duration-200" onclick="event.stopPropagation(); event.preventDefault();">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Contenu -->
                        <div class="p-3 md:p-4">
                            <!-- Marque -->
                            <p class="text-xs text-gray-500 mb-1 font-medium">
                                <?php echo e($product->brand ? $product->brand->name : 'Marque non spécifiée'); ?>

                            </p>
                            
                            <!-- Nom du produit -->
                            <h3 class="text-sm md:text-base font-bold text-noorea-brown mb-2 line-clamp-2 group-hover:text-noorea-gold transition-colors duration-200">
                                <?php echo e($product->name); ?>

                            </h3>
                            
                            <!-- Prix -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-lg md:text-xl font-bold text-noorea-gold">
                                    <?php echo e(number_format($product->final_price, 0, ',', '.')); ?> <span class="text-xs">FCFA</span>
                                </div>
                                <?php if($product->is_on_sale): ?>
                                    <div class="text-xs text-gray-400 line-through">
                                        <?php echo e(number_format($product->price, 0, ',', '.')); ?> FCFA
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Bouton Ajouter (en dehors du lien pour éviter les conflits) -->
                    <div class="px-3 pb-3 md:px-4 md:pb-4">
                        <button 
                            class="add-to-cart-btn w-full bg-noorea-gold hover:bg-yellow-600 text-white font-medium py-2 px-3 rounded-lg text-sm transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 flex items-center justify-center"
                            data-product-id="<?php echo e($product->id); ?>"
                            data-product-name="<?php echo e($product->name); ?>"
                            data-product-price="<?php echo e($product->final_price); ?>"
                            data-product-image="<?php echo e($product->main_image ?? asset('images/logo.png')); ?>">
                            <i class="fas fa-shopping-bag mr-1 text-xs"></i>
                            Ajouter
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-16">
                    <i class="fas fa-box-open text-6xl text-gray-300 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-500 mb-4">Aucun produit trouvé</h3>
                    <p class="text-gray-400">Essayez de modifier vos critères de recherche</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Message si aucun résultat -->
        <div id="no-results" class="hidden text-center py-16">
            <i class="fas fa-search text-6xl text-gray-300 mb-6"></i>
            <h3 class="text-2xl font-bold text-gray-500 mb-4">Aucun produit trouvé</h3>
            <p class="text-gray-400">Essayez de modifier vos filtres de recherche</p>
        </div>
    </div>
</section>

<!-- Overlay pour fermer le mini-panier - Désactivé temporairement -->
<!--<div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300"></div>-->

<?php $__env->startPush('scripts'); ?>
<script>
// Code JavaScript uniquement pour le filtrage - la gestion du panier est faite par cart.js
document.addEventListener('DOMContentLoaded', function() {
    console.log('Vue Boutique chargée');
    
    // Éléments du filtrage
    const categoryFilter = document.getElementById('category-filter');
    const brandFilter = document.getElementById('brand-filter');
    const priceFilter = document.getElementById('price-filter');
    const applyFiltersBtn = document.getElementById('apply-filters');
    const productCards = document.querySelectorAll('.product-card');
    const resultsCount = document.getElementById('count-number');
    const noResults = document.getElementById('no-results');
    const productsGrid = document.getElementById('products-grid');
    
    // Fonction pour appliquer les filtres
    function applyFilters() {
        // Récupérer les valeurs sélectionnées
        const category = categoryFilter.value;
        const brand = brandFilter.value;
        const price = priceFilter.value;
        
        console.log("Filtrage avec:", {category, brand, price});
        
        // Compteur pour les produits visibles
        let visibleCount = 0;
        
        // Parcourir chaque carte produit
        productCards.forEach(function(card) {
            // Récupérer les attributs
            const cardCategory = card.getAttribute('data-category') || '';
            const cardBrand = card.getAttribute('data-brand') || '';
            const cardPrice = parseFloat(card.getAttribute('data-price') || '0');
            
            // Par défaut, montrer le produit
            let showProduct = true;
            
            // Filtrer par catégorie si nécessaire
            if (category !== 'all' && cardCategory !== category) {
                showProduct = false;
            }
            
            // Filtrer par marque si nécessaire
            if (showProduct && brand !== 'all' && cardBrand !== brand) {
                showProduct = false;
            }
            
            // Filtrer par prix si nécessaire
            if (showProduct && price !== 'all') {
                let minPrice = 0;
                let maxPrice = Infinity;
                
                if (price === '0-15000') {
                    maxPrice = 15000;
                } else if (price === '15000-30000') {
                    minPrice = 15000;
                    maxPrice = 30000;
                } else if (price === '30000-60000') {
                    minPrice = 30000;
                    maxPrice = 60000;
                } else if (price === '60000+') {
                    minPrice = 60000;
                }
                
                if (cardPrice < minPrice || cardPrice > maxPrice) {
                    showProduct = false;
                }
            }
            
            // Afficher ou masquer la carte
            if (showProduct) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Mettre à jour le compteur
        resultsCount.textContent = visibleCount;
        
        // Afficher/masquer le message "Aucun résultat"
        if (visibleCount === 0) {
            productsGrid.style.display = 'none';
            noResults.classList.remove('hidden');
        } else {
            productsGrid.style.display = 'grid';
            noResults.classList.add('hidden');
        }
    }
    
    // Attacher l'événement au bouton
    if (applyFiltersBtn) {
        // Retirer tout gestionnaire existant
        const newBtn = applyFiltersBtn.cloneNode(true);
        applyFiltersBtn.parentNode.replaceChild(newBtn, applyFiltersBtn);
        
        // Ajouter le nouveau gestionnaire
        newBtn.addEventListener('click', function(e) {
            e.preventDefault();
            applyFilters();
        });
        
        console.log('Événement de clic ajouté au bouton de filtrage');
    } else {
        console.error('ERREUR: Bouton de filtrage non trouvé!');
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Styles pour la navbar supérieure */
.navbar-icon-top {
    color: #ffffff;
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 50%;
    transform: scale(1);
    background-color: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(4px);
    text-shadow: 0 1px 3px rgba(0,0,0,0.3);
}

.navbar-icon-top:hover {
    color: #d4af37;
    background-color: rgba(255, 255, 255, 0.25);
    transform: scale(1.1);
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
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

/* Styles pour les filtres */
select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: transparent;
}

.category-selector,
.brand-selector,
.price-selector {
    transition: all 0.3s ease;
}

.category-selector:hover,
.brand-selector:hover,
.price-selector:hover {
    transform: translateY(-1px);
}

#category-filter,
#brand-filter,
#price-filter {
    color: #ffffff;
    font-weight: 600;
    min-width: 180px;
    transition: all 0.3s ease;
    text-shadow: 0 1px 3px rgba(0,0,0,0.3);
}

#category-filter:focus,
#brand-filter:focus,
#price-filter:focus {
    color: #ffffff;
    border-color: #d4af37;
    outline: none;
    box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.25);
}

#category-filter option,
#brand-filter option,
#price-filter option {
    color: #333333;
    background-color: white;
    font-weight: 500;
}

/* Styles spécifiques pour l'option sélectionnée en blanc */
#category-filter option[value="all"],
#brand-filter option[value="all"],
#price-filter option[value="all"] {
    color: white;
    background-color: #8b7355;
    font-weight: 600;
}

#apply-filters {
    box-shadow: 0 2px 8px rgba(212, 175, 55, 0.3);
}

#apply-filters:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.4);
}

.price-selector:hover .price-filter {
    color: #d4af37;
}

.price-selector:hover i {
    color: #d4af37;
}

/* Styles pour les cartes de produits */
.product-card {
    border: 1px solid rgba(0,0,0,0.05);
    background: white;
}

.product-card:hover {
    border-color: rgba(212, 175, 55, 0.2);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Animation pour le filtrage */
.filter-animation {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/products/index.blade.php ENDPATH**/ ?>