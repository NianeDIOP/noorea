

<?php $__env->startSection('title', 'Mes Adresses - Mon Compte'); ?>

<?php $__env->startSection('account-content'); ?>
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Mes Adresses</h2>
        <button class="inline-flex items-center px-4 py-2 bg-noorea-gold text-white rounded-lg hover:bg-yellow-600">
            <i class="fas fa-plus mr-2"></i>
            Ajouter une adresse
        </button>
    </div>

    <!-- Adresse par défaut -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Adresse par défaut</h3>
        
        <div class="border-2 border-noorea-gold rounded-lg p-6 bg-yellow-50">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-noorea-gold rounded-full flex items-center justify-center">
                        <i class="fas fa-home text-white"></i>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2 mb-2">
                            <h4 class="font-semibold text-gray-900"><?php echo e(Auth::user()->name); ?></h4>
                            <span class="px-2 py-1 bg-noorea-gold text-white text-xs rounded-full">
                                Par défaut
                            </span>
                        </div>
                        <div class="text-gray-700 space-y-1">
                            <?php if(Auth::user()->address): ?>
                                <p><?php echo e(Auth::user()->address); ?></p>
                            <?php else: ?>
                                <p class="text-gray-500 italic">Adresse non renseignée</p>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->city): ?>
                                <p><?php echo e(Auth::user()->city); ?>, Sénégal</p>
                            <?php endif; ?>
                            
                            <?php if(Auth::user()->phone): ?>
                                <p class="text-sm">
                                    <i class="fas fa-phone mr-1"></i>
                                    <?php echo e(Auth::user()->phone); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-2">
                    <button class="text-noorea-gold hover:text-yellow-600">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Autres adresses -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Autres adresses</h3>
        
        <!-- État vide pour le moment -->
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-map-marker-alt text-2xl text-gray-400"></i>
            </div>
            <h4 class="text-lg font-medium text-gray-900 mb-2">Aucune adresse supplémentaire</h4>
            <p class="text-gray-600 mb-4">
                Ajoutez des adresses de livraison pour faciliter vos commandes futures.
            </p>
            <button class="inline-flex items-center px-4 py-2 bg-noorea-gold text-white rounded-lg hover:bg-yellow-600">
                <i class="fas fa-plus mr-2"></i>
                Ajouter une adresse
            </button>
        </div>
    </div>

    <!-- Types d'adresses -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-home text-blue-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900">Adresse domicile</h4>
                    <p class="text-sm text-gray-600">Votre adresse de résidence principale</p>
                </div>
            </div>
            <button class="w-full py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
                Ajouter une adresse domicile
            </button>
        </div>
        
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-building text-green-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900">Adresse bureau</h4>
                    <p class="text-sm text-gray-600">Votre adresse professionnelle</p>
                </div>
            </div>
            <button class="w-full py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
                Ajouter une adresse bureau
            </button>
        </div>
    </div>

    <!-- Conseils -->
    <div class="mt-8 bg-blue-50 rounded-lg p-6 border border-blue-200">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-lightbulb text-blue-600 text-sm"></i>
            </div>
            <div>
                <h4 class="font-semibold text-blue-900 mb-2">Conseils pour vos adresses</h4>
                <ul class="text-blue-800 text-sm space-y-1">
                    <li>• Vérifiez l'exactitude de vos coordonnées pour éviter les erreurs de livraison</li>
                    <li>• Ajoutez des points de repère pour faciliter la localisation</li>
                    <li>• Mettez à jour vos adresses si vous déménagez</li>
                    <li>• Utilisez des adresses différentes selon vos besoins (domicile, bureau, famille)</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('account.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/account/addresses.blade.php ENDPATH**/ ?>