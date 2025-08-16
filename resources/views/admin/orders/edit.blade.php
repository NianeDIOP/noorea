@extends('admin.layouts.app')

@section('title', 'Modifier la commande #' . $order->order_number)

@section('content')
    <!-- Header -->
    <div class="admin-card">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="h-8 w-1 bg-noorea-gold rounded-full"></div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Modifier la commande {{ $order->order_number }}</h1>
                    <p class="text-gray-600 mt-1">Modifiez les informations de la commande et le statut</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.orders.show', $order) }}" class="btn-admin-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour aux détails
                </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Erreurs de validation</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Contenu principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Statut de la commande -->
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-flag text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Statut de la commande</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Statut -->
                        <div class="admin-form-group">
                            <label class="admin-form-label required">Statut de la commande</label>
                            <select name="status" class="admin-form-select @error('status') border-red-300 @enderror">
                                <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmed" {{ old('status', $order->status) === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                <option value="processing" {{ old('status', $order->status) === 'processing' ? 'selected' : '' }}>En traitement</option>
                                <option value="shipped" {{ old('status', $order->status) === 'shipped' ? 'selected' : '' }}>Expédiée</option>
                                <option value="delivered" {{ old('status', $order->status) === 'delivered' ? 'selected' : '' }}>Livrée</option>
                                <option value="cancelled" {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                            @error('status')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Statut de paiement -->
                        <div class="admin-form-group">
                            <label class="admin-form-label required">Statut du paiement</label>
                            <select name="payment_status" class="admin-form-select @error('payment_status') border-red-300 @enderror">
                                <option value="pending" {{ old('payment_status', $order->payment_status) === 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="partial" {{ old('payment_status', $order->payment_status) === 'partial' ? 'selected' : '' }}>Partiel</option>
                                <option value="paid" {{ old('payment_status', $order->payment_status) === 'paid' ? 'selected' : '' }}>Payé</option>
                                <option value="refunded" {{ old('payment_status', $order->payment_status) === 'refunded' ? 'selected' : '' }}>Remboursé</option>
                            </select>
                            @error('payment_status')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Numéro de suivi -->
                        <div class="admin-form-group md:col-span-2">
                            <label class="admin-form-label">Numéro de suivi</label>
                            <input type="text" name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}" 
                                   class="admin-form-input @error('tracking_number') border-red-300 @enderror"
                                   placeholder="Ex: TRK123456789">
                            <p class="text-sm text-gray-500 mt-1">Numéro de suivi pour la livraison (optionnel)</p>
                            @error('tracking_number')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Informations client -->
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informations client</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Nom et Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="admin-form-group">
                                <label class="admin-form-label required">Nom du client</label>
                                <input type="text" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" 
                                       class="admin-form-input @error('customer_name') border-red-300 @enderror">
                                @error('customer_name')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Email</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email', $order->customer_email) }}" 
                                       class="admin-form-input @error('customer_email') border-red-300 @enderror">
                                @error('customer_email')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Téléphone -->
                        <div class="admin-form-group">
                            <label class="admin-form-label required">Téléphone</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" 
                                   class="admin-form-input @error('customer_phone') border-red-300 @enderror"
                                   placeholder="Ex: +221 77 123 45 67">
                            @error('customer_phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Adresse de livraison -->
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-purple-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Adresse de livraison</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Adresse -->
                        <div class="admin-form-group">
                            <label class="admin-form-label required">Adresse complète</label>
                            <textarea name="shipping_address" rows="3" 
                                      class="admin-form-input @error('shipping_address') border-red-300 @enderror"
                                      placeholder="Adresse complète de livraison">{{ old('shipping_address', $order->shipping_address) }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ville et Code postal -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="admin-form-group">
                                <label class="admin-form-label required">Ville</label>
                                <input type="text" name="city" value="{{ old('city', $order->city) }}" 
                                       class="admin-form-input @error('city') border-red-300 @enderror">
                                @error('city')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Code postal</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code', $order->postal_code) }}" 
                                       class="admin-form-input @error('postal_code') border-red-300 @enderror">
                                @error('postal_code')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-sticky-note text-yellow-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Notes</h3>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">Notes internes</label>
                        <textarea name="notes" rows="4" 
                                  class="admin-form-input @error('notes') border-red-300 @enderror"
                                  placeholder="Notes internes sur la commande...">{{ old('notes', $order->notes) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Ces notes ne sont visibles que par l'équipe administrative</p>
                        @error('notes')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Actions -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <button type="submit" class="btn-admin-primary w-full">
                            <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn-admin-outline w-full text-center">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </a>
                    </div>
                </div>

                <!-- Livraison -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Frais de livraison</h3>
                    
                    <div class="admin-form-group">
                        <label class="admin-form-label required">Frais de livraison (FCFA)</label>
                        <input type="number" name="shipping_fee" value="{{ old('shipping_fee', $order->shipping_fee) }}" 
                               min="0" step="1" class="admin-form-input @error('shipping_fee') border-red-300 @enderror">
                        @error('shipping_fee')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                        <div class="text-sm">
                            <div class="flex justify-between">
                                <span>Sous-total :</span>
                                <span>{{ number_format($order->subtotal, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between mt-1">
                                <span>Frais de livraison :</span>
                                <span id="shipping-display">{{ number_format($order->shipping_fee, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between font-bold text-lg border-t pt-2 mt-2">
                                <span>Total :</span>
                                <span id="total-display">{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Résumé de la commande -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Articles commandés</h3>
                    
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    @if($item->product && $item->product->images && count($item->product->images) > 0)
                                        <img src="{{ $item->product->images[0] }}" 
                                             alt="{{ $item->product_name }}" 
                                             class="w-10 h-10 object-cover rounded-lg">
                                    @else
                                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-box text-gray-400 text-sm"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-sm text-gray-900">{{ $item->product_name }}</p>
                                        <p class="text-xs text-gray-500">Qté: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <div class="text-sm font-medium">{{ $item->formatted_total }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Contact WhatsApp -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact client</h3>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}?text=Bonjour%20{{ urlencode($order->customer_name) }},%20concernant%20votre%20commande%20{{ $order->order_number }}" 
                       target="_blank" class="btn-admin-success w-full text-center">
                        <i class="fab fa-whatsapp mr-2"></i>Ouvrir WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const shippingFeeInput = document.querySelector('input[name="shipping_fee"]');
        const subtotal = {{ $order->subtotal }};

        shippingFeeInput.addEventListener('input', function() {
            const shippingFee = parseFloat(this.value) || 0;
            const total = subtotal + shippingFee;
            
            document.getElementById('shipping-display').textContent = 
                new Intl.NumberFormat('fr-FR').format(shippingFee) + ' FCFA';
            document.getElementById('total-display').textContent = 
                new Intl.NumberFormat('fr-FR').format(total) + ' FCFA';
        });
    });
    </script>
@endsection
