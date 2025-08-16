

<?php if(isset($seoMeta)): ?>
<?php
    extract($seoMeta);
?>
<?php endif; ?>

<?php $__env->startSection('title', $product->name); ?>

<?php if(isset($productSchema)): ?>
<?php $__env->startPush('head'); ?>
<script type="application/ld+json">
<?php echo json_encode($productSchema); ?>

</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>

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
<!-- Hero Banner avec image du produit et fil d'ariane en bas -->
<section class="relative h-64 md:h-96 overflow-hidden pt-0 mt-16 bg-gray-100">
    <!-- Image du produit en arrière-plan -->
    <?php if($product->main_image): ?>
        <?php
            $imageUrl = Str::startsWith($product->main_image, ['http://', 'https://']) 
                ? $product->main_image 
                : asset('storage/' . $product->main_image);
        ?>
        
        <div class="w-full h-full relative">
            <img src="<?php echo e($imageUrl); ?>" 
                 alt="<?php echo e($product->name); ?>" 
                 class="w-full h-full object-cover object-center"
                 style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;"
                 onerror="this.onerror=null; this.src='<?php echo e(asset('images/logo.png')); ?>';">
            
            <!-- Overlay léger pour la lisibilité -->
            <div class="absolute inset-0 bg-black/20"></div>
        </div>
    <?php else: ?>
        <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
            <i class="fas fa-image text-gray-400 text-6xl"></i>
        </div>
    <?php endif; ?>
    
    <!-- Fil d'ariane en bas du hero -->
    <div class="absolute bottom-0 left-0 right-0 py-3 bg-black/30 backdrop-blur-sm">
        <div class="container mx-auto px-6">
            <nav class="flex text-sm text-white">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-noorea-gold transition-colors">Accueil</a>
                <span class="mx-2 text-white/70">/</span>
                <a href="<?php echo e(route('products')); ?>" class="hover:text-noorea-gold transition-colors">Boutique</a>
                <span class="mx-2 text-white/70">/</span>
                <a href="<?php echo e(route('categories.show', $product->category->slug)); ?>" class="hover:text-noorea-gold transition-colors"><?php echo e($product->category->name); ?></a>
                <span class="mx-2 text-white/70">/</span>
                <span class="text-noorea-gold font-medium"><?php echo e($product->name); ?></span>
            </nav>
        </div>
    </div>
</section>

