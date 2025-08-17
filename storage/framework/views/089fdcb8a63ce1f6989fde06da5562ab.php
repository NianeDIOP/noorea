

<?php $__env->startSection('content'); ?>
<?php
    $page_title = 'Gestion des Marques';
    $breadcrumb = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Marques']
    ];
?>

<?php $__env->startSection('page_actions'); ?>
<div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
    <div class="flex items-center space-x-2">
        <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-tags text-noorea-gold mr-2"></i>
            <span class="font-medium text-gray-700"><?php echo e($brands->total()); ?> marque(s)</span>
        </div>
        <?php if(request()->hasAny(['search', 'status', 'featured', 'country'])): ?>
        <div class="flex items-center bg-blue-50 text-blue-700 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-filter mr-2"></i>
            <span class="font-medium">Filtres actifs</span>
        </div>
        <?php endif; ?>
    </div>
    <div class="flex items-center space-x-2">
        <a href="<?php echo e(route('admin.brands.create')); ?>" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>
            Nouvelle Marque
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<!-- Statistiques rapides -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stats-card primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Marques</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($brands->total()); ?></p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-tags"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card success">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Actives</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($brands->where('is_active', true)->count()); ?></p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card warning">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Vedettes</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($brands->where('is_featured', true)->count()); ?></p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card info">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Avec Produits</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($brands->where('products_count', '>', 0)->count()); ?></p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filtres et recherche -->
<div class="admin-card mb-6">
    <div class="admin-card-header">
        <h3 class="admin-card-title">
            <i class="fas fa-filter text-noorea-gold mr-2"></i>
            Filtres et Recherche
        </h3>
        <?php if(request()->hasAny(['search', 'status', 'featured', 'country'])): ?>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-blue-600 bg-blue-50 px-3 py-1 rounded-lg">
                <?php echo e(collect(request()->only(['search', 'status', 'featured', 'country']))->filter()->count()); ?> filtre(s) actif(s)
            </span>
            <a href="<?php echo e(route('admin.brands.index')); ?>" class="btn-admin-secondary text-sm">
                <i class="fas fa-times mr-2"></i>Réinitialiser
            </a>
        </div>
        <?php endif; ?>
    </div>
    
    <form method="GET" action="<?php echo e(route('admin.brands.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Recherche -->
        <div class="admin-form-group">
            <label class="admin-form-label">
                <i class="fas fa-search mr-1 text-gray-400"></i>
                Recherche
            </label>
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="<?php echo e(request('search')); ?>" 
                       placeholder="Nom, description..."
                       class="admin-form-input pl-10">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- Statut -->
        <div class="admin-form-group">
            <label class="admin-form-label">
                <i class="fas fa-toggle-on mr-1 text-gray-400"></i>
                Statut
            </label>
            <select name="status" class="admin-form-select">
                <option value="">Tous</option>
                <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Actives</option>
                <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>Inactives</option>
            </select>
        </div>

        <!-- Actions -->
        <div class="admin-form-group flex items-end">
            <div class="flex space-x-2 w-full">
                <button type="submit" class="btn-admin-primary flex-1">
                    <i class="fas fa-search mr-2"></i>Rechercher
                </button>
                <?php if(request()->hasAny(['search', 'status', 'featured', 'country'])): ?>
                    <a href="<?php echo e(route('admin.brands.index')); ?>" class="btn-admin-secondary px-3" title="Réinitialiser les filtres">
                        <i class="fas fa-times"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<!-- Liste des marques -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">
            <i class="fas fa-list text-noorea-gold mr-2"></i>
            Liste des Marques
        </h3>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-500">
                <?php echo e($brands->firstItem() ?? 0); ?>-<?php echo e($brands->lastItem() ?? 0); ?> sur <?php echo e($brands->total()); ?>

            </span>
            <?php if($brands->hasPages()): ?>
            <div class="flex items-center space-x-1 text-sm text-gray-500">
                <i class="fas fa-file-alt"></i>
                <span>Page <?php echo e($brands->currentPage()); ?> sur <?php echo e($brands->lastPage()); ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if($brands->count() > 0): ?>
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nom</th>
                    <th>Pays</th>
                    <th>Produits</th>
                    <th>Vedette</th>
                    <th>Statut</th>
                    <th>Créée le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <!-- Logo -->
                    <td>
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center border">
                            <?php if($brand->logo): ?>
                                <img src="<?php echo e($brand->logo_url); ?>" 
                                     alt="<?php echo e($brand->name); ?>" 
                                     class="w-full h-full object-contain"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full flex items-center justify-center" style="display: none;">
                                    <i class="fas fa-tags text-gray-400"></i>
                                </div>
                            <?php else: ?>
                                <i class="fas fa-tags text-gray-400"></i>
                            <?php endif; ?>
                        </div>
                    </td>

                    <!-- Nom -->
                    <td>
                        <div class="flex flex-col">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-gray-900"><?php echo e($brand->name); ?></span>
                                <?php if($brand->is_local): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-home mr-1"></i>Local
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if($brand->description): ?>
                                <span class="text-sm text-gray-500"><?php echo e(Str::limit($brand->description, 40)); ?></span>
                            <?php endif; ?>
                            <?php if($brand->website): ?>
                                <a href="<?php echo e($brand->website); ?>" target="_blank" class="text-xs text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-external-link-alt mr-1"></i><?php echo e(parse_url($brand->website, PHP_URL_HOST)); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </td>

                    <!-- Pays -->
                    <td>
                        <?php if($brand->country): ?>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-globe mr-1"></i><?php echo e($brand->country); ?>

                            </span>
                        <?php else: ?>
                            <span class="text-gray-400">-</span>
                        <?php endif; ?>
                    </td>

                    <!-- Produits -->
                    <td>
                        <div class="flex items-center space-x-2">
                            <span class="text-lg font-semibold text-gray-900"><?php echo e($brand->products_count); ?></span>
                            <?php if($brand->products_count > 0): ?>
                                <a href="<?php echo e(route('admin.brands.show', $brand)); ?>" class="text-noorea-gold hover:text-noorea-gold/80">
                                    <i class="fas fa-eye"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </td>

                    <!-- Vedette -->
                    <td>
                        <form action="<?php echo e(route('admin.brands.toggle-featured', $brand)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" 
                                    class="p-2 rounded-full transition-colors <?php echo e($brand->is_featured ? 'text-noorea-gold hover:text-yellow-600' : 'text-gray-400 hover:text-noorea-gold'); ?>"
                                    title="<?php echo e($brand->is_featured ? 'Retirer des vedettes' : 'Marquer comme vedette'); ?>">
                                <i class="fas fa-star"></i>
                            </button>
                        </form>
                    </td>

                    <!-- Statut -->
                    <td class="px-6 py-4">
                        <form action="<?php echo e(route('admin.brands.toggle-status', $brand)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <label class="admin-toggle" title="<?php echo e($brand->is_active ? 'Désactiver' : 'Activer'); ?> cette marque">
                                <input type="checkbox" <?php echo e($brand->is_active ? 'checked' : ''); ?> 
                                       onchange="confirmToggleStatusInline(this, '<?php echo e($brand->is_active ? "désactiver" : "activer"); ?>', '<?php echo e($brand->name); ?>')">
                                <span class="toggle-slider"></span>
                                <span class="status-label <?php echo e($brand->is_active ? 'active' : 'inactive'); ?>">
                                    <?php echo e($brand->is_active ? 'Actif' : 'Inactif'); ?>

                                </span>
                            </label>
                        </form>
                    </td>

                    <!-- Date -->
                    <td>
                        <div class="text-sm text-gray-900"><?php echo e($brand->created_at->format('d/m/Y')); ?></div>
                        <div class="text-xs text-gray-500"><?php echo e($brand->created_at->format('H:i')); ?></div>
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="flex items-center space-x-2">
                            <a href="<?php echo e(route('admin.brands.show', $brand)); ?>" 
                               class="text-blue-600 hover:text-blue-800 transition-colors" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo e(route('admin.brands.edit', $brand)); ?>" 
                               class="text-noorea-gold hover:text-noorea-gold/80 transition-colors" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if($brand->products_count === 0): ?>
                                <button onclick="confirmDeleteBrand('<?php echo e($brand->id); ?>', '<?php echo e($brand->name); ?>')" 
                                        class="text-red-600 hover:text-red-800 transition-colors" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            <?php else: ?>
                                <span class="text-gray-300" title="Impossible de supprimer (contient <?php echo e($brand->products_count); ?> produit(s))">
                                    <i class="fas fa-lock"></i>
                                </span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        <?php echo e($brands->appends(request()->query())->links()); ?>

    </div>
    <?php else: ?>
    <div class="text-center py-12">
        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
            <i class="fas fa-tags text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune marque trouvée</h3>
        <p class="text-gray-500 mb-6">
            <?php if(request()->hasAny(['search', 'status', 'featured', 'country'])): ?>
                Aucune marque ne correspond à vos critères de recherche.
            <?php else: ?>
                Commencez par créer votre première marque.
            <?php endif; ?>
        </p>
        <?php if(request()->hasAny(['search', 'status', 'featured', 'country'])): ?>
            <a href="<?php echo e(route('admin.brands.index')); ?>" class="btn-admin-secondary mr-3">
                <i class="fas fa-times mr-2"></i>Effacer les filtres
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('admin.brands.create')); ?>" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>Créer une marque
        </a>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function confirmDeleteBrand(brandId, brandName) {
    confirmDelete(function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/brands/${brandId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '<?php echo e(csrf_token()); ?>';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }, `la marque "${brandName}"`);
}

function confirmToggleStatus(button, action, brandName) {
    confirmToggle(function() {
        button.closest('form').submit();
    }, `${action} la marque "${brandName}"`);
}

function confirmToggleStatusInline(checkbox, action, brandName) {
    // Remettre le checkbox à son état précédent temporairement
    checkbox.checked = !checkbox.checked;
    
    confirmToggle(function() {
        // Remettre le bon état et soumettre
        checkbox.checked = !checkbox.checked;
        checkbox.closest('form').submit();
    }, `${action} la marque "${brandName}"`);
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/admin/brands/index.blade.php ENDPATH**/ ?>