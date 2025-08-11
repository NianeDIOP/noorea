<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Order;

class AdminViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Partager les données globales admin
        View::composer('admin.layouts.app', function ($view) {
            $view->with([
                'pending_orders_count' => Order::pending()->count(),
            ]);
        });
    }
}
