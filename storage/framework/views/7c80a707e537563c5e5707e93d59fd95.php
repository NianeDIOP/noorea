

<?php $__env->startSection('content'); ?>
<?php
    $page_title = $brand->name;
    $breadcrumb = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Marques', 'url' => route('admin.brands.index')],
        ['title' => $brand->name]
    ];
?>

<?php $__env->startSection('page_actions'); ?>
<div class="flex items-center space-x-3">
    <a href="<?php echo e(route('admin.brands.edit', $brand)); ?>" class="btn-admin-primary">
        <i class="fas fa-edit mr-2"></i>
        Modifier
    </a>
    <a href="<?php echo e(route('admin.brands.index')); ?>" class="btn-admin-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>
<?php $__env->stopSection(); ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Contenu principal -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Informations générales -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-info-circle text-noorea-gold mr-2"></i>
                    Informations générales
                </h3>
            </div>

            <div class="flex items-start space-x-6">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <?php if($brand->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $brand->logo)); ?>" 
                             alt="Logo <?php echo e($brand->name); ?>" 
                             class="h-24 w-24 object-contain bg-gray-50 rounded-lg border shadow-sm">
                    <?php else: ?>
                        <div class="h-24 w-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center border">
                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Détails -->
                <div class="flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nom de la marque</label>
                            <p class="text-lg font-semibold text-gray-900"><?php echo e($brand->name); ?></p>
                        </div>

                        <?php if($brand->country): ?>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Pays d'origine</label>
                            <p class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-globe text-gray-400 mr-2"></i>
                                <?php echo e($brand->country); ?>

                            </p>
                        </div>
                        <?php endif; ?>

                        <?php if($brand->website): ?>
                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-500">Site web</label>
                            <p class="text-lg font-semibold">
                                <a href="<?php echo e($brand->website); ?>" target="_blank" 
                                   class="text-noorea-gold hover:text-noorea-emerald flex items-center">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    <?php echo e($brand->website); ?>

                                </a>
                            </p>
                        </div>
                        <?php endif; ?>

                        <?php if($brand->description): ?>
                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-500">Description</label>
                            <p class="text-gray-700 mt-1"><?php echo e($brand->description); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO -->
        <?php if($brand->meta_title || $brand->meta_description): ?>
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-search text-noorea-gold mr-2"></i>
                    Optimisation SEO
                </h3>
            </div>

            <div class="space-y-4">
                <?php if($brand->meta_title): ?>
                <div>
                    <label class="text-sm font-medium text-gray-500">Meta Title</label>
                    <p class="text-gray-900"><?php echo e($brand->meta_title); ?></p>
                </div>
                <?php endif; ?>

                <?php if($brand->meta_description): ?>
                <div>
                    <label class="text-sm font-medium text-gray-500">Meta Description</label>
                    <p class="text-gray-700"><?php echo e($brand->meta_description); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Produits de la marque -->
        <?php if($brand->products && $brand->products->count() > 0): ?>
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-boxes text-noorea-gold mr-2"></i>
                    Produits de cette marque (<?php echo e($brand->products->count()); ?>)
                </h3>
            </div>

            <div class="overflow-hidden">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $brand->products->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="flex items-center space-x-3">
                                    <?php if($product->main_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->main_image)); ?>" 
                                             alt="<?php echo e($product->name); ?>" 
                                             class="h-10 w-10 object-cover rounded">
                                    <?php else: ?>
                                        <div class="h-10 w-10 bg-gray-200 rounded flex items-center justify-center">
                                            <i class="fas fa-box text-gray-400"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="font-medium text-gray-900"><?php echo e($product->name); ?></p>
                                        <p class="text-sm text-gray-500"><?php echo e($product->sku ?? 'N/A'); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-sm text-gray-600"><?php echo e($product->category->name ?? 'N/A'); ?></span>
                            </td>
                            <td>
                                <span class="font-medium text-gray-900"><?php echo e(number_format($product->price, 2)); ?> MAD</span>
                            </td>
                            <td>
                                <span class="status-badge <?php echo e($product->is_active ? 'active' : 'inactive'); ?>">
                                    <?php echo e($product->is_active ? 'Actif' : 'Inactif'); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.products.show', $product)); ?>" 
                                   class="text-noorea-gold hover:text-noorea-emerald">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <?php if($brand->products->count() > 10): ?>
                <div class="mt-4 text-center">
                    <a href="<?php echo e(route('admin.products.index', ['brand' => $brand->id])); ?>" 
                       class="btn-admin-secondary">
                        <i class="fas fa-eye mr-2"></i>
                        Voir tous les produits
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php else: ?>
        <!-- Message si aucun produit -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-boxes text-noorea-gold mr-2"></i>
                    Produits de cette marque
                </h3>
            </div>

            <div class="text-center py-12">
                <div class="max-w-md mx-auto">
                    <div class="h-24 w-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-boxes text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun produit</h3>
                    <p class="text-gray-500 mb-6">Cette marque n'a pas encore de produits associés.</p>
                    <a href="<?php echo e(route('admin.products.create', ['brand' => $brand->id])); ?>" 
                       class="btn-admin-primary">
                        <i class="fas fa-plus mr-2"></i>Ajouter un produit
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Statut -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-toggle-on text-noorea-gold mr-2"></i>
                    Statut
                </h3>
            </div>

            <div class="space-y-4">
                <!-- Statut actif -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="font-medium text-gray-900">Visibilité</span>
                    <span class="status-badge <?php echo e($brand->is_active ? 'active' : 'inactive'); ?>">
                        <?php echo e($brand->is_active ? 'Active' : 'Inactive'); ?>

                    </span>
                </div>

                <!-- Statut vedette -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="font-medium text-gray-900">Vedette</span>
                    <span class="status-badge <?php echo e($brand->is_featured ? 'active' : 'inactive'); ?>">
                        <?php echo e($brand->is_featured ? 'Oui' : 'Non'); ?>

                    </span>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-chart-bar text-noorea-gold mr-2"></i>
                    Statistiques
                </h3>
            </div>

            <div class="space-y-4">
                <!-- Nombre de produits -->
                <div class="stats-card primary">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="stats-label">Produits</p>
                            <p class="stats-value"><?php echo e($brand->products_count ?? ($brand->products ? $brand->products->count() : 0)); ?></p>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>

                <!-- Produits actifs -->
                <?php if($brand->products): ?>
                <div class="stats-card success">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="stats-label">Produits actifs</p>
                            <p class="stats-value"><?php echo e($brand->products->where('is_active', true)->count()); ?></p>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Informations système -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-info text-blue-500 mr-2"></i>
                    Informations système
                </h3>
            </div>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Créée le :</span>
                    <span class="font-medium"><?php echo e($brand->created_at->format('d/m/Y à H:i')); ?></span>
                </div>
                <?php if($brand->updated_at != $brand->created_at): ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Modifiée le :</span>
                    <span class="font-medium"><?php echo e($brand->updated_at->format('d/m/Y à H:i')); ?></span>
                </div>
                <?php endif; ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">ID :</span>
                    <span class="font-medium">#<?php echo e($brand->id); ?></span>
                </div>
                <?php if($brand->slug): ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Slug :</span>
                    <span class="font-medium"><?php echo e($brand->slug); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-bolt text-noorea-gold mr-2"></i>
                    Actions rapides
                </h3>
            </div>

            <div class="space-y-3">
                <a href="<?php echo e(route('admin.brands.edit', $brand)); ?>" class="btn-admin-primary w-full">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier cette marque
                </a>
                
                <a href="<?php echo e(route('admin.products.create', ['brand' => $brand->id])); ?>" class="btn-admin-secondary w-full">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter un produit
                </a>

                <form action="<?php echo e(route('admin.brands.destroy', $brand)); ?>" 
                      method="POST" 
                      onsubmit="return confirmDelete()"
                      class="w-full">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-admin-danger w-full">
                        <i class="fas fa-trash mr-2"></i>
                        Supprimer la marque
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function confirmDelete() {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cette marque ? Cette action est irréversible.')) {
        return false;
    }
    
    <?php if($brand->products && $brand->products->count() > 0): ?>
    if (!confirm('Cette marque contient <?php echo e($brand->products->count()); ?> produit(s). Voulez-vous vraiment continuer ?')) {
        return false;
    }
    <?php endif; ?>
    
    return true;
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/admin/brands/show.blade.php ENDPATH**/ ?>