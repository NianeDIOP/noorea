<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title><?php echo e(isset($title) ? $title . ' | ' : ''); ?>Noorea Admin - Espace d'administration</title>
    
    <!-- Favicons -->
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>?v=<?php echo e(time()); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo e(asset('favicon.png')); ?>?v=<?php echo e(time()); ?>" type="image/png">
    <link rel="icon" href="<?php echo e(asset('favicon-192x192.png')); ?>?v=<?php echo e(time()); ?>" sizes="192x192" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo e(asset('apple-touch-icon.png')); ?>?v=<?php echo e(time()); ?>" sizes="180x180">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/noorea.css', 'resources/js/app.js']); ?>
    
    <!-- Font Awesome -->
    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js']); ?>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg border-b border-gray-200">
            <div class="mx-auto px-6">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <!-- Logo Noorea -->
                        <div class="flex-shrink-0">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center group">
                                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Noorea" class="h-10 w-auto">
                                <div class="ml-3">
                                    <div class="text-2xl font-serif font-semibold text-noorea-gold">Noorea</div>
                                    <div class="text-xs text-gray-500 font-medium uppercase tracking-wide">Administration</div>
                                </div>
                            </a>
                        </div>

                        <!-- Navigation principale -->
                        <div class="hidden md:ml-10 md:flex md:items-center md:space-x-8">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" 
                               class="admin-nav-link <?php echo e(request()->routeIs('admin.dashboard*') ? 'active' : ''); ?>">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                            
                            <div class="relative group">
                                <button class="admin-nav-link <?php echo e(request()->routeIs('admin.products*') || request()->routeIs('admin.categories*') || request()->routeIs('admin.brands*') ? 'active' : ''); ?>">
                                    <i class="fas fa-box mr-2"></i>
                                    Catalogue
                                    <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                </button>
                                <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                    <a href="<?php echo e(route('admin.products.index')); ?>" class="dropdown-link">
                                        <i class="fas fa-shopping-bag mr-2"></i>
                                        Produits
                                    </a>
                                    <a href="<?php echo e(route('admin.categories.index')); ?>" class="dropdown-link">
                                        <i class="fas fa-tags mr-2"></i>
                                        Catégories
                                    </a>
                                    <a href="<?php echo e(route('admin.brands.index')); ?>" class="dropdown-link">
                                        <i class="fas fa-crown mr-2"></i>
                                        Marques
                                    </a>
                                </div>
                            </div>

                            <a href="<?php echo e(route('admin.orders.index')); ?>" 
                               class="admin-nav-link <?php echo e(request()->routeIs('admin.orders*') ? 'active' : ''); ?>">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Commandes
                                <?php if($pending_orders_count ?? 0 > 0): ?>
                                    <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1"><?php echo e($pending_orders_count); ?></span>
                                <?php endif; ?>
                            </a>
                            
                            <a href="<?php echo e(route('admin.users.index')); ?>" 
                               class="admin-nav-link <?php echo e(request()->routeIs('admin.users*') ? 'active' : ''); ?>">
                                <i class="fas fa-users mr-2"></i>
                                Utilisateurs
                            </a>
                        </div>
                    </div>

                    <!-- Actions utilisateur -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="p-2 text-gray-600 hover:text-noorea-gold transition-colors relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                            </button>
                        </div>

                        <!-- Retour au site -->
                        <a href="<?php echo e(route('home')); ?>" 
                           class="px-4 py-2 text-sm text-noorea-emerald border border-noorea-emerald rounded-lg hover:bg-noorea-emerald hover:text-white transition-all duration-200"
                           target="_blank">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Voir le site
                        </a>

                        <!-- Menu utilisateur -->
                        <div class="relative group">
                            <button class="flex items-center space-x-3 p-2 text-sm text-gray-700 hover:text-noorea-gold transition-colors">
                                <div class="w-8 h-8 bg-noorea-gold rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium text-sm"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                                </div>
                                <span class="font-medium"><?php echo e(Auth::user()->name); ?></span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900"><?php echo e(Auth::user()->name); ?></p>
                                    <p class="text-sm text-gray-500"><?php echo e(Auth::user()->email); ?></p>
                                </div>
                                <a href="<?php echo e(route('admin.password.change')); ?>" class="dropdown-link">
                                    <i class="fas fa-key mr-2"></i>
                                    Changer le mot de passe
                                </a>
                                <a href="<?php echo e(route('admin.settings')); ?>" class="dropdown-link">
                                    <i class="fas fa-cog mr-2"></i>
                                    Paramètres
                                </a>
                                <div class="border-t border-gray-100">
                                    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-link w-full text-left text-red-600 hover:bg-red-50">
                                            <i class="fas fa-sign-out-alt mr-2"></i>
                                            Se déconnecter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu mobile -->
                    <div class="md:hidden flex items-center">
                        <button type="button" class="mobile-menu-button p-2 text-gray-600 hover:text-noorea-gold">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menu mobile -->
            <div class="md:hidden mobile-menu hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="mobile-nav-link">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="mobile-nav-link">
                        <i class="fas fa-shopping-bag mr-3"></i>
                        Produits
                    </a>
                    <a href="<?php echo e(route('admin.categories.index')); ?>" class="mobile-nav-link">
                        <i class="fas fa-tags mr-3"></i>
                        Catégories
                    </a>
                    <a href="<?php echo e(route('admin.brands.index')); ?>" class="mobile-nav-link">
                        <i class="fas fa-crown mr-3"></i>
                        Marques
                    </a>
                    <a href="<?php echo e(route('admin.orders.index')); ?>" class="mobile-nav-link">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Commandes
                    </a>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="mobile-nav-link">
                        <i class="fas fa-users mr-3"></i>
                        Utilisateurs
                    </a>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="flex-1">
            <!-- Breadcrumb et titre -->
            <?php if(isset($breadcrumb) || isset($page_title)): ?>
            <div class="bg-white shadow-sm border-b border-gray-200">
                <div class="mx-auto px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <?php if(isset($page_title)): ?>
                                <h1 class="text-2xl font-bold text-gray-900"><?php echo e($page_title); ?></h1>
                            <?php endif; ?>
                            <?php if(isset($breadcrumb)): ?>
                                <nav class="flex mt-2" aria-label="Breadcrumb">
                                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                        <li class="inline-flex items-center">
                                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-700 hover:text-noorea-gold">
                                                <i class="fas fa-home mr-2"></i>
                                                Dashboard
                                            </a>
                                        </li>
                                        <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <div class="flex items-center">
                                                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                                    <?php if(isset($item['url'])): ?>
                                                        <a href="<?php echo e($item['url']); ?>" class="text-gray-700 hover:text-noorea-gold"><?php echo e($item['title']); ?></a>
                                                    <?php else: ?>
                                                        <span class="text-gray-500"><?php echo e($item['title']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ol>
                                </nav>
                            <?php endif; ?>
                        </div>
                        <?php echo $__env->yieldContent('page_actions'); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Messages flash -->
            <?php if(session('success')): ?>
                <div class="mx-auto px-6 pt-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800"><?php echo e(session('success')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mx-auto px-6 pt-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800"><?php echo e(session('error')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Contenu de la page -->
            <div class="mx-auto px-6 py-6">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>

    <!-- Système de notifications -->
    <?php echo $__env->make('admin.components.notifications', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Scripts -->
    <script>
        // Menu mobile
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\noorea\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>