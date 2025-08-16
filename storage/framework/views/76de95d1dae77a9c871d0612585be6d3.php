

<?php $__env->startSection('content'); ?>
<?php
    $page_title = 'Mon Dashboard';
    $breadcrumb = [];
?>

<!-- Grid des statistiques principales -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Commandes -->
    <div class="stats-card primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Commandes</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($stats['total_orders'] ?? 0); ?></p>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="text-green-600"><?php echo e($stats['completed_orders'] ?? 0); ?> terminées</span>
                </p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
        </div>
    </div>

    <!-- Montant dépensé -->
    <div class="stats-card success">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Dépensé</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e(number_format($stats['total_spent'] ?? 0, 0, ',', ' ')); ?></p>
                <p class="text-sm text-gray-600 mt-1">FCFA</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>

    <!-- Articles favoris -->
    <div class="stats-card info">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Ma Wishlist</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($stats['wishlist_items'] ?? 0); ?></p>
                <p class="text-sm text-gray-600 mt-1">articles sauvegardés</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-heart"></i>
            </div>
        </div>
    </div>

    <!-- Points fidélité -->
    <div class="stats-card warning">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Points Fidélité</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($stats['loyalty_points'] ?? 850); ?></p>
                <p class="text-sm text-gray-600 mt-1">points disponibles</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>
</div>

<!-- Grid principal -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Commandes récentes -->
    <div class="lg:col-span-2">
        <div class="client-card">
            <div class="client-card-header">
                <h3 class="client-card-title">
                    <i class="fas fa-clock text-noorea-gold mr-2"></i>
                    Mes Commandes Récentes
                </h3>
                <a href="<?php echo e(route('account.orders')); ?>" class="btn-client-secondary text-xs px-3 py-1">
                    <i class="fas fa-list mr-2"></i>
                    Voir tout
                </a>
            </div>
            
            <?php if(isset($recent_orders) && $recent_orders->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $recent_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-noorea-gold rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shopping-bag text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Commande #<?php echo e($order->id); ?></h4>
                                    <p class="text-sm text-gray-600"><?php echo e($order->created_at->format('d/m/Y à H:i')); ?></p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-gray-900"><?php echo e(number_format($order->total, 0, ',', ' ')); ?> FCFA</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    <?php if($order->status === 'completed'): ?> bg-green-100 text-green-800
                                    <?php elseif($order->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                    <?php elseif($order->status === 'processing'): ?> bg-blue-100 text-blue-800
                                    <?php else: ?> bg-gray-100 text-gray-800
                                    <?php endif; ?>">
                                    <?php switch($order->status):
                                        case ('completed'): ?> Terminée <?php break; ?>
                                        <?php case ('pending'): ?> En attente <?php break; ?>
                                        <?php case ('processing'): ?> En traitement <?php break; ?>
                                        <?php default: ?> <?php echo e($order->status); ?>

                                    <?php endswitch; ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-shopping-bag text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune commande</h3>
                    <p class="text-gray-600 mb-4">Vous n'avez encore passé aucune commande.</p>
                    <a href="<?php echo e(route('products')); ?>" class="btn-client-primary">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Découvrir nos produits
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Actions rapides -->
    <div>
        <div class="client-card">
            <div class="client-card-header">
                <h3 class="client-card-title">
                    <i class="fas fa-bolt text-noorea-emerald mr-2"></i>
                    Actions Rapides
                </h3>
            </div>
            
            <div class="space-y-4">
                <a href="<?php echo e(route('account.profile')); ?>" class="group block">
                    <div class="flex items-center p-3 rounded-lg border border-gray-200 group-hover:border-noorea-gold group-hover:bg-gray-50 transition-all">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user-edit text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900">Modifier mon profil</h4>
                            <p class="text-sm text-gray-600">Informations personnelles</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-noorea-gold"></i>
                    </div>
                </a>

                <a href="<?php echo e(route('account.addresses')); ?>" class="group block">
                    <div class="flex items-center p-3 rounded-lg border border-gray-200 group-hover:border-noorea-gold group-hover:bg-gray-50 transition-all">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-map-marker-alt text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900">Mes adresses</h4>
                            <p class="text-sm text-gray-600">Gérer les adresses de livraison</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-noorea-gold"></i>
                    </div>
                </a>

                <a href="<?php echo e(route('account.wishlist')); ?>" class="group block">
                    <div class="flex items-center p-3 rounded-lg border border-gray-200 group-hover:border-noorea-gold group-hover:bg-gray-50 transition-all">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-heart text-red-600"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900">Ma wishlist</h4>
                            <p class="text-sm text-gray-600">Produits favoris</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-noorea-gold"></i>
                    </div>
                </a>

                <a href="<?php echo e(route('account.security')); ?>" class="group block">
                    <div class="flex items-center p-3 rounded-lg border border-gray-200 group-hover:border-noorea-gold group-hover:bg-gray-50 transition-all">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-shield-alt text-yellow-600"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900">Sécurité</h4>
                            <p class="text-sm text-gray-600">Mot de passe et sécurité</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-noorea-gold"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Infos du compte -->
        <div class="client-card mt-6">
            <div class="client-card-header">
                <h3 class="client-card-title">
                    <i class="fas fa-user-circle text-noorea-gold mr-2"></i>
                    Mon Compte
                </h3>
            </div>
            
            <div class="text-center mb-4">
                <div class="w-16 h-16 mx-auto bg-noorea-gold rounded-full flex items-center justify-center mb-3">
                    <span class="text-white font-semibold text-xl"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                </div>
                <h3 class="font-semibold text-gray-900"><?php echo e(Auth::user()->name); ?></h3>
                <p class="text-sm text-gray-600"><?php echo e(Auth::user()->email); ?></p>
            </div>
            
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Membre depuis:</span>
                    <span class="font-medium"><?php echo e(Auth::user()->created_at->format('M Y')); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Ville:</span>
                    <span class="font-medium"><?php echo e(Auth::user()->city ?? 'Non renseignée'); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Téléphone:</span>
                    <span class="font-medium"><?php echo e(Auth::user()->phone ?? 'Non renseigné'); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section promotions -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="client-card bg-gradient-to-r from-noorea-gold to-yellow-400 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold mb-2">Nouvelle Collection</h3>
                <p class="mb-4 opacity-90">Découvrez nos derniers produits de beauté africaine</p>
                <a href="<?php echo e(route('products')); ?>" class="bg-white text-noorea-gold px-4 py-2 rounded-lg font-medium hover:bg-opacity-90 transition-all inline-flex items-center">
                    Découvrir <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-shopping-bag text-3xl"></i>
            </div>
        </div>
    </div>
    
    <div class="client-card bg-gradient-to-r from-green-500 to-green-600 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold mb-2">Livraison Gratuite</h3>
                <p class="mb-4 opacity-90">Pour toute commande supérieure à 50 000 FCFA</p>
                <a href="<?php echo e(route('products')); ?>" class="bg-white text-green-600 px-4 py-2 rounded-lg font-medium hover:bg-opacity-90 transition-all inline-flex items-center">
                    Profiter <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-truck text-3xl"></i>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('account.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/account/dashboard.blade.php ENDPATH**/ ?>