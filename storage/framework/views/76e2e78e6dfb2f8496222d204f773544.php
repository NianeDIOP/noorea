

<?php $__env->startSection('title', 'Gestion des commandes'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header avec actions -->
    <div class="admin-card">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="h-8 w-1 bg-noorea-gold rounded-full"></div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Gestion des commandes</h1>
                    <p class="text-gray-600 mt-1">Gérez les commandes WhatsApp et les paiements manuels</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Bouton d'action principal -->
                <a href="<?php echo e(route('admin.orders.create')); ?>" class="btn-admin-primary">
                    <i class="fas fa-plus mr-2"></i>Commande manuelle
                </a>
                
                <!-- Actions utilitaires -->
                <div class="flex items-center space-x-2">
                    <button onclick="window.print()" class="btn-admin-secondary">
                        <i class="fas fa-print"></i>
                    </button>
                    <button onclick="location.reload()" class="btn-admin-outline">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Barre de filtres rapides -->
        <div class="mt-4 pt-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="text-sm font-medium text-gray-700">Filtres rapides :</span>
                    <div class="flex items-center space-x-2">
                        <a href="<?php echo e(route('admin.orders.index', ['status' => 'pending'])); ?>" 
                           class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition-colors text-sm font-medium">
                            <i class="fas fa-clock mr-2"></i>En attente
                            <span class="ml-1 bg-yellow-200 text-yellow-900 px-1.5 py-0.5 rounded-full text-xs"><?php echo e($stats['pending_orders']); ?></span>
                        </a>
                        <a href="<?php echo e(route('admin.orders.index', ['status' => 'confirmed'])); ?>" 
                           class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors text-sm font-medium">
                            <i class="fas fa-check-circle mr-2"></i>À traiter
                            <span class="ml-1 bg-green-200 text-green-900 px-1.5 py-0.5 rounded-full text-xs"><?php echo e($stats['confirmed_orders']); ?></span>
                        </a>
                        <a href="<?php echo e(route('admin.orders.index', ['status' => 'processing'])); ?>" 
                           class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition-colors text-sm font-medium">
                            <i class="fas fa-cog mr-2"></i>En cours
                            <span class="ml-1 bg-blue-200 text-blue-900 px-1.5 py-0.5 rounded-full text-xs"><?php echo e($stats['processing_orders']); ?></span>
                        </a>
                        <a href="<?php echo e(route('admin.orders.index', ['status' => 'delivered'])); ?>" 
                           class="inline-flex items-center px-3 py-1.5 bg-emerald-100 text-emerald-800 rounded-lg hover:bg-emerald-200 transition-colors text-sm font-medium">
                            <i class="fas fa-truck mr-2"></i>Livrées
                            <span class="ml-1 bg-emerald-200 text-emerald-900 px-1.5 py-0.5 rounded-full text-xs"><?php echo e($stats['delivered_orders']); ?></span>
                        </a>
                    </div>
                </div>
                
                <!-- Filtre par paiement -->
                <div class="flex items-center space-x-2 text-sm">
                    <span class="text-gray-600">Paiement :</span>
                    <select onchange="filterByPayment(this.value)" class="form-select text-sm border-gray-300 rounded-lg">
                        <option value="">Tous</option>
                        <option value="pending">En attente</option>
                        <option value="partial">Partiel</option>
                        <option value="paid">Payé</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques améliorées -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="admin-card hover:shadow-lg transition-shadow cursor-pointer" 
             onclick="location.href='<?php echo e(route('admin.orders.index')); ?>'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total commandes</p>
                    <p class="text-2xl font-bold text-gray-900"><?php echo e($stats['total_orders']); ?></p>
                    <p class="text-xs text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>Ce mois
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="admin-card hover:shadow-lg transition-shadow cursor-pointer" 
             onclick="location.href='<?php echo e(route('admin.orders.index', ['status' => 'pending'])); ?>'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">En attente</p>
                    <p class="text-2xl font-bold text-yellow-600"><?php echo e($stats['pending_orders']); ?></p>
                    <p class="text-xs text-yellow-600 mt-1">
                        <i class="fas fa-exclamation-triangle mr-1"></i>Action requise
                    </p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="admin-card hover:shadow-lg transition-shadow cursor-pointer" 
             onclick="location.href='<?php echo e(route('admin.orders.index', ['status' => 'confirmed'])); ?>'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Confirmées</p>
                    <p class="text-2xl font-bold text-green-600"><?php echo e($stats['confirmed_orders']); ?></p>
                    <p class="text-xs text-green-600 mt-1">
                        <i class="fas fa-check-circle mr-1"></i>À traiter
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="admin-card hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Chiffre d'affaires</p>
                    <p class="text-2xl font-bold text-noorea-gold"><?php echo e(number_format($stats['total_revenue'], 0, ',', ' ')); ?></p>
                    <p class="text-xs text-noorea-gold mt-1">
                        <i class="fas fa-coins mr-1"></i>FCFA
                    </p>
                </div>
                <div class="w-12 h-12 bg-noorea-gold/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-coins text-noorea-gold text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <form method="GET" class="admin-card mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            <!-- Recherche -->
            <div class="admin-form-group">
                <label class="admin-form-label">
                    <i class="fas fa-search mr-1 text-gray-400"></i>
                    Rechercher
                </label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                       class="admin-form-input"
                       placeholder="N° commande, client, email, téléphone...">
            </div>

            <!-- Statut -->
            <div class="admin-form-group">
                <label class="admin-form-label">
                    <i class="fas fa-flag mr-1 text-gray-400"></i>
                    Statut
                </label>
                <select name="status" class="admin-form-select">
                    <option value="">Tous les statuts</option>
                    <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>En attente</option>
                    <option value="confirmed" <?php echo e(request('status') === 'confirmed' ? 'selected' : ''); ?>>Confirmée</option>
                    <option value="processing" <?php echo e(request('status') === 'processing' ? 'selected' : ''); ?>>En traitement</option>
                    <option value="shipped" <?php echo e(request('status') === 'shipped' ? 'selected' : ''); ?>>Expédiée</option>
                    <option value="delivered" <?php echo e(request('status') === 'delivered' ? 'selected' : ''); ?>>Livrée</option>
                    <option value="cancelled" <?php echo e(request('status') === 'cancelled' ? 'selected' : ''); ?>>Annulée</option>
                </select>
            </div>

            <!-- Statut de paiement -->
            <div class="admin-form-group">
                <label class="admin-form-label">
                    <i class="fas fa-credit-card mr-1 text-gray-400"></i>
                    Paiement
                </label>
                <select name="payment_status" class="admin-form-select">
                    <option value="">Tous</option>
                    <option value="pending" <?php echo e(request('payment_status') === 'pending' ? 'selected' : ''); ?>>En attente</option>
                    <option value="partial" <?php echo e(request('payment_status') === 'partial' ? 'selected' : ''); ?>>Partiel</option>
                    <option value="paid" <?php echo e(request('payment_status') === 'paid' ? 'selected' : ''); ?>>Payé</option>
                    <option value="refunded" <?php echo e(request('payment_status') === 'refunded' ? 'selected' : ''); ?>>Remboursé</option>
                </select>
            </div>

            <!-- Date début -->
            <div class="admin-form-group">
                <label class="admin-form-label">
                    <i class="fas fa-calendar mr-1 text-gray-400"></i>
                    Du
                </label>
                <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="admin-form-input">
            </div>

            <!-- Date fin -->
            <div class="admin-form-group">
                <label class="admin-form-label">
                    <i class="fas fa-calendar mr-1 text-gray-400"></i>
                    Au
                </label>
                <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="admin-form-input">
            </div>

            <!-- Actions -->
            <div class="admin-form-group flex items-end">
                <div class="flex space-x-2 w-full">
                    <button type="submit" class="btn-admin-primary flex-1">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                    <?php if(request()->hasAny(['search', 'status', 'payment_status', 'date_from', 'date_to'])): ?>
                        <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn-admin-secondary px-3" title="Réinitialiser">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>

    <!-- Liste des commandes -->
    <div class="admin-card">
        <?php if($orders->count() > 0): ?>
            <!-- En-tête du tableau avec actions -->
            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <?php echo e($orders->total()); ?> commande(s)
                    </h3>
                    <?php if(request()->hasAny(['search', 'status', 'payment_status', 'date_from', 'date_to'])): ?>
                        <span class="text-sm text-gray-500">
                            (<?php echo e($orders->count()); ?> affichée(s))
                        </span>
                    <?php endif; ?>
                </div>
                <div class="flex items-center space-x-2">
                    <!-- Actions en lot -->
                    <div class="flex items-center space-x-2 text-sm">
                        <span class="text-gray-500">Actions :</span>
                        <button onclick="exportData()" class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition-colors">
                            <i class="fas fa-download mr-1"></i>Exporter
                        </button>
                        <button onclick="markAsRead()" class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition-colors">
                            <i class="fas fa-eye mr-1"></i>Marquer vues
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th class="w-4">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-noorea-gold" onclick="toggleAll(this)">
                            </th>
                            <th>N° Commande</th>
                            <th>Client</th>
                            <th>Contact</th>
                            <th>Articles</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Paiement</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50 transition-colors <?php echo e($order->status === 'pending' ? 'border-l-4 border-yellow-400' : ($order->status === 'confirmed' ? 'border-l-4 border-green-400' : '')); ?>">
                            <!-- Checkbox -->
                            <td>
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-noorea-gold order-checkbox" value="<?php echo e($order->id); ?>">
                            </td>

                            <!-- N° Commande -->
                            <td>
                                <div class="flex flex-col">
                                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="font-medium text-noorea-gold hover:text-noorea-gold/80">
                                        <?php echo e($order->order_number); ?>

                                    </a>
                                    <span class="text-xs text-gray-500"><?php echo e($order->items->count()); ?> article(s)</span>
                                    <?php if($order->created_at->diffInHours() <= 2): ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 mt-1">
                                            <i class="fas fa-fire mr-1"></i>Nouvelle
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <!-- Client -->
                            <td>
                                <div class="flex items-center space-x-2">
                                    <div class="flex-shrink-0 h-8 w-8 bg-gray-300 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-600 text-sm"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-900"><?php echo e($order->customer_name); ?></span>
                                        <?php if($order->customer_email): ?>
                                            <span class="text-xs text-gray-500"><?php echo e($order->customer_email); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td>
                                <div class="flex flex-col space-y-1">
                                    <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $order->customer_phone)); ?>?text=Bonjour%20<?php echo e(urlencode($order->customer_name)); ?>,%20concernant%20votre%20commande%20<?php echo e($order->order_number); ?>" 
                                       target="_blank" 
                                       class="text-green-600 hover:text-green-800 flex items-center text-sm">
                                        <i class="fab fa-whatsapp mr-1"></i>
                                        <?php echo e($order->customer_phone); ?>

                                    </a>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?php echo e($order->city); ?>

                                    </div>
                                </div>
                            </td>

                            <!-- Articles -->
                            <td>
                                <div class="flex flex-col">
                                    <?php $firstItems = $order->items->take(2); ?>
                                    <?php $__currentLoopData = $firstItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center space-x-2 mb-1">
                                            <?php if($item->product && $item->product->images && count($item->product->images) > 0): ?>
                                                <img src="<?php echo e($item->product->images[0]); ?>" 
                                                     alt="<?php echo e($item->product_name); ?>" 
                                                     class="w-6 h-6 object-cover rounded">
                                            <?php else: ?>
                                                <div class="w-6 h-6 bg-gray-100 rounded flex items-center justify-center">
                                                    <i class="fas fa-box text-gray-400 text-xs"></i>
                                                </div>
                                            <?php endif; ?>
                                            <span class="text-sm text-gray-700"><?php echo e(Str::limit($item->product_name, 20)); ?></span>
                                            <span class="text-xs text-gray-500">x<?php echo e($item->quantity); ?></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($order->items->count() > 2): ?>
                                        <span class="text-xs text-gray-500">
                                            +<?php echo e($order->items->count() - 2); ?> autre(s)
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <!-- Montant -->
                            <td>
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-900"><?php echo e($order->formatted_total); ?></span>
                                    <?php if($order->shipping_fee > 0): ?>
                                        <span class="text-xs text-gray-500">+<?php echo e(number_format($order->shipping_fee, 0, ',', ' ')); ?> FCFA livraison</span>
                                    <?php endif; ?>
                                    <?php if($order->items->sum('quantity') > 1): ?>
                                        <span class="text-xs text-blue-600"><?php echo e($order->items->sum('quantity')); ?> articles</span>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <!-- Montant -->
                            <td>
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-900"><?php echo e($order->formatted_total); ?></span>
                                    <?php if($order->shipping_fee > 0): ?>
                                        <span class="text-xs text-gray-500">+<?php echo e(number_format($order->shipping_fee, 0, ',', ' ')); ?> FCFA livraison</span>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <!-- Statut -->
                            <td>
                                <span class="px-2 py-1 rounded-full text-xs font-medium <?php echo e($order->status_badge); ?>">
                                    <?php echo e($order->status_label); ?>

                                </span>
                            </td>

                            <!-- Paiement -->
                            <td>
                                <?php
                                    $paymentBadges = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'partial' => 'bg-orange-100 text-orange-800',
                                        'paid' => 'bg-green-100 text-green-800',
                                        'refunded' => 'bg-red-100 text-red-800',
                                    ];
                                    $paymentLabels = [
                                        'pending' => 'En attente',
                                        'partial' => 'Partiel',
                                        'paid' => 'Payé',
                                        'refunded' => 'Remboursé',
                                    ];
                                ?>
                                <span class="px-2 py-1 rounded-full text-xs font-medium <?php echo e($paymentBadges[$order->payment_status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                    <?php echo e($paymentLabels[$order->payment_status] ?? 'Inconnu'); ?>

                                </span>
                            </td>

                            <!-- Date -->
                            <td>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-900"><?php echo e($order->created_at->format('d/m/Y')); ?></span>
                                    <span class="text-xs text-gray-500"><?php echo e($order->created_at->format('H:i')); ?></span>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td>
                                <div class="flex items-center justify-center space-x-1">
                                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>" 
                                       class="btn-admin-icon hover:bg-blue-100" title="Voir détails">
                                        <i class="fas fa-eye text-blue-600"></i>
                                    </a>
                                    
                                    <?php if($order->status === 'pending'): ?>
                                        <form action="<?php echo e(route('admin.orders.update-status', $order)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="btn-admin-icon hover:bg-green-100" title="Confirmer">
                                                <i class="fas fa-check text-green-600"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo e(route('admin.orders.edit', $order)); ?>" 
                                       class="btn-admin-icon hover:bg-yellow-100" title="Modifier">
                                        <i class="fas fa-edit text-yellow-600"></i>
                                    </a>
                                    
                                    <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $order->customer_phone)); ?>?text=Bonjour%20<?php echo e(urlencode($order->customer_name)); ?>,%20concernant%20votre%20commande%20<?php echo e($order->order_number); ?>" 
                                       target="_blank" class="btn-admin-icon hover:bg-green-100" title="WhatsApp">
                                        <i class="fab fa-whatsapp text-green-600"></i>
                                    </a>
                                    
                                    <a href="<?php echo e(route('admin.orders.invoice', $order)); ?>" 
                                       target="_blank" class="btn-admin-icon hover:bg-purple-100" title="Facture">
                                        <i class="fas fa-file-invoice text-purple-600"></i>
                                    </a>
                                    
                                    <!-- Menu déroulant pour plus d'actions -->
                                    <div class="relative inline-block text-left">
                                        <button onclick="toggleDropdown('dropdown-<?php echo e($order->id); ?>')" 
                                                class="btn-admin-icon hover:bg-gray-100" title="Plus d'actions">
                                            <i class="fas fa-ellipsis-v text-gray-600"></i>
                                        </button>
                                        <div id="dropdown-<?php echo e($order->id); ?>" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                            <div class="py-1">
                                                <a href="<?php echo e(route('admin.orders.show', $order)); ?>" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fas fa-eye mr-2"></i>Voir détails
                                                </a>
                                                <a href="<?php echo e(route('admin.orders.edit', $order)); ?>" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fas fa-edit mr-2"></i>Modifier
                                                </a>
                                                <a href="<?php echo e(route('admin.orders.invoice', $order)); ?>" 
                                                   target="_blank" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fas fa-file-invoice mr-2"></i>Générer facture
                                                </a>
                                                <div class="border-t border-gray-100"></div>
                                                <?php if(in_array($order->status, ['pending', 'cancelled'])): ?>
                                                    <form action="<?php echo e(route('admin.orders.destroy', $order)); ?>" 
                                                          method="POST" class="inline w-full"
                                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                            <i class="fas fa-trash mr-2"></i>Supprimer
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination avec infos -->
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Affichage de <?php echo e($orders->firstItem() ?? 0); ?> à <?php echo e($orders->lastItem() ?? 0); ?> 
                    sur <?php echo e($orders->total()); ?> commandes
                </div>
                <div>
                    <?php echo e($orders->withQueryString()->links()); ?>

                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shopping-cart text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune commande</h3>
                <p class="text-gray-500">
                    <?php if(request()->hasAny(['search', 'status', 'payment_status', 'date_from', 'date_to'])): ?>
                        Aucune commande ne correspond aux filtres sélectionnés.
                    <?php else: ?>
                        Les commandes WhatsApp apparaîtront ici une fois créées.
                    <?php endif; ?>
                </p>
                <?php if(request()->hasAny(['search', 'status', 'payment_status', 'date_from', 'date_to'])): ?>
                    <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn-admin-primary mt-4">
                        Réinitialiser les filtres
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-actualisation toutes les 2 minutes pour les nouvelles commandes
        setInterval(function() {
            if (!document.hidden && window.location.pathname.includes('/admin/orders')) {
                const currentUrl = new URL(window.location);
                fetch(currentUrl.pathname + currentUrl.search, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => {
                    if (response.ok) {
                        // Optionnel: mettre à jour les statistiques uniquement
                        console.log('Données actualisées automatiquement');
                    }
                }).catch(console.error);
            }
        }, 120000); // 2 minutes

        // Fermer les dropdowns en cliquant ailleurs
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });
    });

    // Fonction pour toggle les dropdowns
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const isHidden = dropdown.classList.contains('hidden');
        
        // Fermer tous les autres dropdowns
        document.querySelectorAll('[id^="dropdown-"]').forEach(d => {
            if (d.id !== id) d.classList.add('hidden');
        });
        
        // Toggle le dropdown courant
        if (isHidden) {
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    }

    // Fonction pour sélectionner toutes les commandes
    function toggleAll(source) {
        const checkboxes = document.querySelectorAll('.order-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = source.checked;
        });
        updateBulkActions();
    }

    // Mettre à jour les actions en lot selon les sélections
    function updateBulkActions() {
        const checked = document.querySelectorAll('.order-checkbox:checked').length;
        const bulkActions = document.getElementById('bulk-actions');
        
        if (checked > 0) {
            // Afficher les actions en lot si des éléments sont sélectionnés
            console.log(`${checked} commande(s) sélectionnée(s)`);
        }
    }

    // Fonction d'export (à personnaliser selon vos besoins)
    function exportData() {
        const params = new URLSearchParams(window.location.search);
        params.set('export', 'excel');
        
        // Créer un lien temporaire pour télécharger
        const link = document.createElement('a');
        link.href = window.location.pathname + '?' + params.toString();
        link.download = 'commandes-' + new Date().toISOString().split('T')[0] + '.xlsx';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        // Ou rediriger vers une route d'export
        // window.location.href = '/admin/orders/export?' + params.toString();
    }

    // Marquer les commandes comme vues
    function markAsRead() {
        const selectedIds = Array.from(document.querySelectorAll('.order-checkbox:checked'))
            .map(cb => cb.value);
        
        if (selectedIds.length === 0) {
            alert('Veuillez sélectionner au moins une commande');
            return;
        }
        
        // Simuler le marquage comme lu
        selectedIds.forEach(id => {
            const row = document.querySelector(`input[value="${id}"]`).closest('tr');
            row.style.opacity = '0.7';
        });
        
        alert(`${selectedIds.length} commande(s) marquée(s) comme vue(s)`);
    }

    // Notification des nouvelles commandes (WebSocket ou polling)
    function checkNewOrders() {
        // Cette fonction pourrait être connectée à un système de notifications en temps réel
        // Par exemple avec Laravel Echo et Pusher
    }

    // Sons de notification (optionnel)
    function playNotificationSound() {
        // const audio = new Audio('/sounds/notification.mp3');
        // audio.play().catch(console.error);
    }

    // Raccourcis clavier
    document.addEventListener('keydown', function(e) {
        // Ctrl + R pour actualiser
        if (e.ctrlKey && e.key === 'r') {
            e.preventDefault();
            location.reload();
        }
        
        // Ctrl + F pour focus sur la recherche
        if (e.ctrlKey && e.key === 'f') {
            e.preventDefault();
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }
        
        // Échap pour fermer les dropdowns
        if (e.key === 'Escape') {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
    
    // Fonction de filtre par paiement
    function filterByPayment(status) {
        const url = new URL(window.location);
        if (status) {
            url.searchParams.set('payment_status', status);
        } else {
            url.searchParams.delete('payment_status');
        }
        window.location.href = url.toString();
    }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>