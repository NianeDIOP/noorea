

<?php $__env->startSection('content'); ?>
<?php
    $page_title = 'Dashboard';
    $breadcrumb = [];
?>

<!-- Grid des statistiques principales -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Produits -->
    <div class="stats-card primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Produits</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e(number_format($stats['total_products'])); ?></p>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="text-green-600"><?php echo e($stats['active_products']); ?> actifs</span>
                </p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </div>

    <!-- Total Commandes -->
    <div class="stats-card info">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Commandes</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e(number_format($stats['total_orders'])); ?></p>
                <p class="text-sm text-gray-600 mt-1">
                    <span class="text-yellow-600"><?php echo e($stats['pending_orders']); ?> en attente</span>
                </p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <!-- Chiffre d'affaires -->
    <div class="stats-card success">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Revenus</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e(number_format($stats['total_revenue'], 0, ',', ' ')); ?></p>
                <p class="text-sm text-gray-600 mt-1">FCFA</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>

    <!-- Clients -->
    <div class="stats-card warning">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Clients</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e(number_format($stats['total_customers'])); ?></p>
                <p class="text-sm text-gray-600 mt-1">Comptes actifs</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div>

<!-- Grid principal -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Graphique des ventes -->
    <div class="lg:col-span-2">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-chart-line text-noorea-gold mr-2"></i>
                    Évolution des ventes (30 derniers jours)
                </h3>
                <div class="flex space-x-2">
                    <button class="btn-admin-secondary text-xs px-3 py-1" onclick="updateChart('orders')">Commandes</button>
                    <button class="btn-admin-primary text-xs px-3 py-1" onclick="updateChart('revenue')">Revenus</button>
                </div>
            </div>
            <div class="relative h-80">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Répartition par catégories -->
    <div>
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-chart-pie text-noorea-emerald mr-2"></i>
                    Top Catégories
                </h3>
            </div>
            <div class="relative h-64">
                <canvas id="categoriesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Grid des listes -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Commandes récentes -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">
                <i class="fas fa-clock text-blue-500 mr-2"></i>
                Commandes récentes
            </h3>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn-admin-secondary text-sm px-4 py-2">
                Voir tout
            </a>
        </div>
        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $recent_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-noorea-gold/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-receipt text-noorea-gold"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900"><?php echo e($order->order_number); ?></p>
                                <p class="text-sm text-gray-600"><?php echo e($order->customer_name); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e($order->created_at->diffForHumans()); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900"><?php echo e($order->formatted_total); ?></p>
                        <span class="status-badge <?php echo e(strtolower($order->status)); ?>">
                            <?php echo e($order->status_label); ?>

                        </span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4"></i>
                    <p>Aucune commande récente</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Produits les plus vus -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">
                <i class="fas fa-eye text-purple-500 mr-2"></i>
                Produits les plus vus
            </h3>
            <a href="<?php echo e(route('admin.products.index')); ?>" class="btn-admin-secondary text-sm px-4 py-2">
                Voir tout
            </a>
        </div>
        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $top_viewed_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                        <?php if($product->main_image): ?>
                            <img src="<?php echo e($product->main_image); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fas fa-image"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate"><?php echo e($product->name); ?></p>
                        <p class="text-sm text-gray-600"><?php echo e($product->category->name ?? 'N/A'); ?></p>
                        <div class="flex items-center space-x-4 mt-1">
                            <span class="text-xs text-purple-600 bg-purple-100 px-2 py-1 rounded">
                                <i class="fas fa-eye mr-1"></i><?php echo e(number_format($product->views)); ?> vues
                            </span>
                            <span class="text-xs text-green-600 font-medium"><?php echo e($product->formatted_price); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-chart-line text-4xl mb-4"></i>
                    <p>Aucune donnée de vue disponible</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Alertes stock faible -->
