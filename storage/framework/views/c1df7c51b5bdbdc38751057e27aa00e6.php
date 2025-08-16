

<?php $__env->startSection('content'); ?>
<?php
    $page_title = 'Gestion des Catégories';
    $breadcrumb = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Catalogue', 'url' => '#'],
        ['title' => 'Catégories']
    ];
?>

<?php $__env->startSection('page_actions'); ?>
<div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
    <div class="flex items-center space-x-2">
        <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-layer-group text-noorea-gold mr-2"></i>
            <span class="font-medium text-gray-700"><?php echo e($categories->total()); ?> catégorie(s)</span>
        </div>
        <?php if(request()->hasAny(['search', 'status', 'parent'])): ?>
        <div class="flex items-center bg-blue-50 text-blue-700 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-filter mr-2"></i>
            <span class="font-medium">Filtres actifs</span>
        </div>
        <?php endif; ?>
    </div>
    <div class="flex items-center space-x-2">
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>
            Nouvelle Catégorie
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<!-- Statistiques rapides -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stats-card primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Catégories</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($categories->total()); ?></p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-layer-group"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card success">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Actives</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($categories->where('is_active', true)->count()); ?></p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card info">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Principales</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($categories->whereNull('parent_id')->count()); ?></p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-sitemap"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card warning">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Sous-catégories</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($categories->whereNotNull('parent_id')->count()); ?></p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-code-branch"></i>
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
        <?php if(request()->hasAny(['search', 'status', 'parent'])): ?>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-blue-600 bg-blue-50 px-3 py-1 rounded-lg">
                <?php echo e(collect(request()->only(['search', 'status', 'parent']))->filter()->count()); ?> filtre(s) actif(s)
            </span>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn-admin-secondary text-sm">
                <i class="fas fa-times mr-2"></i>Réinitialiser
            </a>
        </div>
        <?php endif; ?>
    </div>
    
    <form method="GET" action="<?php echo e(route('admin.categories.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                <?php if(request()->hasAny(['search', 'status', 'parent'])): ?>
                    <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn-admin-secondary px-3" title="Réinitialiser les filtres">
                        <i class="fas fa-times"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<!-- Liste des catégories -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">
            <i class="fas fa-list text-noorea-gold mr-2"></i>
            Liste des Catégories
        </h3>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-500">
                <?php echo e($categories->firstItem() ?? 0); ?>-<?php echo e($categories->lastItem() ?? 0); ?> sur <?php echo e($categories->total()); ?>

            </span>
            <?php if($categories->hasPages()): ?>
            <div class="flex items-center space-x-1 text-sm text-gray-500">
                <i class="fas fa-file-alt"></i>
                <span>Page <?php echo e($categories->currentPage()); ?> sur <?php echo e($categories->lastPage()); ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if($categories->count() > 0): ?>
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Produits</th>
                    <th>Ordre</th>
                    <th>Statut</th>
                    <th>Créée le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <!-- Image -->
                    <td>
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                            <?php if($category->image): ?>
                                <?php if(filter_var($category->image, FILTER_VALIDATE_URL)): ?>
                                    <img src="<?php echo e($category->image); ?>" alt="<?php echo e($category->name); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>" class="w-full h-full object-cover">
                                <?php endif; ?>
                            <?php else: ?>
                                <i class="fas fa-image text-gray-400"></i>
                            <?php endif; ?>
                        </div>
                    </td>

                    <!-- Nom -->
                    <td>
                        <div class="flex flex-col">
                            <span class="font-medium text-gray-900"><?php echo e($category->name); ?></span>
                            <?php if($category->description): ?>
                                <span class="text-sm text-gray-500"><?php echo e(Str::limit($category->description, 40)); ?></span>
                            <?php endif; ?>
                        </div>
                    </td>

                    <!-- Type -->
                    <td>
                        <?php if($category->parent_id): ?>
                            <div class="flex flex-col">
                                <span class="status-badge info">Sous-catégorie</span>
                                <span class="text-xs text-gray-500 mt-1"><?php echo e($category->parent->name); ?></span>
                            </div>
                        <?php else: ?>
                            <span class="status-badge primary">Principale</span>
                            <?php if($category->subcategories->count() > 0): ?>
                                <span class="text-xs text-gray-500 block mt-1"><?php echo e($category->subcategories->count()); ?> sous-cat.</span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>

                    <!-- Produits -->
                    <td>
                        <div class="flex items-center space-x-2">
                            <span class="text-lg font-semibold text-gray-900"><?php echo e($category->products_count); ?></span>
                            <?php if($category->products_count > 0): ?>
                                <a href="<?php echo e(route('admin.categories.show', $category)); ?>" class="text-noorea-gold hover:text-noorea-gold/80">
                                    <i class="fas fa-eye"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </td>

                    <!-- Ordre -->
                    <td>
                        <span class="px-2 py-1 bg-gray-100 rounded text-sm font-mono"><?php echo e($category->sort_order); ?></span>
                    </td>

                    <!-- Statut -->
                    <td class="px-6 py-4">
                        <form action="<?php echo e(route('admin.categories.toggle-status', $category)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <label class="admin-toggle" title="<?php echo e($category->is_active ? 'Désactiver' : 'Activer'); ?> cette catégorie">
                                <input type="checkbox" <?php echo e($category->is_active ? 'checked' : ''); ?> 
                                       onchange="confirmToggleStatusInline(this, '<?php echo e($category->is_active ? "désactiver" : "activer"); ?>', '<?php echo e($category->name); ?>')">
                                <span class="toggle-slider"></span>
                                <span class="status-label <?php echo e($category->is_active ? 'active' : 'inactive'); ?>">
                                    <?php echo e($category->is_active ? 'Actif' : 'Inactif'); ?>

                                </span>
                            </label>
                        </form>
                    </td>

                    <!-- Date -->
                    <td>
                        <div class="text-sm text-gray-900"><?php echo e($category->created_at->format('d/m/Y')); ?></div>
                        <div class="text-xs text-gray-500"><?php echo e($category->created_at->format('H:i')); ?></div>
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="flex items-center space-x-2">
                            <a href="<?php echo e(route('admin.categories.show', $category)); ?>" 
                               class="text-blue-600 hover:text-blue-800 transition-colors" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" 
                               class="text-noorea-gold hover:text-noorea-gold/80 transition-colors" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if($category->products_count === 0 && $category->subcategories->count() === 0): ?>
                                <button onclick="confirmDeleteCategory('<?php echo e($category->id); ?>', '<?php echo e($category->name); ?>')" 
                                        class="text-red-600 hover:text-red-800 transition-colors" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            <?php else: ?>
                                <span class="text-gray-300" title="Impossible de supprimer (contient des éléments)">
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
        <?php echo e($categories->appends(request()->query())->links()); ?>

    </div>

    <?php else: ?>
    <div class="text-center py-12">
        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
            <i class="fas fa-layer-group text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune catégorie trouvée</h3>
        <p class="text-gray-500 mb-6">
            <?php if(request()->hasAny(['search', 'status', 'parent'])): ?>
                Aucune catégorie ne correspond à vos critères de recherche.
            <?php else: ?>
                Commencez par créer votre première catégorie.
            <?php endif; ?>
        </p>
        <?php if(request()->hasAny(['search', 'status', 'parent'])): ?>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn-admin-secondary mr-3">
                <i class="fas fa-times mr-2"></i>Effacer les filtres
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>Créer une catégorie
        </a>
    </div>
    <?php endif; ?>
</div>

<!-- Pagination -->
<?php if($categories->hasPages()): ?>
<div class="mt-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <?php echo e($categories->appends(request()->query())->links()); ?>

    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function confirmDeleteCategory(categoryId, categoryName) {
    confirmDelete(function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/categories/${categoryId}`;
        
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
    }, `la catégorie "${categoryName}"`);
}

function confirmToggleStatus(button, action, categoryName) {
    confirmToggle(function() {
        button.closest('form').submit();
    }, `${action} la catégorie "${categoryName}"`);
}

function confirmToggleStatusInline(checkbox, action, categoryName) {
    // Remettre le checkbox à son état précédent temporairement
    checkbox.checked = !checkbox.checked;
    
    confirmToggle(function() {
        // Remettre le bon état et soumettre
        checkbox.checked = !checkbox.checked;
        checkbox.closest('form').submit();
    }, `${action} la catégorie "${categoryName}"`);
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>