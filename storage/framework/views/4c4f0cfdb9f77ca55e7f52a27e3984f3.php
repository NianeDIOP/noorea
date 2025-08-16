

<?php $__env->startSection('navbar'); ?>
<header class="absolute top-0 left-0 w-full z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between bg-transparent backdrop-blur-none px-4 py-3">
            <!-- Logo Premium -->
            <a href="<?php echo e(route('home')); ?>" class="flex items-center group">
                <div class="relative">
                    <!-- Logo principal -->
                    <div class="relative p-2 group-hover:scale-110 transition-all duration-300 rounded-xl">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Noorea - L'élégance multiculturelle" class="h-12 md:h-16 lg:h-20 w-auto drop-shadow-sm transition-all duration-300">
                    </div>
                    <!-- Particules décoratives -->
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-noorea-gold rounded-full animate-pulse opacity-80"></div>
                    <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-noorea-gold rounded-full animate-pulse opacity-70" style="animation-delay: 0.5s;"></div>
                </div>
            </a>
            <!-- Navigation principale - desktop -->
            <nav class="hidden md:flex space-x-8">
                <a href="<?php echo e(route('home')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('home') ? 'active-dark' : ''); ?>">Accueil</a>
                <a href="<?php echo e(route('products')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('products') ? 'active-dark' : ''); ?>">Boutique</a>
                <a href="<?php echo e(route('categories')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('categories') ? 'active-dark' : ''); ?>">Catégories</a>
                <a href="<?php echo e(route('brands')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('brands') ? 'active-dark' : ''); ?>">Marques</a>
                <a href="<?php echo e(route('blog')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('blog') ? 'active-dark' : ''); ?>">Beauté du Monde</a>
                <a href="<?php echo e(route('about')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('about') ? 'active-dark' : ''); ?>">À propos</a>
            </nav>
            <!-- Actions utilisateur -->
            <div class="flex items-center space-x-5">
                <!-- Recherche -->
                <button type="button" class="navbar-icon text-lg" aria-label="Rechercher">
                    <i class="fas fa-search"></i>
                </button>
                <!-- Compte utilisateur -->
                <a href="<?php echo e(route('account.dashboard')); ?>" class="navbar-icon text-lg" aria-label="Mon compte">
                    <i class="fas fa-user"></i>
                </a>
                <!-- Wishlist -->
                <a href="<?php echo e(route('wishlist')); ?>" class="navbar-icon text-lg" aria-label="Ma wishlist">
                    <i class="fas fa-heart"></i>
                </a>
                <!-- Panier -->
                <a href="<?php echo e(route('cart')); ?>" class="navbar-icon text-lg relative" aria-label="Mon panier">
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
                <a href="<?php echo e(route('home')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('home') ? 'active-dark' : ''); ?>">Accueil</a>
                <a href="<?php echo e(route('products')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('products') ? 'active-dark' : ''); ?>">Boutique</a>
                <a href="<?php echo e(route('categories')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('categories') ? 'active-dark' : ''); ?>">Catégories</a>
                <a href="<?php echo e(route('brands')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('brands') ? 'active-dark' : ''); ?>">Marques</a>
                <a href="<?php echo e(route('blog')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('blog') ? 'active-dark' : ''); ?>">Beauté du Monde</a>
                <a href="<?php echo e(route('about')); ?>" class="nav-link-dark <?php echo e(request()->routeIs('about') ? 'active-dark' : ''); ?>">À propos</a>
            </nav>
        </div>
    </div>
</header>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section Blog -->
<section class="relative h-96 overflow-hidden bg-gradient-to-br from-noorea-dark via-noorea-cream to-noorea-gold/30 pt-24 md:pt-28">
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=1920&h=400&fit=crop')] bg-cover bg-center opacity-30"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-noorea-dark/80 to-noorea-dark/40"></div>
    
    <div class="relative z-30 flex items-center h-full">
        <div class="container mx-auto px-4 text-center">
            <nav class="text-noorea-gold mb-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-yellow-300"></a>
                <span class="mx-2"></span>
                <span class="text-white"></span>
            </nav>
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-4">
                Beauté du Monde
            </h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">
                Découvrez les secrets de beauté des quatre coins du monde et les traditions cosmétiques ancestrales
            </p>
        </div>
    </div>
</section>

