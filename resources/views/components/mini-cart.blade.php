<!-- Mini-panier (popup) -->
<div id="mini-cart" class="fixed top-0 right-0 w-80 h-full bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="flex flex-col h-full">
        <!-- Header du mini-panier -->
        <div class="bg-noorea-gold text-white p-4 flex justify-between items-center">
            <h3 class="text-lg font-bold">Mon Panier</h3>
            <button id="close-cart" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Contenu du panier -->
        <div id="cart-content" class="flex-1 overflow-y-auto p-4">
            <div id="empty-cart" class="text-center py-8">
                <i class="fas fa-shopping-cart text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Votre panier est vide</p>
            </div>
            
            <!-- Les articles du panier seront ajoutés ici dynamiquement -->
            <div id="cart-items"></div>
        </div>
        
        <!-- Footer du mini-panier -->
        <div id="cart-footer" class="border-t p-4 hidden">
            <div class="mb-4">
                <div class="flex justify-between items-center text-lg font-bold">
                    <span>Total:</span>
                    <span id="cart-total">0 FCFA</span>
                </div>
            </div>
            <div class="space-y-2">
                <a href="{{ route('cart') }}" class="block w-full bg-noorea-gold text-white py-2 rounded-lg hover:bg-yellow-600 transition-colors text-center">
                    Voir le panier complet
                </a>
                <button id="mini-whatsapp-order" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition-colors flex items-center justify-center space-x-2">
                    <i class="fab fa-whatsapp text-sm"></i>
                    <span>Commander maintenant</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Overlay désactivé temporairement pour tests -->
<!-- <div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-10 z-40 hidden transition-opacity duration-300"></div> -->
