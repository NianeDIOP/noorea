@extends('admin.layouts.app')

@section('title', 'Commande #' . $order->order_number)

@section('content')
    <!-- Header -->
    <div class="admin-card">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="h-8 w-1 bg-noorea-gold rounded-full"></div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Commande {{ $order->order_number }}</h1>
                    <p class="text-gray-600 mt-1">Détails et gestion de la commande WhatsApp</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.orders.index') }}" class="btn-admin-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                </a>
                <a href="{{ route('admin.orders.edit', $order) }}" class="btn-admin-primary">
                    <i class="fas fa-edit mr-2"></i>Modifier
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informations de la commande -->
            <div class="admin-card">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-info text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Informations générales</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Numéro de commande</p>
                        <p class="text-lg font-bold text-noorea-gold">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Date de commande</p>
                        <p class="text-gray-900">{{ $order->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Statut</p>
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $order->status_badge }}">
                            {{ $order->status_label }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Statut du paiement</p>
                        @php
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
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $paymentBadges[$order->payment_status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $paymentLabels[$order->payment_status] ?? 'Inconnu' }}
                        </span>
                    </div>
                    @if($order->tracking_number)
                        <div>
                            <p class="text-sm font-medium text-gray-600">Numéro de suivi</p>
                            <p class="text-gray-900 font-mono">{{ $order->tracking_number }}</p>
                        </div>
                    @endif
                </div>

                <!-- Timeline -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Timeline</h4>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Commande créée le {{ $order->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        @if($order->confirmed_at)
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Confirmée le {{ $order->confirmed_at->format('d/m/Y à H:i') }}</span>
                            </div>
                        @endif
                        @if($order->shipped_at)
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Expédiée le {{ $order->shipped_at->format('d/m/Y à H:i') }}</span>
                            </div>
                        @endif
                        @if($order->delivered_at)
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-600 rounded-full"></div>
                                <span class="text-sm text-gray-600">Livrée le {{ $order->delivered_at->format('d/m/Y à H:i') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Articles commandés -->
            <div class="admin-card">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-box text-purple-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Articles commandés</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Produit</th>
                                <th class="text-center py-3 px-4 font-medium text-gray-600">Quantité</th>
                                <th class="text-right py-3 px-4 font-medium text-gray-600">Prix unitaire</th>
                                <th class="text-right py-3 px-4 font-medium text-gray-600">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            @if($item->product && $item->product->images && count($item->product->images) > 0)
                                                <img src="{{ $item->product->images[0] }}" 
                                                     alt="{{ $item->product_name }}" 
                                                     class="w-12 h-12 object-cover rounded-lg">
                                            @else
                                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-box text-gray-400"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $item->product_name }}</p>
                                                @if($item->product_sku)
                                                    <p class="text-sm text-gray-500">SKU: {{ $item->product_sku }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-right">{{ $item->formatted_price }}</td>
                                    <td class="py-4 px-4 text-right font-medium">{{ $item->formatted_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-gray-200">
                                <td colspan="3" class="py-4 px-4 text-right font-medium text-gray-600">Sous-total :</td>
                                <td class="py-4 px-4 text-right font-medium">{{ number_format($order->subtotal, 0, ',', ' ') }} FCFA</td>
                            </tr>
                            @if($order->shipping_fee > 0)
                                <tr>
                                    <td colspan="3" class="py-2 px-4 text-right text-gray-600">Frais de livraison :</td>
                                    <td class="py-2 px-4 text-right">{{ number_format($order->shipping_fee, 0, ',', ' ') }} FCFA</td>
                                </tr>
                            @endif
                            <tr class="border-t border-gray-200 bg-gray-50">
                                <td colspan="3" class="py-4 px-4 text-right font-bold text-gray-900">Total :</td>
                                <td class="py-4 px-4 text-right font-bold text-xl text-noorea-gold">{{ $order->formatted_total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Notes -->
            @if($order->notes)
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-sticky-note text-yellow-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Notes</h3>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <pre class="text-sm text-gray-700 whitespace-pre-wrap">{{ $order->notes }}</pre>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Actions rapides -->
            <div class="admin-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h3>
                <div class="space-y-3">
                    <!-- Changer statut -->
                    @if($order->status !== 'delivered' && $order->status !== 'cancelled')
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-700">Changer le statut</label>
                                <div class="flex space-x-2">
                                    <select name="status" class="admin-form-select flex-1">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>En traitement</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Expédiée</option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Livrée</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                    </select>
                                    <button type="submit" class="btn-admin-primary px-3">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif

                    <!-- Contact WhatsApp -->
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}?text=Bonjour%20{{ urlencode($order->customer_name) }},%20concernant%20votre%20commande%20{{ $order->order_number }}" 
                       target="_blank" class="btn-admin-success w-full text-center">
                        <i class="fab fa-whatsapp mr-2"></i>Contacter client
                    </a>

                    <!-- Facture -->
                    <a href="{{ route('admin.orders.invoice', $order) }}" 
                       target="_blank" class="btn-admin-secondary w-full text-center">
                        <i class="fas fa-file-invoice mr-2"></i>Générer facture
                    </a>

                    <!-- Modifier -->
                    <a href="{{ route('admin.orders.edit', $order) }}" class="btn-admin-primary w-full text-center">
                        <i class="fas fa-edit mr-2"></i>Modifier commande
                    </a>
                </div>
            </div>

            <!-- Informations client -->
            <div class="admin-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations client</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Nom</p>
                        <p class="text-gray-900">{{ $order->customer_name }}</p>
                    </div>
                    @if($order->customer_email)
                        <div>
                            <p class="text-sm font-medium text-gray-600">Email</p>
                            <a href="mailto:{{ $order->customer_email }}" class="text-blue-600 hover:text-blue-800">
                                {{ $order->customer_email }}
                            </a>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-600">Téléphone</p>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" 
                           target="_blank" class="text-green-600 hover:text-green-800 flex items-center">
                            <i class="fab fa-whatsapp mr-1"></i>
                            {{ $order->customer_phone }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Adresse de livraison -->
            <div class="admin-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Livraison</h3>
                <div class="space-y-2">
                    <p class="text-gray-900">{{ $order->shipping_address }}</p>
                    <p class="text-gray-600">{{ $order->city }}</p>
                    @if($order->postal_code)
                        <p class="text-gray-600">{{ $order->postal_code }}</p>
                    @endif
                </div>
            </div>

            <!-- Ajouter une note -->
            <div class="admin-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ajouter une note</h3>
                <form action="{{ route('admin.orders.add-note', $order) }}" method="POST">
                    @csrf
                    <div class="space-y-3">
                        <textarea name="note" rows="3" 
                                  class="admin-form-input"
                                  placeholder="Note interne sur la commande..."></textarea>
                        <button type="submit" class="btn-admin-primary w-full">
                            <i class="fas fa-plus mr-2"></i>Ajouter note
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