<!-- Section Détails du Produit -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Colonne de gauche: Image et galerie -->
            <div class="flex flex-col items-center">
                <!-- Image secondaire du produit (plus petite) -->
                <div class="mb-6 rounded-xl overflow-hidden shadow-lg border border-gray-100 w-full max-w-sm">
                    <?php if($product->main_image): ?>
                        <?php
                            $imageUrl = Str::startsWith($product->main_image, ['http://', 'https://']) 
                                ? $product->main_image 
                                : asset('storage/' . $product->main_image);
                        ?>
                        <div class="aspect-square">
                            <img id="main-product-image" src="<?php echo e($imageUrl); ?>" 
                                 alt="<?php echo e($product->name); ?>" 
                                 class="w-full h-full object-contain"
                                 onerror="this.onerror=null; this.src='<?php echo e(asset('images/logo.png')); ?>';">
                        </div>
                    <?php else: ?>
                        <div class="aspect-square bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if($product->images && count($product->images) > 1): ?>
                <!-- Galerie d'images (miniatures) -->
                <div class="grid grid-cols-6 gap-2 w-full max-w-sm">
                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="aspect-square overflow-hidden rounded-lg border-2 hover:border-noorea-gold cursor-pointer transition-all hover:shadow-lg <?php echo e($index === 0 ? 'border-noorea-gold' : 'border-gray-200'); ?>">
                        <img src="<?php echo e(asset('storage/' . $image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover thumbnail-image">
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Colonne de droite: Informations produit -->
            <div>
                <!-- En-tête du produit -->
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-noorea-dark mb-4"><?php echo e($product->name); ?></h1>
                    <div class="flex items-center mb-4">
                        <div class="flex items-center mr-4">
                            <i class="fas fa-crown text-noorea-gold mr-2"></i>
                            <span class="text-gray-600"><?php echo e($product->brand->name); ?></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-th-large text-noorea-gold mr-2"></i>
                            <span class="text-gray-600"><?php echo e($product->category->name); ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Prix -->
                <div class="mb-6">
                    <div class="flex items-baseline">
                        <span class="text-3xl font-bold text-noorea-gold">
                            <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA
                        </span>
                        <?php if($product->is_on_sale): ?>
                        <span class="ml-3 text-xl text-gray-500 line-through">
                            <?php echo e(number_format($product->sale_price, 0, ',', ' ')); ?> FCFA
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Description courte -->
                <?php if($product->short_description): ?>
                <div class="mb-6 text-gray-600 leading-relaxed">
                    <p><?php echo e($product->short_description); ?></p>
                </div>
                <?php endif; ?>
                
                <!-- Actions -->
                <div class="mb-8 flex flex-col space-y-4">
                    <!-- Quantité et calcul du total -->
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-700 font-medium">Quantité:</span>
                            <div class="flex items-center border border-gray-300 rounded-lg bg-white">
                                <button class="px-4 py-2 text-gray-600 hover:text-noorea-gold transition-colors" onclick="decrementQuantity()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" id="quantity" class="w-12 text-center border-0 focus:ring-0" value="1" min="1" max="<?php echo e($product->stock_quantity); ?>" onchange="updateTotal()">
                                <button class="px-4 py-2 text-gray-600 hover:text-noorea-gold transition-colors" onclick="incrementQuantity()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 font-medium">Total:</span>
                            <span id="total-price" class="text-2xl font-bold text-noorea-gold"><?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA</span>
                        </div>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <div class="flex flex-wrap items-center gap-3">
                        <button 
                            class="add-to-cart-btn bg-noorea-gold hover:bg-yellow-600 text-white px-6 py-3 rounded-lg transition-all transform hover:scale-105 flex items-center flex-1"
                            data-product-id="<?php echo e($product->id); ?>"
                            data-product-name="<?php echo e($product->name); ?>"
                            data-product-price="<?php echo e($product->price); ?>"
                            data-product-image="<?php echo e(Str::startsWith($product->main_image, ['http://', 'https://']) ? $product->main_image : asset('storage/' . $product->main_image)); ?>"
                            onclick="event.stopPropagation();">
                            <i class="fas fa-shopping-bag mr-2"></i>
                            Ajouter au panier
                        </button>
                        
                        <a href="https://wa.me/221777777777?text=Bonjour, je suis intéressé(e) par le produit : <?php echo e($product->name); ?> à <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition-all transform hover:scale-105 flex items-center">
                            <i class="fab fa-whatsapp mr-2"></i>
                            WhatsApp
                        </a>
                    </div>
                    
                    <!-- Autres actions -->
                    <div class="flex items-center space-x-4">
                        <button class="flex items-center text-gray-600 hover:text-noorea-gold transition-colors">
                            <i class="fas fa-heart mr-2"></i>
                            Ajouter aux favoris
                        </button>
                        <button class="flex items-center text-gray-600 hover:text-noorea-gold transition-colors">
                            <i class="fas fa-share-alt mr-2"></i>
                            Partager
                        </button>
                    </div>
                </div>
                
                <!-- Disponibilité et Livraison -->
                <div class="space-y-3 border-t border-gray-200 pt-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">En stock (<?php echo e($product->stock_quantity); ?> disponible)</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-truck text-noorea-gold mr-3"></i>
                        <span class="text-gray-700">Livraison disponible à Dakar et en région</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-undo text-noorea-gold mr-3"></i>
                        <span class="text-gray-700">Retour gratuit sous 7 jours</span>
                    </div>
                </div>
                
                <!-- Onglets pour Caractéristiques et Description -->
                <div class="mt-8">
                    <!-- Navigation des onglets -->
                    <div class="border-b border-gray-200">
                        <nav class="flex -mb-px">
                            <button id="tab-caracteristiques" class="tab-button active-tab flex-1 py-4 px-1 text-center border-b-2 border-noorea-gold font-medium text-noorea-gold">
                                <i class="fas fa-list-ul mr-2"></i>Caractéristiques
                            </button>
                            <button id="tab-description" class="tab-button flex-1 py-4 px-1 text-center border-b-2 border-transparent font-medium text-gray-500 hover:text-noorea-gold hover:border-noorea-gold/30">
                                <i class="fas fa-align-left mr-2"></i>Description détaillée
                            </button>
                        </nav>
                    </div>
                    
                    <!-- Contenu des onglets -->
                    <div class="bg-white rounded-b-xl shadow-sm">
                        <!-- Contenu: Caractéristiques -->
                        <div id="content-caracteristiques" class="tab-content block p-6">
                            <div class="space-y-3">
                                <?php if($product->sku): ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Référence</span>
                                    <span class="font-medium"><?php echo e($product->sku); ?></span>
                                </div>
                                <?php endif; ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Marque</span>
                                    <span class="font-medium"><?php echo e($product->brand->name); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Catégorie</span>
                                    <span class="font-medium"><?php echo e($product->category->name); ?></span>
                                </div>
                                <?php if($product->weight): ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Poids</span>
                                    <span class="font-medium"><?php echo e($product->weight); ?> g</span>
                                </div>
                                <?php endif; ?>
                                <?php if($product->dimensions): ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Dimensions</span>
                                    <span class="font-medium"><?php echo e($product->dimensions); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Contenu: Description détaillée -->
                        <div id="content-description" class="tab-content hidden p-6">
                            <div class="prose prose-lg max-w-none text-gray-700">
                                <?php echo $product->description; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- Produits similaires -->
