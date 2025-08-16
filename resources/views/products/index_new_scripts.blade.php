@push('scripts')
<script>
// Code JavaScript complètement réécrit pour le filtrage
document.addEventListener('DOMContentLoaded', function() {
    console.log('Vue Boutique chargée');
    
    // Éléments du DOM
    const categoryFilter = document.getElementById('category-filter');
    const brandFilter = document.getElementById('brand-filter');
    const priceFilter = document.getElementById('price-filter');
    const applyFiltersBtn = document.getElementById('apply-filters');
    const productCards = document.querySelectorAll('.product-card');
    const resultsCount = document.getElementById('count-number');
    const noResults = document.getElementById('no-results');
    const productsGrid = document.getElementById('products-grid');
    
    // Fonction pour appliquer les filtres
    function applyFilters() {
        // Récupérer les valeurs sélectionnées
        const category = categoryFilter.value;
        const brand = brandFilter.value;
        const price = priceFilter.value;
        
        alert("Filtrage en cours...");
        console.log("Filtrage avec:", {category, brand, price});
        
        // Compteur pour les produits visibles
        let visibleCount = 0;
        
        // Parcourir chaque carte produit
        productCards.forEach(function(card) {
            // Récupérer les attributs
            const cardCategory = card.getAttribute('data-category') || '';
            const cardBrand = card.getAttribute('data-brand') || '';
            const cardPrice = parseFloat(card.getAttribute('data-price') || '0');
            
            // Par défaut, montrer le produit
            let showProduct = true;
            
            // Filtrer par catégorie si nécessaire
            if (category !== 'all' && cardCategory !== category) {
                showProduct = false;
            }
            
            // Filtrer par marque si nécessaire
            if (showProduct && brand !== 'all' && cardBrand !== brand) {
                showProduct = false;
            }
            
            // Filtrer par prix si nécessaire
            if (showProduct && price !== 'all') {
                let minPrice = 0;
                let maxPrice = Infinity;
                
                if (price === '0-15000') {
                    maxPrice = 15000;
                } else if (price === '15000-30000') {
                    minPrice = 15000;
                    maxPrice = 30000;
                } else if (price === '30000-60000') {
                    minPrice = 30000;
                    maxPrice = 60000;
                } else if (price === '60000+') {
                    minPrice = 60000;
                }
                
                if (cardPrice < minPrice || cardPrice > maxPrice) {
                    showProduct = false;
                }
            }
            
            // Afficher ou masquer la carte
            if (showProduct) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Mettre à jour le compteur
        resultsCount.textContent = visibleCount;
        
        // Afficher/masquer le message "Aucun résultat"
        if (visibleCount === 0) {
            productsGrid.style.display = 'none';
            noResults.classList.remove('hidden');
        } else {
            productsGrid.style.display = 'grid';
            noResults.classList.add('hidden');
        }
        
        alert(`${visibleCount} produit(s) trouvé(s).`);
    }
    
    // Attacher l'événement au bouton
    if (applyFiltersBtn) {
        // Retirer tout gestionnaire existant
        const newBtn = applyFiltersBtn.cloneNode(true);
        applyFiltersBtn.parentNode.replaceChild(newBtn, applyFiltersBtn);
        
        // Ajouter le nouveau gestionnaire
        newBtn.addEventListener('click', function(e) {
            e.preventDefault();
            applyFilters();
        });
    } else {
        console.error('Bouton de filtrage introuvable');
    }
    
    // Afficher des informations de débogage
    console.log('Éléments de filtrage :', {
        'Catégories': categoryFilter ? 'OK' : 'MANQUANT',
        'Marques': brandFilter ? 'OK' : 'MANQUANT',
        'Prix': priceFilter ? 'OK' : 'MANQUANT',
        'Bouton': applyFiltersBtn ? 'OK' : 'MANQUANT',
        'Produits': productCards.length
    });
});
</script>
@endpush
