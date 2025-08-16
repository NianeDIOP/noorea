@extends('account.layouts.master')

@section('content')
@php
    $page_title = 'Mes Commandes';
    $breadcrumb = [
        ['name' => 'Dashboard', 'url' => route('account.dashboard')],
        ['name' => 'Mes Commandes']
    ];
@endphp

<div class="client-card">
    <div class="client-card-header">
        <h2 class="client-card-title">
            <i class="fas fa-shopping-bag text-noorea-gold mr-2"></i>
            Mes Commandes
        </h2>
        <div class="flex items-center space-x-2">
            <select class="form-select text-sm border-gray-300 rounded-lg">
                <option value="all">Toutes les commandes</option>
                <option value="pending">En attente</option>
                <option value="processing">En traitement</option>
                <option value="completed">Terminées</option>
                <option value="cancelled">Annulées</option>
            </select>
        </div>
    </div>

    @if(isset($orders) && $orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-gray-50 rounded-lg p-6 hover:bg-gray-100 transition-colors">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Commande #{{ $order->id }}</h3>
                            <p class="text-sm text-gray-600">{{ $order->created_at->format('d/m/Y à H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-900">{{ number_format($order->total, 0, ',', ' ') }} FCFA</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($order->status === 'completed') bg-green-100 text-green-800
                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                @switch($order->status)
                                    @case('completed') <i class="fas fa-check-circle mr-1"></i> Terminée @break
                                    @case('pending') <i class="fas fa-clock mr-1"></i> En attente @break
                                    @case('processing') <i class="fas fa-cog mr-1"></i> En traitement @break
                                    @case('cancelled') <i class="fas fa-times-circle mr-1"></i> Annulée @break
                                    @default {{ $order->status }}
                                @endswitch
                            </span>
                        </div>
                    </div>

                    @if($order->orderItems)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                            @foreach($order->orderItems->take(3) as $item)
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('images/products/' . $item->product->image) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                                <i class="fas fa-image text-gray-500"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $item->product_name }}</p>
                                        <p class="text-xs text-gray-600">Qté: {{ $item->quantity }} × {{ number_format($item->price, 0, ',', ' ') }} FCFA</p>
                                    </div>
                                </div>
                            @endforeach
                            @if($order->orderItems->count() > 3)
                                <div class="flex items-center justify-center text-sm text-gray-500">
                                    +{{ $order->orderItems->count() - 3 }} autres article(s)
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div class="flex items-center space-x-4 text-sm">
                            <span class="text-gray-600">
                                <i class="fas fa-box mr-1"></i>
                                {{ $order->orderItems ? $order->orderItems->sum('quantity') : 0 }} article(s)
                            </span>
                            @if($order->delivery_date)
                                <span class="text-gray-600">
                                    <i class="fas fa-truck mr-1"></i>
                                    Livré le {{ $order->delivery_date->format('d/m/Y') }}
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('account.orders.show', $order) }}" class="btn-client-secondary text-sm px-3 py-1">
                                <i class="fas fa-eye mr-1"></i>
                                Voir détails
                            </a>
                            @if($order->status === 'completed')
                                <button class="btn-client-outline text-sm px-3 py-1">
                                    <i class="fas fa-redo mr-1"></i>
                                    Recommander
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if(method_exists($orders, 'links'))
            <div class="mt-6 flex justify-center">
                {{ $orders->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-shopping-bag text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Aucune commande trouvée</h3>
            <p class="text-gray-600 mb-6">Vous n'avez encore passé aucune commande sur Noorea.</p>
            <a href="{{ route('products') }}" class="btn-client-primary">
                <i class="fas fa-shopping-cart mr-2"></i>
                Découvrir nos produits
            </a>
        </div>
    @endif
</div>

<!-- Statistiques des commandes -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
    <div class="stats-card primary">
        <div class="text-center">
            <div class="stats-card-icon mx-auto mb-3">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_orders'] ?? 0 }}</h3>
            <p class="text-sm text-gray-600">Total des commandes</p>
        </div>
    </div>

    <div class="stats-card success">
        <div class="text-center">
            <div class="stats-card-icon mx-auto mb-3">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $stats['completed_orders'] ?? 0 }}</h3>
            <p class="text-sm text-gray-600">Commandes terminées</p>
        </div>
    </div>

    <div class="stats-card info">
        <div class="text-center">
            <div class="stats-card-icon mx-auto mb-3">
                <i class="fas fa-coins"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_spent'] ?? 0, 0, ',', ' ') }}</h3>
            <p class="text-sm text-gray-600">Total dépensé (FCFA)</p>
        </div>
    </div>

    <div class="stats-card warning">
        <div class="text-center">
            <div class="stats-card-icon mx-auto mb-3">
                <i class="fas fa-clock"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $stats['pending_orders'] ?? 0 }}</h3>
            <p class="text-sm text-gray-600">En attente</p>
        </div>
    </div>
</div>
@endsection