<?php if($low_stock_products->count() > 0): ?>
<div class="admin-card mb-8">
    <div class="admin-card-header">
        <h3 class="admin-card-title text-red-600">
            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
            Alertes stock faible
        </h3>
        <span class="status-badge danger"><?php echo e($low_stock_products->count()); ?> produit(s)</span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php $__currentLoopData = $low_stock_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border border-red-200 rounded-lg p-4 bg-red-50">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-red-100 rounded-lg overflow-hidden flex-shrink-0">
                        <?php if($product->main_image): ?>
                            <img src="<?php echo e($product->main_image); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-red-400">
                                <i class="fas fa-image"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900"><?php echo e($product->name); ?></p>
                        <p class="text-sm text-gray-600"><?php echo e($product->category->name ?? 'N/A'); ?></p>
                        <p class="text-sm font-semibold text-red-600">
                            Stock: <?php echo e($product->stock_quantity); ?> unité(s)
                        </p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="<?php echo e(route('admin.products.edit', $product)); ?>" 
                       class="btn-admin-danger text-xs px-3 py-1 w-full">
                        <i class="fas fa-edit mr-1"></i>
                        Réapprovisionner
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Graphique des ventes
const salesCtx = document.getElementById('salesChart').getContext('2d');
let salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Revenus (FCFA)',
            data: [],
            borderColor: 'rgb(212, 175, 55)',
            backgroundColor: 'rgba(212, 175, 55, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return new Intl.NumberFormat('fr-FR').format(value) + ' FCFA';
                    }
                }
            }
        }
    }
});

// Graphique des catégories
const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
const categoriesChart = new Chart(categoriesCtx, {
    type: 'doughnut',
    data: {
        labels: [],
        datasets: [{
            data: [],
            backgroundColor: [
                'rgb(212, 175, 55)',
                'rgb(29, 111, 88)',
                'rgb(224, 191, 184)',
                'rgb(44, 62, 80)',
                'rgb(52, 152, 219)',
                'rgb(155, 89, 182)',
                'rgb(241, 196, 15)',
                'rgb(231, 76, 60)',
                'rgb(46, 204, 113)',
                'rgb(230, 126, 34)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Charger les données des graphiques
async function loadChartData() {
    try {
        // Données des ventes
        const salesResponse = await fetch('<?php echo e(route('admin.dashboard.chart-data')); ?>?type=sales');
        const salesData = await salesResponse.json();
        
        salesChart.data.labels = salesData.labels;
        salesChart.data.datasets[0].data = salesData.revenue;
        salesChart.update();

        // Données des catégories
        const categoriesResponse = await fetch('<?php echo e(route('admin.dashboard.chart-data')); ?>?type=categories');
        const categoriesData = await categoriesResponse.json();
        
        categoriesChart.data.labels = categoriesData.labels;
        categoriesChart.data.datasets[0].data = categoriesData.data;
        categoriesChart.update();

    } catch (error) {
        console.error('Erreur lors du chargement des données des graphiques:', error);
    }
}

// Mettre à jour le graphique des ventes
async function updateChart(type) {
    try {
        const response = await fetch(`<?php echo e(route('admin.dashboard.chart-data')); ?>?type=sales`);
        const data = await response.json();
        
        if (type === 'orders') {
            salesChart.data.datasets[0].label = 'Nombre de commandes';
            salesChart.data.datasets[0].data = data.orders;
            salesChart.options.scales.y.ticks.callback = function(value) {
                return value + ' commande(s)';
            };
        } else {
            salesChart.data.datasets[0].label = 'Revenus (FCFA)';
            salesChart.data.datasets[0].data = data.revenue;
            salesChart.options.scales.y.ticks.callback = function(value) {
                return new Intl.NumberFormat('fr-FR').format(value) + ' FCFA';
            };
        }
        
        salesChart.update();
        
        // Mettre à jour les boutons
        document.querySelectorAll('[onclick*="updateChart"]').forEach(btn => {
            btn.className = btn.textContent.toLowerCase().includes(type) 
                ? 'btn-admin-primary text-xs px-3 py-1'
                : 'btn-admin-secondary text-xs px-3 py-1';
        });
        
    } catch (error) {
        console.error('Erreur lors de la mise à jour du graphique:', error);
    }
}

// Charger les données au chargement de la page
document.addEventListener('DOMContentLoaded', loadChartData);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>