<!-- Bouton WhatsApp flottant élégant -->
<div class="fixed bottom-6 right-6 z-50 group">
    <!-- Bouton principal avec style Noorea -->
    <a href="https://wa.me/221781029818?text=Bonjour%20Noorea%21%20J'ai%20besoin%20d'aide%20pour%20choisir%20des%20produits%20cosmétiques.%20Pouvez-vous%20me%20conseiller%20%3F" 
       target="_blank"
       class="bg-noorea-dark hover:bg-gray-800 text-white w-14 h-14 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center justify-center text-lg hover:scale-110 border-2 border-noorea-gold/30 hover:border-noorea-gold">
        <i class="fab fa-whatsapp text-green-400"></i>
    </a>
    
    <!-- Tooltip élégant -->
    <div class="absolute right-16 top-1/2 transform -translate-y-1/2 bg-noorea-dark text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none shadow-lg border border-noorea-gold/20">
        Contactez-nous sur WhatsApp
        <div class="absolute top-1/2 right-0 transform translate-x-full -translate-y-1/2 w-0 h-0 border-l-4 border-l-noorea-dark border-t-4 border-t-transparent border-b-4 border-b-transparent"></div>
    </div>
    
    <!-- Petit point d'animation -->
    <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full animate-pulse"></div>
</div>

<!-- Notification badge (optionnel) -->
<div class="fixed bottom-24 right-6 z-40 bg-noorea-gold text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg animate-bounce" id="whatsapp-notification" style="display: none;">
    Nouveau message !
</div>

<script>
// Animation d'apparition du bouton
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        const notification = document.getElementById('whatsapp-notification');
        if (notification) {
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 5000);
        }
    }, 3000);
});

// Tracking des clics WhatsApp (optionnel)
document.querySelector('[href*="wa.me"]').addEventListener('click', function() {
    // Vous pouvez ajouter ici du tracking analytics
    console.log('Clic WhatsApp depuis:', window.location.pathname);
});
</script>

<style>
/* Animation personnalisée pour le bouton */
@keyframes whatsapp-bounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.animate-whatsapp {
    animation: whatsapp-bounce 2s infinite;
}

/* Responsive mobile */
@media (max-width: 768px) {
    .fixed.bottom-6.right-6 {
        bottom: 1rem;
        right: 1rem;
    }
    
    .fixed.bottom-6.right-6 a {
        width: 56px;
        height: 56px;
        font-size: 1.5rem;
    }
}
</style>
<?php /**PATH C:\xampp\htdocs\noorea\resources\views/components/whatsapp-float.blade.php ENDPATH**/ ?>