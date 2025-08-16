

<?php $__env->startSection('title', 'Ma Liste de Souhaits - Noorea'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- En-tête -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                <i class="fas fa-heart text-noorea-gold mr-2"></i>
                Ma Liste de Souhaits
            </h1>
            <p class="text-gray-600">Retrouvez tous vos produits favoris</p>
        </div>

        <!-- Produits favoris -->
        <div class="bg-white rounded-lg shadow-md">
            <!-- Message si vide -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Votre liste est vide</h3>
                <p class="text-gray-600 mb-6">Ajoutez des produits à votre liste de souhaits pour les retrouver facilement</p>
                <a href="<?php echo e(route('products')); ?>" class="inline-flex items-center px-6 py-3 bg-noorea-gold text-white rounded-lg hover:bg-yellow-500 transition-colors">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Découvrir nos produits
                </a>
            </div>

            <!-- Liste des produits (exemple pour le design) -->
            <div class="hidden p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Exemple de produit favori -->
                    <div class="border border-gray-200 rounded-lg p-4 relative">
                        <button class="absolute top-2 right-2 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-colors">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                        
                        <div class="aspect-w-1 aspect-h-1 mb-4">
                            <img src="/images/products/sample.jpg" alt="Produit" class="w-full h-48 object-cover rounded-lg">
                        </div>
                        
                        <h3 class="font-semibold text-gray-900 mb-2">Nom du produit</h3>
                        <p class="text-sm text-gray-600 mb-3">Description courte du produit</p>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-noorea-gold">15 000 FCFA</span>
                            <button class="px-4 py-2 bg-noorea-gold text-white text-sm rounded-lg hover:bg-yellow-500 transition-colors">
                                Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 text-center">
            <div class="space-x-4">
                <a href="<?php echo e(route('products')); ?>" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Continuer mes achats
                </a>
                <a href="<?php echo e(route('cart')); ?>" class="inline-flex items-center px-6 py-3 bg-noorea-gold text-white rounded-lg hover:bg-yellow-500 transition-colors">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Voir mon panier
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/account/wishlist.blade.php ENDPATH**/ ?>