<?php if(isset($relatedProducts) && $relatedProducts->count() > 0): ?>
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-serif font-bold mb-12 text-center text-noorea-dark">
            <span class="inline-block border-b-2 border-noorea-gold pb-2">Vous pourriez aussi aimer</span>
        </h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('products.show', $related->slug)); ?>" class="group">
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="h-48 overflow-hidden">
                        <?php if($related->main_image): ?>
                        <?php
                            $relatedImageUrl = Str::startsWith($related->main_image, ['http://', 'https://']) 
                                ? $related->main_image 
                                : asset('storage/' . $related->main_image);
                        ?>
                        <img src="<?php echo e($relatedImageUrl); ?>" 
                             alt="<?php echo e($related->name); ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             onerror="this.onerror=null; this.src='<?php echo e(asset('images/logo.png')); ?>';">
                        <?php else: ?>
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-3xl"></i>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-noorea-dark group-hover:text-noorea-gold transition-colors"><?php echo e($related->name); ?></h3>
                        <div class="mt-2 font-medium text-noorea-gold">
                            <?php echo e(number_format($related->price, 0, ',', ' ')); ?> FCFA
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

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

/* Styles pour les onglets */
.tab-button {
    transition: all 0.3s ease;
}

.tab-button:hover {
    background-color: rgba(212, 175, 55, 0.05);
}

.active-tab {
    position: relative;
    font-weight: 600;
}

.active-tab::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #d4af37;
    border-radius: 2px;
}

.tab-content {
    transition: opacity 0.3s ease;
}

/* Animation pour la flèche de défilement */
@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.animate-bounce {
    animation: bounce 2s infinite;
}

/* Style pour le défilement fluide */
html {
    scroll-behavior: smooth;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Effet de scroll pour la navbar
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const header = document.querySelector('header');
        
        if (scrollTop > 100) {
            header.style.background = 'rgba(247, 234, 213, 0.9)';
            header.style.backdropFilter = 'blur(12px)';
            header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.15)';
        } else {
            header.style.background = 'transparent';
            header.style.backdropFilter = 'blur(8px)';
            header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.10)';
        }
    });
    
    // Gestion de la galerie d'images
    const thumbnails = document.querySelectorAll('.thumbnail-image');
    const mainProductImage = document.getElementById('main-product-image');
    const heroImage = document.querySelector('.h-64.md\\:h-96.overflow-hidden img');
    
    if (thumbnails.length > 0 && mainProductImage && heroImage) {
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Mise à jour des deux images (hero et produit)
                mainProductImage.src = this.src;
                heroImage.src = this.src;
                
                // Mise à jour des styles de sélection
                const allContainers = document.querySelectorAll('.grid-cols-5 > div');
                allContainers.forEach(container => {
                    container.classList.remove('border-noorea-gold');
                    container.classList.add('border-gray-200');
                });
                
                // Sélectionner le conteneur parent du thumbnail cliqué
                this.parentElement.classList.remove('border-gray-200');
                this.parentElement.classList.add('border-noorea-gold');
            });
        });
    }
    
    // Zoom sur l'image principale au survol (plus petit)
    if (mainProductImage) {
        const imageContainer = mainProductImage.parentElement;
        
        mainProductImage.addEventListener('mousemove', function(e) {
            const { left, top, width, height } = this.getBoundingClientRect();
            const x = (e.clientX - left) / width * 100;
            const y = (e.clientY - top) / height * 100;
            
            this.style.transformOrigin = `${x}% ${y}%`;
        });
        
        imageContainer.addEventListener('mouseenter', function() {
            mainProductImage.style.transform = 'scale(1.5)';
            mainProductImage.style.transition = 'transform 0.3s ease';
        });
        
        imageContainer.addEventListener('mouseleave', function() {
            mainProductImage.style.transform = 'scale(1)';
        });
    }
    
    // Fonctions pour gérer la quantité
    window.incrementQuantity = function() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.getAttribute('max') || 100);
        let value = parseInt(input.value);
        if (value < max) {
            input.value = value + 1;
            updateTotal();
        }
    };
    
    window.decrementQuantity = function() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
            updateTotal();
        }
    };
    
    // Fonction pour mettre à jour le total
    window.updateTotal = function() {
        const quantity = parseInt(document.getElementById('quantity').value);
        const price = <?php echo e($product->price); ?>;
        const total = price * quantity;
        
        // Formater le total avec espace comme séparateur de milliers
        const formattedTotal = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        document.getElementById('total-price').textContent = formattedTotal + " FCFA";
    };
    
    // Gestion des onglets
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Masquer tous les contenus d'onglets
            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('block');
            });
            
            // Désactiver tous les boutons d'onglets
            tabButtons.forEach(btn => {
                btn.classList.remove('active-tab', 'text-noorea-gold', 'border-noorea-gold');
                btn.classList.add('text-gray-500', 'border-transparent');
            });
            
            // Activer l'onglet cliqué
            this.classList.add('active-tab', 'text-noorea-gold', 'border-noorea-gold');
            this.classList.remove('text-gray-500', 'border-transparent');
            
            // Afficher le contenu correspondant
            const tabId = this.id.replace('tab-', 'content-');
            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('block');
        });
    });
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
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/products/show.blade.php ENDPATH**/ ?>