<!-- Section articles blog -->
<div class="bg-noorea-cream/30 py-16">
    <div class="container mx-auto px-4">
        <!-- Filtres -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="px-6 py-2 bg-noorea-gold text-white rounded-full font-medium active">Tous</button>
            <button class="px-6 py-2 border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white rounded-full font-medium transition-colors">Soins</button>
            <button class="px-6 py-2 border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white rounded-full font-medium transition-colors">Maquillage</button>
            <button class="px-6 py-2 border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white rounded-full font-medium transition-colors">Traditions</button>
            <button class="px-6 py-2 border border-noorea-gold text-noorea-gold hover:bg-noorea-gold hover:text-white rounded-full font-medium transition-colors">DIY</button>
        </div>
        
        <!-- Article principal en vedette -->
        <div class="mb-16">
            <article class="bg-white rounded-3xl shadow-2xl overflow-hidden group hover:shadow-3xl transition-all duration-500">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="relative overflow-hidden">
                        <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop" 
                             alt="Les secrets du beurre de karité" class="w-full h-80 lg:h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute top-4 left-4 bg-noorea-gold text-white px-3 py-1 rounded-full text-sm font-medium">
                            Article vedette
                        </div>
                    </div>
                    <div class="p-8 lg:p-12 flex flex-col justify-center">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="text-sm bg-noorea-emerald/10 text-noorea-emerald px-3 py-1 rounded-full font-medium">Traditions</span>
                            <span class="text-sm text-gray-500">12 janvier 2025</span>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-serif font-bold text-noorea-dark mb-4 leading-tight">
                            Les Secrets Millénaires du Beurre de Karité du Burkina Faso
                        </h2>
                        <p class="text-gray-700 mb-6 leading-relaxed">
                            Découvrez l'histoire fascinante du beurre de karité, cet "or blanc" africain aux vertus cosmétiques exceptionnelles. 
                            De la récolte traditionnelle aux bienfaits modernes, plongez dans l'univers de cet ingrédient précieux 
                            qui nourrit et protège votre peau depuis des millénaires.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="https://images.pexels.com/photos/3762879/pexels-photo-3762879.jpeg?auto=compress&cs=tinysrgb&w=100&h=100&fit=crop" 
                                     alt="Aïssatou Diop" class="w-10 h-10 rounded-full object-cover">
                                <div>
                                    <p class="font-medium text-noorea-dark">Aïssatou Diop</p>
                                    <p class="text-sm text-gray-500">Fondatrice Noorea</p>
                                </div>
                            </div>
                            <button class="bg-noorea-gold hover:bg-noorea-gold/90 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 hover:scale-105">
                                Lire l'article
                            </button>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        
        <!-- Grille d'articles -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Article 1 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/4465659/pexels-photo-4465659.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Routine beauté marocaine" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-emerald text-white px-2 py-1 rounded-full text-xs">
                        Soins
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-gray-500">8 janvier 2025</span>
                        <span class="text-xs text-gray-400">•</span>
                        <span class="text-xs text-gray-500">5 min de lecture</span>
                    </div>
                    <h3 class="text-xl font-semibold text-noorea-dark mb-3 leading-tight">
                        La Routine Beauté Marocaine : Secrets de l'Huile d'Argan
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Plongez dans les rituels de beauté ancestraux du Maroc et découvrez comment l'huile d'argan transforme votre peau.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Fatima El Mansouri" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-gray-600">Fatima E.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm">
                            Lire plus →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 2 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3373736/pexels-photo-3373736.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Maquillage traditionnel indien" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-rose text-white px-2 py-1 rounded-full text-xs">
                        Maquillage
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-gray-500">5 janvier 2025</span>
                        <span class="text-xs text-gray-400">•</span>
                        <span class="text-xs text-gray-500">7 min de lecture</span>
                    </div>
                    <h3 class="text-xl font-semibold text-noorea-dark mb-3 leading-tight">
                        L'Art du Henné et du Kohl : Traditions Indiennes de Beauté
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Explorez l'art millénaire du maquillage indien et apprenez à intégrer ces techniques dans votre routine moderne.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Priya Sharma" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-gray-600">Priya S.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm">
                            Lire plus →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 3 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/4465124/pexels-photo-4465124.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Soins naturels coréens" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-emerald text-white px-2 py-1 rounded-full text-xs">
                        K-Beauty
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-gray-500">2 janvier 2025</span>
                        <span class="text-xs text-gray-400">•</span>
                        <span class="text-xs text-gray-500">6 min de lecture</span>
                    </div>
                    <h3 class="text-xl font-semibold text-noorea-dark mb-3 leading-tight">
                        K-Beauty : La Routine Coréenne en 10 Étapes Expliquée
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Décryptage de la célèbre routine de soins coréenne et adaptation pour les peaux africaines et méditerranéennes.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/3992206/pexels-photo-3992206.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Min-jung Kim" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-gray-600">Min-jung K.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm">
                            Lire plus →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 4 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3622517/pexels-photo-3622517.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="DIY masques maison" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-gold text-white px-2 py-1 rounded-full text-xs">
                        DIY
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-gray-500">28 décembre 2024</span>
                        <span class="text-xs text-gray-400">•</span>
                        <span class="text-xs text-gray-500">4 min de lecture</span>
                    </div>
                    <h3 class="text-xl font-semibold text-noorea-dark mb-3 leading-tight">
                        5 Masques Maison aux Ingrédients Africains
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Recettes simples et efficaces avec du miel, de l'argile rhassoul et des huiles végétales locales.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/965989/pexels-photo-965989.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Aminata Ba" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-gray-600">Aminata B.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm">
                            Lire plus →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 5 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/3762879/pexels-photo-3762879.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Cheveux afro soins" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-emerald text-white px-2 py-1 rounded-full text-xs">
                        Cheveux
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-gray-500">25 décembre 2024</span>
                        <span class="text-xs text-gray-400">•</span>
                        <span class="text-xs text-gray-500">8 min de lecture</span>
                    </div>
                    <h3 class="text-xl font-semibold text-noorea-dark mb-3 leading-tight">
                        Guide Complet : Soins des Cheveux Crépus et Frisés
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Tout ce qu'il faut savoir pour prendre soin de vos cheveux texturés avec des produits naturels.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/1190829/pexels-photo-1190829.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Khadija Ndiaye" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-gray-600">Khadija N.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm">
                            Lire plus →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 6 -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.pexels.com/photos/1190829/pexels-photo-1190829.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" 
                         alt="Tendances maquillage" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-noorea-rose text-white px-2 py-1 rounded-full text-xs">
                        Tendances
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xs text-gray-500">20 décembre 2024</span>
                        <span class="text-xs text-gray-400">•</span>
                        <span class="text-xs text-gray-500">5 min de lecture</span>
                    </div>
                    <h3 class="text-xl font-semibold text-noorea-dark mb-3 leading-tight">
                        Tendances Maquillage 2025 : L'Élégance Multiculturelle
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Les couleurs et techniques qui vont dominer cette année, adaptées à toutes les carnations.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img src="https://images.pexels.com/photos/3785147/pexels-photo-3785147.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" 
                                 alt="Sira Coulibaly" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-sm text-gray-600">Sira C.</span>
                        </div>
                        <button class="text-noorea-gold hover:text-noorea-gold/80 font-medium text-sm">
                            Lire plus →
                        </button>
                    </div>
                </div>
            </article>
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            <nav class="flex items-center gap-2">
                <button class="px-4 py-2 text-gray-400 hover:text-noorea-gold transition-colors">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-4 py-2 bg-noorea-gold text-white rounded-lg">1</button>
                <button class="px-4 py-2 text-gray-600 hover:text-noorea-gold transition-colors">2</button>
                <button class="px-4 py-2 text-gray-600 hover:text-noorea-gold transition-colors">3</button>
                <span class="px-2 text-gray-400">...</span>
                <button class="px-4 py-2 text-gray-600 hover:text-noorea-gold transition-colors">8</button>
                <button class="px-4 py-2 text-gray-600 hover:text-noorea-gold transition-colors">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </nav>
        </div>
    </div>
