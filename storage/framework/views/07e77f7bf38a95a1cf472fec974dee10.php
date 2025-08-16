

<?php $__env->startSection('title', 'Mes Commandes - Mon Compte'); ?>

<?php $__env->startSection('account-content'); ?>
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Mes Commandes</h2>
        <div class="flex items-center space-x-2">
            <select class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold">
                <option>Toutes les commandes</option>
                <option>En attente</option>
                <option>En cours</option>
                <option>Livrées</option>
                <option>Annulées</option>
            </select>
        </div>
    </div>

    <?php if(isset($orders) && $orders->count() > 0): ?>
        <div class="space-y-4">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border border-gray-200 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Commande #<?php echo e($order->order_number); ?>

                            </h3>
                            <p class="text-sm text-gray-600">
                                Passée le <?php echo e($order->created_at->format('d/m/Y à H:i')); ?>

                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-lg font-semibold text-gray-900">
                                <?php echo e(number_format($order->total, 0, ',', ' ')); ?> FCFA
                            </p>
                            <span class="px-3 py-1 text-sm rounded-full 
                                <?php echo e($order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                   ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                    ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                     'bg-gray-100 text-gray-800'))); ?>">
                                <?php switch($order->status):
                                    case ('pending'): ?>
                                        En attente
                                        <?php break; ?>
                                    <?php case ('processing'): ?>
                                        En cours
                                        <?php break; ?>
                                    <?php case ('shipped'): ?>
                                        Expédiée
                                        <?php break; ?>
                                    <?php case ('completed'): ?>
                                        Livrée
                                        <?php break; ?>
                                    <?php case ('cancelled'): ?>
                                        Annulée
                                        <?php break; ?>
                                    <?php default: ?>
                                        <?php echo e($order->status); ?>

                                <?php endswitch; ?>
                            </span>
                        </div>
                        <a href="<?php echo e(route('account.orders.show', $order->id)); ?>" 
                           class="text-noorea-gold hover:text-yellow-600">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Aperçu des articles -->
                <div class="border-t border-gray-200 pt-4">
                    <div class="flex items-center space-x-4">
                        <?php if($order->items): ?>
                            <?php $__currentLoopData = $order->items->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center space-x-2">
                                <img src="<?php echo e($item->product->main_image_url ?? asset('images/logo.png')); ?>" 
                                     alt="<?php echo e($item->product->name); ?>"
                                     class="w-12 h-12 object-cover rounded">
                                <div>
                                    <p class="text-sm font-medium text-gray-900"><?php echo e($item->product->name); ?></p>
                                    <p class="text-xs text-gray-600">Qté: <?php echo e($item->quantity); ?></p>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php if($order->items->count() > 3): ?>
                            <div class="text-sm text-gray-500">
                                +<?php echo e($order->items->count() - 3); ?> autres articles
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
                    <div class="flex items-center space-x-4">
                        <?php if($order->status === 'completed'): ?>
                        <button class="text-noorea-gold hover:text-yellow-600 text-sm">
                            <i class="fas fa-redo mr-1"></i>
                            Recommander
                        </button>
                        <?php endif; ?>
                        
                        <?php if($order->status === 'shipped'): ?>
                        <button class="text-blue-600 hover:text-blue-700 text-sm">
                            <i class="fas fa-truck mr-1"></i>
                            Suivre la livraison
                        </button>
                        <?php endif; ?>
                    </div>
                    
                    <a href="<?php echo e(route('account.orders.show', $order->id)); ?>" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Voir les détails
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Pagination -->
        <?php if($orders->hasPages()): ?>
        <div class="mt-6">
            <?php echo e($orders->links()); ?>

        </div>
        <?php endif; ?>
    <?php else: ?>
        <!-- État vide -->
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-shopping-bag text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune commande</h3>
            <p class="text-gray-600 mb-6">Vous n'avez pas encore passé de commande.</p>
            <a href="<?php echo e(route('products')); ?>" 
               class="inline-flex items-center px-6 py-3 bg-noorea-gold text-white rounded-lg hover:bg-yellow-600">
                <i class="fas fa-shopping-bag mr-2"></i>
                Commencer mes achats
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('account.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/account/orders.blade.php ENDPATH**/ ?>