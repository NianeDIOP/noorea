/**
 * Noorea Cart Management Module
 * Module JavaScript pour gérer les fonctionnalités du panier sur toutes les vues
 */

// État global du panier
window.NooreaCart = {
    items: {},
    
    // CSRF Token pour les requêtes AJAX
    getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
               document.querySelector('input[name="_token"]')?.value;
    },
    
    // Charger le panier existant depuis le serveur
    async loadExistingCart() {
        try {
            const response = await fetch('/panier/contenu', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                }
            });
            
            if (response.ok) {
                const data = await response.json();
                // Adapter les données du serveur au format local
                if (data.cart) {
                    Object.entries(data.cart).forEach(([productId, item]) => {
                        this.items[productId] = {
                            id: productId,
                            name: item.name,
                            price: item.price,
                            image: item.image || item.main_image,
                            quantity: item.quantity
                        };
                    });
                    this.updateCartCount();
                    this.updateCartDisplay();
                }
            }
        } catch (error) {
            console.error('Erreur lors du chargement du panier:', error);
        }
    },
    
    // Mettre à jour l'affichage du compteur du panier
    updateCartCount() {
        let totalItems = 0;
        Object.values(this.items).forEach(item => {
            totalItems += item.quantity;
        });
        
        // Mettre à jour l'icône du panier avec le nombre d'articles
        const cartCountElement = document.getElementById('cart-count');
        if (cartCountElement) {
            cartCountElement.textContent = totalItems;
            cartCountElement.style.display = totalItems > 0 ? 'flex' : 'none';
        }
    },
    
    // Formater le prix avec séparateur de milliers
    formatPrice(price) {
        return new Intl.NumberFormat('fr-FR').format(price) + ' FCFA';
    },
    
    // Calculer le total du panier
    calculateTotal() {
        return Object.values(this.items).reduce((total, item) => {
            return total + (parseFloat(item.price) * item.quantity);
        }, 0);
    },
    
    // Mettre à jour l'affichage du mini-panier
    updateCartDisplay() {
        const cartItems = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');
        const cartFooter = document.getElementById('cart-footer');
        const emptyCart = document.getElementById('empty-cart');
        
        if (!cartItems || !cartTotal || !cartFooter || !emptyCart) {
            return; // La page n'a pas les éléments du mini-panier
        }
        
        const totalItems = Object.values(this.items).reduce((count, item) => count + item.quantity, 0);
        const total = this.calculateTotal();
        
        if (Object.keys(this.items).length === 0) {
            emptyCart.classList.remove('hidden');
            cartFooter.classList.add('hidden');
            cartItems.innerHTML = '';
        } else {
            emptyCart.classList.add('hidden');
            cartFooter.classList.remove('hidden');
            
            // Générer le HTML pour chaque article
            let html = '';
            Object.values(this.items).forEach(item => {
                html += `
                <div class="mini-cart-item flex items-center space-x-3 mb-4 bg-gray-50 p-3 rounded-lg" data-product-id="${item.id}">
                    <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-cover rounded" 
                         onerror="this.src='/images/logo.png'; console.log('Image error for:', '${item.image}');">
                    <div class="flex-1">
                        <h4 class="font-medium text-sm line-clamp-1">${item.name}</h4>
                        <p class="text-xs text-gray-600">${this.formatPrice(item.price)}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <button type="button" class="qty-btn w-6 h-6 bg-gray-200 text-gray-700 rounded-full flex items-center justify-center text-xs hover:bg-gray-300" 
                                    data-action="decrease" data-product-id="${item.id}">
                                <span class="flex items-center justify-center">-</span>
                            </button>
                            <span class="quantity-display text-sm font-medium">${item.quantity}</span>
                            <button type="button" class="qty-btn w-6 h-6 bg-noorea-gold text-white rounded-full flex items-center justify-center text-xs hover:bg-yellow-600" 
                                    data-action="increase" data-product-id="${item.id}">
                                <span class="flex items-center justify-center">+</span>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="remove-item w-8 h-8 flex items-center justify-center text-red-500 hover:text-red-700 hover:bg-red-50 rounded-full transition-colors" data-product-id="${item.id}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>`;
            });
            
            cartItems.innerHTML = html;
            cartTotal.textContent = this.formatPrice(total);
        }
    },
    
    // Ajouter un article au panier
    async addToCart(productId, productName, productPrice, productImage, quantity = 1) {
        try {
            const response = await fetch('/panier/ajouter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            });
            
            if (response.ok) {
                const data = await response.json();
                
                // Mettre à jour le panier local
                if (this.items[productId]) {
                    this.items[productId].quantity += parseInt(quantity);
                } else {
                    this.items[productId] = {
                        id: productId,
                        name: productName,
                        price: productPrice,
                        image: productImage,
                        quantity: parseInt(quantity)
                    };
                }
                
                // Mettre à jour les affichages
                this.updateCartCount();
                this.updateCartDisplay();
                
                // Afficher un feedback visuel
                const btn = document.querySelector(`[data-product-id="${productId}"]`) || 
                           document.querySelector('.bg-noorea-gold.flex-1');
                if (btn) {
                    btn.classList.add('animate-pulse');
                    setTimeout(() => {
                        btn.classList.remove('animate-pulse');
                    }, 1000);
                }
                
                // Toujours ouvrir le mini-panier après ajout
                this.openMiniCart();
                
                // Afficher une notification visuelle
                console.log('Produit ajouté au panier:', productName);
                
                return true;
            } else {
                const error = await response.json();
                console.error('Erreur lors de l\'ajout au panier:', error);
                return false;
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
            return false;
        }
    },
    
    // Mettre à jour la quantité d'un article
    async updateCartItem(productId, newQuantity) {
        try {
            console.log(`Mise à jour du produit ${productId} avec quantité ${newQuantity}`);
            const response = await fetch(`/panier/mettre-a-jour`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    productId: productId,
                    quantity: newQuantity
                })
            });
            
            if (response.ok) {
                const data = await response.json();
                
                if (data.success) {
                    // Mettre à jour le panier local
                    if (this.items[productId]) {
                        this.items[productId].quantity = parseInt(newQuantity);
                    }
                    
                    // Mettre à jour les affichages
                    this.updateCartCount();
                    this.updateCartDisplay();
                    
                    return true;
                }
            }
            
            return false;
        } catch (error) {
            console.error('Erreur lors de la mise à jour:', error);
            return false;
        }
    },
    
    // Supprimer un article du panier
    async removeFromCart(productId) {
        try {
            console.log(`Suppression du produit ${productId} du panier`);
            const response = await fetch(`/panier/retirer`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken(),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    productId: productId
                })
            });
            
            if (response.ok) {
                const data = await response.json();
                
                if (data.success) {
                    // Mettre à jour le panier local
                    delete this.items[productId];
                    
                    // Mettre à jour les affichages
                    this.updateCartCount();
                    this.updateCartDisplay();
                    
                    return true;
                }
            }
            
            return false;
        } catch (error) {
            console.error('Erreur lors de la suppression:', error);
            return false;
        }
    },
    
    // Ouvrir le mini-panier
    openMiniCart() {
        const miniCart = document.getElementById('mini-cart');
        
        if (miniCart) {
            console.log('Ouverture du mini-panier');
            miniCart.classList.remove('translate-x-full');
            
            // Overlay temporairement désactivé
            // const cartOverlay = document.getElementById('cart-overlay');
            // if (cartOverlay) {
            //     console.log('Affichage de l\'overlay');
            //     cartOverlay.classList.remove('hidden');
            // }
        } else {
            console.error('Élément mini-cart non trouvé dans le DOM!');
        }
    },
    
    // Fermer le mini-panier
    closeMiniCart() {
        const miniCart = document.getElementById('mini-cart');
        
        if (miniCart) {
            miniCart.classList.add('translate-x-full');
            
            // Overlay temporairement désactivé
            // const cartOverlay = document.getElementById('cart-overlay');
            // if (cartOverlay) {
            //     setTimeout(() => {
            //         cartOverlay.classList.add('hidden');
            //     }, 300);
            // }
        }
    },
    
    // Basculer l'affichage du mini-panier
    toggleMiniCart() {
        const miniCart = document.getElementById('mini-cart');
        
        if (miniCart) {
            if (miniCart.classList.contains('translate-x-full')) {
                this.openMiniCart();
            } else {
                this.closeMiniCart();
            }
        }
    },
    
    // Initialiser les écouteurs d'événements pour le panier
    initCartEventListeners() {
        // Écouteur pour fermer le mini-panier
        const closeCart = document.getElementById('close-cart');
        if (closeCart) {
            // Assurons-nous qu'il n'y a qu'un seul écouteur
            const newCloseCart = closeCart.cloneNode(true);
            closeCart.parentNode.replaceChild(newCloseCart, closeCart);
            newCloseCart.addEventListener('click', () => {
                console.log('Bouton fermeture cliqué');
                this.closeMiniCart();
            });
        } else {
            console.warn('Bouton de fermeture du panier non trouvé');
        }
        
        // Écouteur pour l'overlay du mini-panier (temporairement désactivé)
        // const cartOverlay = document.getElementById('cart-overlay');
        // if (cartOverlay) {
        //     // Assurons-nous qu'il n'y a qu'un seul écouteur
        //     const newCartOverlay = cartOverlay.cloneNode(true);
        //     cartOverlay.parentNode.replaceChild(newCartOverlay, cartOverlay);
        //     newCartOverlay.addEventListener('click', () => {
        //         console.log('Overlay cliqué');
        //         this.closeMiniCart();
        //     });
        // } else {
        //     console.warn('Overlay du panier non trouvé');
        // }
        
        // Écouteurs pour les boutons "Ajouter au panier"
        const addToCartBtns = document.querySelectorAll('.add-to-cart-btn');
        console.log('Boutons "Ajouter au panier" trouvés:', addToCartBtns.length);
        addToCartBtns.forEach(btn => {
            // Assurons-nous qu'il n'y a qu'un seul écouteur
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);
            
            newBtn.addEventListener('click', () => {
                const productId = newBtn.getAttribute('data-product-id');
                const productName = newBtn.getAttribute('data-product-name');
                const productPrice = newBtn.getAttribute('data-product-price');
                const productImage = newBtn.getAttribute('data-product-image');
                
                console.log('Ajout au panier:', productId, productName);
                this.addToCart(productId, productName, productPrice, productImage);
            });
        });
        
        // Délégation d'événements pour les boutons du mini-panier
        const cartItems = document.getElementById('cart-items');
        if (cartItems) {
            console.log('Container cart-items trouvé');
            
            // Configurer les gestionnaires d'événements initiaux
            this.setupCartItemsEventListeners();
            
            // Observer les changements dans le DOM pour réattacher les gestionnaires si nécessaire
            if (!this._observer) {
                this._observer = new MutationObserver(() => {
                    console.log('Mutation détectée dans le mini-panier, reconfiguration des écouteurs');
                    this.setupCartItemsEventListeners();
                });
                
                // Observer les changements dans le contenu du mini-panier
                this._observer.observe(cartItems, { 
                    childList: true,  // Observer les ajouts/suppressions d'enfants
                    subtree: true,    // Observer toute la sous-arborescence
                    attributes: true  // Observer les changements d'attributs
                });
            }
        } else {
            console.warn('Container cart-items non trouvé');
        }
    },
    
    // Configurer les écouteurs d'événements pour les boutons du mini-panier avec délégation d'événements
    setupCartItemsEventListeners() {
        console.log('Configuration des écouteurs d\'événements pour le mini-panier');
        
        // Utilisons un seul écouteur avec délégation d'événements pour tous les boutons du panier
        const cartItemsContainer = document.getElementById('cart-items');
        
        if (!cartItemsContainer) {
            console.error('Container cart-items non trouvé!');
            return;
        }
        
        // Supprimer l'écouteur existant s'il existe
        if (this._cartItemsClickHandler) {
            cartItemsContainer.removeEventListener('click', this._cartItemsClickHandler);
        }
        
        // Créer un nouvel écouteur pour tous les clics à l'intérieur du container
        this._cartItemsClickHandler = (e) => {
            // Pour les boutons +
            if (e.target.closest('.qty-btn[data-action="increase"]')) {
                const btn = e.target.closest('.qty-btn[data-action="increase"]');
                const productId = btn.getAttribute('data-product-id');
                const currentQuantity = this.items[productId]?.quantity || 1;
                console.log('Bouton + cliqué pour', productId, 'quantité actuelle:', currentQuantity);
                this.updateCartItem(productId, currentQuantity + 1);
            } 
            // Pour les boutons -
            else if (e.target.closest('.qty-btn[data-action="decrease"]')) {
                const btn = e.target.closest('.qty-btn[data-action="decrease"]');
                const productId = btn.getAttribute('data-product-id');
                const currentQuantity = this.items[productId]?.quantity || 1;
                console.log('Bouton - cliqué pour', productId, 'quantité actuelle:', currentQuantity);
                
                if (currentQuantity > 1) {
                    this.updateCartItem(productId, currentQuantity - 1);
                } else {
                    this.removeFromCart(productId);
                }
            }
            // Pour les boutons de suppression
            else if (e.target.closest('.remove-item')) {
                const btn = e.target.closest('.remove-item');
                const productId = btn.getAttribute('data-product-id');
                console.log('Bouton supprimer cliqué pour', productId);
                this.removeFromCart(productId);
            }
        };
        
        // Ajouter l'écouteur au container
        cartItemsContainer.addEventListener('click', this._cartItemsClickHandler);
        console.log('Écouteur d\'événements configuré pour le mini-panier');
        
        // Vérifions quels éléments sont actuellement dans le DOM
        const increaseButtons = document.querySelectorAll('.qty-btn[data-action="increase"]');
        const decreaseButtons = document.querySelectorAll('.qty-btn[data-action="decrease"]');
        const removeButtons = document.querySelectorAll('.remove-item');
        
        console.log('Boutons trouvés dans le DOM:',  
            'Augmenter:', increaseButtons.length,
            'Diminuer:', decreaseButtons.length,
            'Supprimer:', removeButtons.length
        );
    },
        
    // Gestion du bouton WhatsApp
    handleWhatsAppOrder() {
        const whatsappBtn = document.getElementById('mini-whatsapp-order');
        if (whatsappBtn) {
            whatsappBtn.addEventListener('click', () => {
                if (Object.keys(this.items).length === 0) {
                    alert('Votre panier est vide !');
                    return;
                }
                
                // Construire le message de commande
                let message = "🛒 *Nouvelle commande Noorea Beauty*\\n\\n";
                message += "📋 *Détails de la commande :*\\n";
                
                let total = 0;
                Object.values(this.items).forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    message += `• ${item.name} (${item.quantity}x) - ${this.formatPrice(itemTotal)}\\n`;
                });
                
                message += `\\n💰 *Total estimé :* ${this.formatPrice(total)}`;
                message += "\\n\\n📍 *Informations de livraison :*\\n";
                message += "- Nom complet : \\n";
                message += "- Téléphone : \\n";
                message += "- Adresse complète : \\n";
                message += "- Commune/Ville : \\n";
                
                message += "\\n\\n✨ *Merci de choisir Noorea Beauty !*";
                
                // Numéro WhatsApp de Noorea 
                const whatsappNumber = "221781029818";
                const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
                
                window.open(whatsappUrl, '_blank');
            });
        }
    },
    
    // Initialisation du module panier
    init() {
        // Charger le panier existant
        this.loadExistingCart();
        
        // Initialiser les écouteurs d'événements
        this.initCartEventListeners();
        
        // Initialiser la gestion du bouton WhatsApp
        this.handleWhatsAppOrder();
        
        // Exposer la fonction toggleMiniCart globalement pour les appels extérieurs
        window.toggleMiniCart = () => {
            console.log('toggleMiniCart appelé globalement');
            this.toggleMiniCart();
        };
        
        // Ajouter un écouteur global pour TOUS les boutons du panier dans la navbar (qu'ils utilisent onclick ou non)
        this.setupNavbarCartButtons();
        
        console.log('Module panier Noorea initialisé');
    },
    
    // Configurer tous les boutons du panier dans la navbar
    setupNavbarCartButtons() {
        // Chercher d'abord le bouton avec l'ID spécifique
        const navbarCartButton = document.getElementById('navbar-cart-button');
        
        if (navbarCartButton) {
            console.log('Bouton du panier avec ID trouvé');
            
            // Supprimer l'attribut onclick s'il existe
            if (navbarCartButton.hasAttribute('onclick')) {
                navbarCartButton.removeAttribute('onclick');
                console.log('Attribut onclick supprimé');
            }
            
            // Créer un nouveau bouton en clonant l'original pour supprimer tous les anciens écouteurs
            const newNavbarCartButton = navbarCartButton.cloneNode(true);
            
            // S'assurer que tous les attributs sont conservés
            Array.from(navbarCartButton.attributes).forEach(attr => {
                if (attr.name !== 'onclick') { // Exclure onclick
                    newNavbarCartButton.setAttribute(attr.name, attr.value);
                }
            });
            
            // Remplacer l'ancien bouton
            navbarCartButton.parentNode.replaceChild(newNavbarCartButton, navbarCartButton);
            
            // Ajouter le nouvel écouteur d'événements
            newNavbarCartButton.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                console.log('Bouton panier navbar avec ID cliqué via cart.js');
                this.toggleMiniCart();
            });
            
            console.log('Écouteur d\'événement configuré pour le bouton navbar');
        } else {
            console.log('Bouton avec ID non trouvé, recherche par attributs');
            
            // Chercher tous les boutons du panier dans la navbar par leurs attributs
            const navbarCartButtons = document.querySelectorAll('button[title="Mon panier"], .navbar-icon-top[title="Mon panier"]');
            console.log('Boutons du panier trouvés par attributs:', navbarCartButtons.length);
            
            navbarCartButtons.forEach(btn => {
                // Retirer d'abord tout gestionnaire existant et l'attribut onclick
                if (btn.hasAttribute('onclick')) {
                    btn.removeAttribute('onclick');
                }
                
                // Cloner et remplacer pour supprimer les anciens écouteurs d'événements
                const newBtn = btn.cloneNode(true);
                btn.parentNode.replaceChild(newBtn, btn);
                
                // Ajouter le nouvel écouteur d'événements
                newBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Bouton panier navbar cliqué via écouteur secondaire');
                    this.toggleMiniCart();
                });
            });
        }
    }
};

// Initialisation automatique quand le DOM est chargé
document.addEventListener('DOMContentLoaded', () => {
    window.NooreaCart.init();
});
