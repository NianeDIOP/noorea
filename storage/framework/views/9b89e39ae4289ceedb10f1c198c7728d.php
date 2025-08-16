

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- En-tête -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-noorea-gold rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Bonjour, <?php echo e(Auth::user()->name); ?></h1>
                            <p class="text-gray-600">Gérez votre compte et vos commandes</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Membre depuis</p>
                            <p class="text-lg font-semibold text-noorea-gold"><?php echo e(Auth::user()->created_at->format('M Y')); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Menu latéral -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h2 class="font-semibold text-gray-900 mb-4">Mon Compte</h2>
                        <nav class="space-y-2">
                            <a href="<?php echo e(route('account.dashboard')); ?>" class="account-nav-link <?php echo e(request()->routeIs('account.dashboard') ? 'active' : ''); ?>">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Tableau de bord</span>
                            </a>
                            <a href="<?php echo e(route('account.profile')); ?>" class="account-nav-link <?php echo e(request()->routeIs('account.profile') ? 'active' : ''); ?>">
                                <i class="fas fa-user"></i>
                                <span>Mon Profil</span>
                            </a>
                            <a href="<?php echo e(route('account.orders')); ?>" class="account-nav-link <?php echo e(request()->routeIs('account.orders*') ? 'active' : ''); ?>">
                                <i class="fas fa-shopping-bag"></i>
                                <span>Mes Commandes</span>
                            </a>
                            <a href="<?php echo e(route('account.wishlist')); ?>" class="account-nav-link <?php echo e(request()->routeIs('account.wishlist') ? 'active' : ''); ?>">
                                <i class="fas fa-heart"></i>
                                <span>Ma Wishlist</span>
                            </a>
                            <a href="<?php echo e(route('account.addresses')); ?>" class="account-nav-link <?php echo e(request()->routeIs('account.addresses') ? 'active' : ''); ?>">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Mes Adresses</span>
                            </a>
                            <a href="<?php echo e(route('account.security')); ?>" class="account-nav-link <?php echo e(request()->routeIs('account.security') ? 'active' : ''); ?>">
                                <i class="fas fa-lock"></i>
                                <span>Sécurité</span>
                            </a>
                            <hr class="my-3">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="account-nav-link text-red-600 hover:text-red-700 hover:bg-red-50 w-full text-left">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>

                <!-- Contenu principal -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-lg shadow-md">
                        <?php echo $__env->yieldContent('account-content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.account-nav-link {
    @apply flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200;
}

.account-nav-link.active {
    @apply bg-noorea-gold text-white;
}

.account-nav-link:hover:not(.active) {
    @apply bg-gray-100;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/account/layouts/app.blade.php ENDPATH**/ ?>