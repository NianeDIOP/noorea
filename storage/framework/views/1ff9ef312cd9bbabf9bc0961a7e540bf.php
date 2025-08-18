<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <!-- SEO Meta Tags -->
    <title><?php echo e(isset($seo_title) ? $seo_title : (isset($title) ? $title . ' | Noorea - L\'expérience beauté multiculturelle' : 'Noorea - Boutique de cosmétiques et parfums multiculturels premium au Sénégal')); ?></title>
    <meta name="description" content="<?php echo e(isset($seo_description) ? $seo_description : 'Noorea - Boutique de cosmétiques et parfums multiculturels premium au Sénégal. Découvrez notre sélection de produits de beauté authentiques issus des traditions du monde entier.'); ?>">
    <meta name="keywords" content="<?php echo e(isset($seo_keywords) ? $seo_keywords : 'cosmétiques, parfums, beauté multiculturelle, Sénégal, soins naturels, produits de beauté, maquillage, parfumerie, Dakar, beauté africaine'); ?>">
    <meta name="author" content="Noorea">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(isset($canonical_url) ? $canonical_url : url()->current()); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:title" content="<?php echo e(isset($og_title) ? $og_title : (isset($title) ? $title . ' | Noorea' : 'Noorea - L\'expérience beauté multiculturelle')); ?>">
    <meta property="og:description" content="<?php echo e(isset($og_description) ? $og_description : 'Découvrez Noorea, votre boutique de cosmétiques et parfums multiculturels premium au Sénégal.'); ?>">
    <meta property="og:image" content="<?php echo e(isset($og_image) ? $og_image : asset('images/logo.jpg')); ?>">
    <meta property="og:locale" content="fr_SN">
    <meta property="og:site_name" content="Noorea">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta property="twitter:title" content="<?php echo e(isset($twitter_title) ? $twitter_title : (isset($title) ? $title . ' | Noorea' : 'Noorea - L\'expérience beauté multiculturelle')); ?>">
    <meta property="twitter:description" content="<?php echo e(isset($twitter_description) ? $twitter_description : 'Découvrez Noorea, votre boutique de cosmétiques et parfums multiculturels premium au Sénégal.'); ?>">
    <meta property="twitter:image" content="<?php echo e(isset($twitter_image) ? $twitter_image : asset('images/logo.jpg')); ?>">
    
    <!-- Schema.org for Local Business -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Store",
        "name": "Noorea",
        "description": "Boutique de cosmétiques et parfums multiculturels premium au Sénégal",
        "url": "<?php echo e(config('app.url')); ?>",
        "logo": "<?php echo e(asset('images/logo.jpg')); ?>",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "SN",
            "addressLocality": "Dakar"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "availableLanguage": ["French", "Wolof"]
        },
        "currenciesAccepted": "XOF",
        "paymentAccepted": ["Cash", "Credit Card", "Orange Money", "Wave"],
        "priceRange": "$$"
    }
    </script>
    
    <!-- Favicons -->
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>?v=<?php echo e(time()); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo e(asset('favicon.png')); ?>?v=<?php echo e(time()); ?>" type="image/png">
    <link rel="icon" href="<?php echo e(asset('favicon-192x192.png')); ?>?v=<?php echo e(time()); ?>" sizes="192x192" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo e(asset('apple-touch-icon.png')); ?>?v=<?php echo e(time()); ?>" sizes="180x180">
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/noorea.css', 'resources/js/app.js', 'resources/js/cart.js']); ?>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php echo $__env->yieldPushContent('styles'); ?>
    
    <!-- Google Analytics (décommentez et ajoutez votre ID en production) -->
    <!--
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    </script>
    -->
    
    <!-- Google Search Console (décommentez et ajoutez votre code de vérification en production) -->
    <!-- <meta name="google-site-verification" content="YOUR_VERIFICATION_CODE" /> -->
    
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="antialiased">
    <?php echo $__env->yieldContent('navbar'); ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-noorea-dark text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Logo et à propos -->
                <div>
                    <div class="flex items-center mb-4">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Noorea" class="h-12 w-auto">
                        <div class="ml-3">
                            <div class="text-2xl font-serif font-semibold text-noorea-gold">Noorea</div>
                            <div class="text-sm text-noorea-gold/80 italic font-light">Révélez votre lumière</div>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">Votre destination beauté multiculturelle au Sénégal. Des produits de qualité issus de différentes traditions pour une beauté unique.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-noorea-gold transition-colors" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-white hover:text-noorea-gold transition-colors" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-white hover:text-noorea-gold transition-colors" aria-label="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://wa.me/221781029818" target="_blank" class="text-white hover:text-noorea-gold transition-colors" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Liens rapides -->
                <div>
                    <h3 class="text-xl font-serif mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo e(route('home')); ?>" class="text-gray-300 hover:text-white transition-colors">Accueil</a></li>
                        <li><a href="<?php echo e(route('products')); ?>" class="text-gray-300 hover:text-white transition-colors">Boutique</a></li>
                        <li><a href="<?php echo e(route('blog')); ?>" class="text-gray-300 hover:text-white transition-colors">Blog Beauté</a></li>
                        <li><a href="<?php echo e(route('about')); ?>" class="text-gray-300 hover:text-white transition-colors">À propos</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Catégories -->
                <div>
                    <h3 class="text-xl font-serif mb-4">Catégories</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Soins visage</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Maquillage</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Parfums</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Soins capillaires</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Bien-être</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="text-xl font-serif mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-noorea-gold"></i>
                            <span class="text-gray-300">123 Avenue de la Beauté, Dakar, Sénégal</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-noorea-gold"></i>
                            <span class="text-gray-300">+221 78 102 98 18</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-noorea-gold"></i>
                            <span class="text-gray-300">contact@noorea.sn</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="divider-gold mx-auto w-1/2 my-10"></div>
            
            <!-- Bas de page -->
            <div class="text-center text-gray-400 text-sm">
                <p class="text-noorea-gold/60 italic mb-2">"Révélez votre lumière"</p>
                <p>&copy; <?php echo e(date('Y')); ?> Noorea. Tous droits réservés.</p>
                <div class="flex justify-center mt-2 space-x-4">
                    <a href="#" class="hover:text-white transition-colors">Mentions légales</a>
                    <a href="#" class="hover:text-white transition-colors">Politique de confidentialité</a>
                    <a href="#" class="hover:text-white transition-colors">CGV</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modals, si nécessaire -->
    <div id="search-modal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-serif text-noorea-dark">Rechercher</h3>
                <button type="button" id="close-search" class="text-noorea-dark hover:text-noorea-emerald">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="<?php echo e(route('search')); ?>" method="GET">
                <div class="relative">
                    <input type="text" name="q" placeholder="Rechercher un produit, une marque, etc." 
                           class="w-full border-gray-300 focus:border-noorea-gold focus:ring focus:ring-noorea-gold/20 rounded-lg pl-10 py-3">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Composant du mini-panier -->
    <?php echo $__env->make('components.mini-cart', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Scripts -->
    <script>
        // Contrôle modal de recherche
        document.querySelector('[aria-label="Rechercher"]')?.addEventListener('click', function() {
            document.getElementById('search-modal').classList.remove('hidden');
        });
        
        document.getElementById('close-search')?.addEventListener('click', function() {
            document.getElementById('search-modal').classList.add('hidden');
        });
        
        // Fermer modal en cliquant à l'extérieur
        document.getElementById('search-modal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
        
        // Assurer que le bouton du mini-panier fonctionne dès le chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            // NAVBAR MOBILE - Gestion du menu hamburger
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Simple toggle avec hidden class
                    if (mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.remove('hidden');
                        mobileMenuButton.querySelector('i').className = 'fas fa-times text-xl';
                    } else {
                        mobileMenu.classList.add('hidden');
                        mobileMenuButton.querySelector('i').className = 'fas fa-bars text-xl';
                    }
                });

                // Fermer le menu mobile quand on clique sur un lien
                const mobileLinks = mobileMenu.querySelectorAll('a, button');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        mobileMenuButton.querySelector('i').className = 'fas fa-bars text-xl';
                    });
                });

                // Fermer le menu mobile quand on clique en dehors
                document.addEventListener('click', function(event) {
                    if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                        mobileMenuButton.querySelector('i').className = 'fas fa-bars text-xl';
                    }
                });
            }

            // RECHERCHE MOBILE - Gestion de la barre de recherche
            const mobileSearchButton = document.getElementById('mobile-search-button');
            const mobileSearchBar = document.getElementById('mobile-search-bar');
            const closeMobileSearch = document.getElementById('close-mobile-search');
            const mobileSearchInput = document.getElementById('mobile-search-input');
            
            if (mobileSearchButton && mobileSearchBar && closeMobileSearch && mobileSearchInput) {
                // Ouvrir la recherche mobile
                mobileSearchButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    mobileSearchBar.classList.add('show');
                    setTimeout(() => mobileSearchInput.focus(), 300);
                });
                
                // Fermer la recherche mobile
                closeMobileSearch.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileSearchBar.classList.remove('show');
                });
                
                // Fermer avec Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && mobileSearchBar.classList.contains('show')) {
                        mobileSearchBar.classList.remove('show');
                    }
                });
            }

            // SCROLL HEADER - Effet de transparence
            let lastScrollTop = 0;
            window.addEventListener('scroll', function() {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const header = document.querySelector('header');
                
                if (header) {
                    if (scrollTop > 100) {
                        header.style.background = 'transparent';
                        header.style.backdropFilter = 'blur(12px)';
                        header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.15)';
                    } else {
                        header.style.background = 'transparent';
                        header.style.backdropFilter = 'blur(8px)';
                        header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.10)';
                    }
                }
                lastScrollTop = scrollTop;
            });
            
            // S'assurer que le bouton du mini-panier fonctionne, même avant que cart.js soit entièrement chargé
            const navbarCartButton = document.getElementById('navbar-cart-button');
            if (navbarCartButton) {
                navbarCartButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Bouton panier navbar cliqué via script global');
                    
                    // Le module cart.js se charge de tout maintenant
                    if (typeof window.toggleMiniCart === 'function') {
                        window.toggleMiniCart();
                    } else {
                        console.warn('Module cart.js non encore chargé');
                    }
                });
            }
            
            // Le module cart.js gère maintenant tous les écouteurs du mini-panier
        });
    </script>

    <!-- Composant WhatsApp flottant -->
    <?php echo $__env->make('components.whatsapp-float', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\noorea\resources\views/layouts/app.blade.php ENDPATH**/ ?>