</div>

<!-- Newsletter subscription -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-serif font-bold text-noorea-dark mb-4">
                Restez Connectée à la Beauté du Monde
            </h2>
            <p class="text-gray-600 mb-8">
                Recevez nos derniers articles, conseils beauté et offres exclusives directement dans votre boîte mail
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                <input type="email" placeholder="Votre adresse email" 
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:border-noorea-gold focus:ring-1 focus:ring-noorea-gold">
                <button class="bg-noorea-gold hover:bg-noorea-gold/90 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                    S'abonner
                </button>
            </div>
            
            <p class="text-xs text-gray-500 mt-4">
                En vous abonnant, vous acceptez de recevoir nos emails. Vous pouvez vous désabonner à tout moment.
            </p>
        </div>
    </div>
</section>

<script>
// Mobile menu toggle
document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
});

// Filtres blog
document.querySelectorAll('button[class*="px-6 py-2"]').forEach(button => {
    button.addEventListener('click', function() {
        // Retirer la classe active de tous les boutons
        document.querySelectorAll('button[class*="px-6 py-2"]').forEach(btn => {
            btn.classList.remove('bg-noorea-gold', 'text-white');
            btn.classList.add('border', 'border-noorea-gold', 'text-noorea-gold', 'hover:bg-noorea-gold', 'hover:text-white');
        });
        
        // Ajouter la classe active au bouton cliqué
        this.classList.remove('border', 'border-noorea-gold', 'text-noorea-gold', 'hover:bg-noorea-gold', 'hover:text-white');
        this.classList.add('bg-noorea-gold', 'text-white');
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/blog/index.blade.php ENDPATH**/ ?>