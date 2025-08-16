@extends('admin.layouts.app')

@section('title', 'Créer une commande manuelle')

@section('content')
    <!-- Header -->
    <div class="admin-card">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="h-8 w-1 bg-noorea-gold rounded-full"></div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Créer une commande manuelle</h1>
                    <p class="text-gray-600 mt-1">Pour les commandes téléphoniques ou cas exceptionnels</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.orders.index') }}" class="btn-admin-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
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

    <form action="{{ route('admin.orders.store') }}" method="POST" id="orderForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Contenu principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Informations client -->
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informations client</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Nom et Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="admin-form-group">
                                <label class="admin-form-label required">Nom du client</label>
                                <input type="text" name="customer_name" value="{{ old('customer_name') }}" 
                                       class="admin-form-input @error('customer_name') border-red-300 @enderror"
                                       placeholder="Nom complet du client">
                                @error('customer_name')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Email</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email') }}" 
                                       class="admin-form-input @error('customer_email') border-red-300 @enderror"
                                       placeholder="email@exemple.com">
                                @error('customer_email')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Téléphone -->
                        <div class="admin-form-group">
                            <label class="admin-form-label required">Téléphone</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" 
                                   class="admin-form-input @error('customer_phone') border-red-300 @enderror"
                                   placeholder="Ex: +221 77 123 45 67">
                            <p class="text-sm text-gray-500 mt-1">Format international recommandé</p>
                            @error('customer_phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Adresse de livraison -->
                <div class="admin-card">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Adresse de livraison</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Adresse -->
                        <div class="admin-form-group">
                            <label class="admin-form-label required">Adresse complète</label>
                            <textarea name="shipping_address" rows="3" 
                                      class="admin-form-input @error('shipping_address') border-red-300 @enderror"
                                      placeholder="Adresse complète de livraison">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ville et Code postal -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="admin-form-group">
                                <label class="admin-form-label required">Ville</label>
                                <input type="text" name="city" value="{{ old('city') }}" 
                                       class="admin-form-input @error('city') border-red-300 @enderror"
                                       placeholder="Ex: Dakar">
                                @error('city')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Code postal</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code') }}" 
                                       class="admin-form-input @error('postal_code') border-red-300 @enderror"
                                       placeholder="Ex: 12000">
                                @error('postal_code')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sélection des produits -->
                <div class="admin-card">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-box text-purple-600"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Produits commandés</h3>
                        </div>
                        <button type="button" onclick="addProduct()" class="btn-admin-primary">
                            <i class="fas fa-plus mr-2"></i>Ajouter un produit
                        </button>
                    </div>

                    <div id="products-list" class="space-y-4">
                        <!-- Les produits sélectionnés apparaîtront ici -->
                        <div class="text-center py-8 text-gray-500" id="no-products">
                            <i class="fas fa-box-open text-4xl mb-4"></i>
                            <p>Aucun produit sélectionné</p>
                            <p class="text-sm">Cliquez sur "Ajouter un produit" pour commencer</p>
                        </div>
                    </div>

                    <!-- Totaux -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-end">
                            <div class="w-80 space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span>Sous-total :</span>
                                    <span id="subtotal">0 FCFA</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span>Frais de livraison :</span>
                                    <span id="shipping-display">0 FCFA</span>
                                </div>
                                <div class="flex justify-between font-bold text-lg border-t pt-2">
                                    <span>Total :</span>
                                    <span id="total">0 FCFA</span>
                                </div>
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
                                  placeholder="Notes sur la commande, circonstances particulières...">{{ old('notes') }}</textarea>
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
                        <button type="submit" class="btn-admin-primary w-full" id="submitBtn" disabled>
                            <i class="fas fa-save mr-2"></i>Créer la commande
                        </button>
                        <a href="{{ route('admin.orders.index') }}" class="btn-admin-outline w-full text-center">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </a>
                    </div>
                    <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <i class="fas fa-info-circle mr-1"></i>
                            La commande sera automatiquement confirmée et prête à traiter.
                        </p>
                    </div>
                </div>

                <!-- Configuration -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Configuration</h3>
                    
                    <!-- Statut de paiement -->
                    <div class="admin-form-group">
                        <label class="admin-form-label required">Statut du paiement</label>
                        <select name="payment_status" class="admin-form-select @error('payment_status') border-red-300 @enderror">
                            <option value="pending" {{ old('payment_status', 'pending') === 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="partial" {{ old('payment_status') === 'partial' ? 'selected' : '' }}>Paiement partiel</option>
                            <option value="paid" {{ old('payment_status') === 'paid' ? 'selected' : '' }}>Payé intégralement</option>
                        </select>
                        @error('payment_status')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Frais de livraison -->
                    <div class="admin-form-group">
                        <label class="admin-form-label required">Frais de livraison (FCFA)</label>
                        <input type="number" name="shipping_fee" value="{{ old('shipping_fee', 0) }}" 
                               min="0" step="1" 
                               class="admin-form-input @error('shipping_fee') border-red-300 @enderror"
                               onchange="updateTotals()">
                        @error('shipping_fee')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Produits disponibles -->
                <div class="admin-card">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recherche produit</h3>
                    
                    <div class="admin-form-group">
                        <input type="text" id="product-search" 
                               class="admin-form-input" 
                               placeholder="Rechercher un produit..."
                               onkeyup="searchProducts()">
                    </div>

                    <div id="product-results" class="max-h-64 overflow-y-auto space-y-2">
                        <!-- Résultats de recherche apparaîtront ici -->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Template pour les produits -->
    <template id="product-template">
        <div class="product-item border rounded-lg p-4" data-product-id="">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img class="w-12 h-12 object-cover rounded-lg product-image" src="" alt="">
                    <div>
                        <p class="font-medium product-name"></p>
                        <p class="text-sm text-gray-500 product-price"></p>
                        <p class="text-xs text-gray-400 product-stock"></p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button type="button" onclick="decreaseQuantity(this)" class="w-8 h-8 bg-gray-100 rounded flex items-center justify-center">-</button>
                    <input type="number" class="w-16 text-center border rounded quantity-input" value="1" min="1" onchange="updateTotals()">
                    <button type="button" onclick="increaseQuantity(this)" class="w-8 h-8 bg-gray-100 rounded flex items-center justify-center">+</button>
                    <button type="button" onclick="removeProduct(this)" class="w-8 h-8 bg-red-100 text-red-600 rounded flex items-center justify-center">×</button>
                </div>
            </div>
            <input type="hidden" name="products[0][id]" class="product-id-input">
            <input type="hidden" name="products[0][quantity]" class="product-quantity-input" value="1">
        </div>
    </template>

    <script>
    let productIndex = 0;
    const products = @json($products);

    function searchProducts() {
        const query = document.getElementById('product-search').value.toLowerCase();
        const results = document.getElementById('product-results');
        
        if (query.length < 2) {
            results.innerHTML = '';
            return;
        }

        const filtered = products.filter(product => 
            product.name.toLowerCase().includes(query) || 
            (product.sku && product.sku.toLowerCase().includes(query))
        );

        results.innerHTML = filtered.map(product => `
            <div class="p-2 border rounded hover:bg-gray-50 cursor-pointer" onclick="selectProduct(${product.id})">
                <div class="flex items-center space-x-2">
                    <img src="${product.images && product.images[0] ? product.images[0] : '/images/placeholder.png'}" 
                         class="w-8 h-8 object-cover rounded" alt="${product.name}">
                    <div class="flex-1">
                        <p class="font-medium text-sm">${product.name}</p>
                        <p class="text-xs text-gray-500">${product.formatted_price || product.price + ' FCFA'} • Stock: ${product.stock_quantity}</p>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function selectProduct(productId) {
        const product = products.find(p => p.id == productId);
        if (!product) return;

        // Vérifier si le produit n'est pas déjà ajouté
        if (document.querySelector(`[data-product-id="${productId}"]`)) {
            alert('Ce produit est déjà dans la commande');
            return;
        }

        addProductToList(product);
        document.getElementById('product-search').value = '';
        document.getElementById('product-results').innerHTML = '';
    }

    function addProduct() {
        // Afficher la recherche de produits
        document.getElementById('product-search').focus();
    }

    function addProductToList(product) {
        const template = document.getElementById('product-template');
        const clone = template.content.cloneNode(true);
        
        // Remplir les données
        clone.querySelector('.product-item').dataset.productId = product.id;
        clone.querySelector('.product-image').src = product.images && product.images[0] ? product.images[0] : '/images/placeholder.png';
        clone.querySelector('.product-name').textContent = product.name;
        clone.querySelector('.product-price').textContent = (product.formatted_price || product.price + ' FCFA');
        clone.querySelector('.product-stock').textContent = `Stock: ${product.stock_quantity}`;
        clone.querySelector('.product-id-input').name = `products[${productIndex}][id]`;
        clone.querySelector('.product-id-input').value = product.id;
        clone.querySelector('.product-quantity-input').name = `products[${productIndex}][quantity]`;
        
        const productsList = document.getElementById('products-list');
        const noProducts = document.getElementById('no-products');
        
        if (noProducts) noProducts.remove();
        productsList.appendChild(clone);
        
        productIndex++;
        updateTotals();
        updateSubmitButton();
    }

    function removeProduct(button) {
        button.closest('.product-item').remove();
        updateTotals();
        updateSubmitButton();
        
        if (document.querySelectorAll('.product-item').length === 0) {
            document.getElementById('products-list').innerHTML = `
                <div class="text-center py-8 text-gray-500" id="no-products">
                    <i class="fas fa-box-open text-4xl mb-4"></i>
                    <p>Aucun produit sélectionné</p>
                    <p class="text-sm">Cliquez sur "Ajouter un produit" pour commencer</p>
                </div>
            `;
        }
    }

    function increaseQuantity(button) {
        const input = button.previousElementSibling;
        const product = products.find(p => p.id == button.closest('.product-item').dataset.productId);
        const newValue = parseInt(input.value) + 1;
        
        if (newValue <= product.stock_quantity) {
            input.value = newValue;
            input.closest('.product-item').querySelector('.product-quantity-input').value = newValue;
            updateTotals();
        } else {
            alert('Stock insuffisant');
        }
    }

    function decreaseQuantity(button) {
        const input = button.nextElementSibling;
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            input.closest('.product-item').querySelector('.product-quantity-input').value = input.value;
            updateTotals();
        }
    }

    function updateTotals() {
        let subtotal = 0;
        
        document.querySelectorAll('.product-item').forEach(item => {
            const productId = item.dataset.productId;
            const product = products.find(p => p.id == productId);
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            const price = product.final_price || product.price;
            
            subtotal += price * quantity;
        });
        
        const shipping = parseFloat(document.querySelector('input[name="shipping_fee"]').value) || 0;
        const total = subtotal + shipping;
        
        document.getElementById('subtotal').textContent = new Intl.NumberFormat('fr-FR').format(subtotal) + ' FCFA';
        document.getElementById('shipping-display').textContent = new Intl.NumberFormat('fr-FR').format(shipping) + ' FCFA';
        document.getElementById('total').textContent = new Intl.NumberFormat('fr-FR').format(total) + ' FCFA';
    }

    function updateSubmitButton() {
        const submitBtn = document.getElementById('submitBtn');
        const hasProducts = document.querySelectorAll('.product-item').length > 0;
        submitBtn.disabled = !hasProducts;
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        updateSubmitButton();
    });
    </script>
@endsection
