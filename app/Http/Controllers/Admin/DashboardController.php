<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques principales
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'total_categories' => Category::active()->count(),
            'total_brands' => Brand::active()->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::pending()->count(),
            'total_customers' => User::customers()->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
        ];

        // Commandes récentes
        $recent_orders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(5)
            ->get();

        // Produits les plus vus
        $top_viewed_products = Product::with(['category', 'brand'])
            ->where('views', '>', 0)
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // Ventes par mois (6 derniers mois)
        $sales_data = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('SUM(total) as revenue')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Produits en rupture de stock
        $low_stock_products = Product::where('stock_quantity', '<=', 5)
            ->where('status', 'active')
            ->with(['category', 'brand'])
            ->orderBy('stock_quantity', 'asc')
            ->take(5)
            ->get();

        // Nombre de commandes en attente pour la navbar
        $pending_orders_count = $stats['pending_orders'];

        return view('admin.dashboard.index', compact(
            'stats',
            'recent_orders',
            'top_viewed_products',
            'sales_data',
            'low_stock_products',
            'pending_orders_count'
        ));
    }

    /**
     * Données pour les graphiques (API endpoint)
     */
    public function chartData(Request $request)
    {
        $type = $request->get('type', 'sales');

        switch ($type) {
            case 'sales':
                return $this->getSalesChartData();
            case 'products':
                return $this->getProductsChartData();
            case 'categories':
                return $this->getCategoriesChartData();
            default:
                return response()->json([]);
        }
    }

    private function getSalesChartData()
    {
        $data = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as orders'),
                DB::raw('SUM(total) as revenue')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'labels' => $data->pluck('date')->toArray(),
            'orders' => $data->pluck('orders')->toArray(),
            'revenue' => $data->pluck('revenue')->toArray(),
        ]);
    }

    private function getProductsChartData()
    {
        $data = Product::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        return response()->json([
            'labels' => $data->pluck('status')->toArray(),
            'data' => $data->pluck('count')->toArray(),
        ]);
    }

    private function getCategoriesChartData()
    {
        $data = Category::select('categories.name', DB::raw('COUNT(products.id) as products_count'))
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->where('categories.is_active', true)
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('products_count', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'labels' => $data->pluck('name')->toArray(),
            'data' => $data->pluck('products_count')->toArray(),
        ]);
    }
}
