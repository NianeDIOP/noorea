<!-- Navbar Harmonisée pour toutes les pages -->
<header class="sticky top-0 z-50">
    <!-- Navbar Supérieur -->
    <div class="bg-white/95 backdrop-blur-sm border-b border-noorea-gold/20 py-2">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center group">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Noorea Beauty" class="h-8 w-auto">
                    <span class="ml-2 text-noorea-dark font-serif text-xl font-semibold group-hover:text-noorea-gold transition-colors duration-300">
                        Noorea
                    </span>
                </a>

                <!-- Barre de recherche centrale -->
                <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                    <form class="w-full relative" action="{{ route('products') }}" method="GET">
                        <input 
                            type="search" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher des produits, marques, catégories..." 
                            class="w-full px-4 py-2 pr-12 rounded-full border border-noorea-gold/30 focus:outline-none focus:ring-2 focus:ring-noorea-gold/50 focus:border-noorea-gold bg-white/90 backdrop-blur-sm text-noorea-dark placeholder-noorea-dark/60"
                        >
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-noorea-gold hover:text-noorea-emerald transition-colors duration-300">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Actions utilisateur -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('account.dashboard') }}" class="navbar-icon-top" title="Mon compte">
                        <i class="fas fa-user"></i>
                    </a>
                    <a href="{{ route('wishlist') }}" class="navbar-icon-top relative" title="Ma wishlist">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="{{ route('cart') }}" class="navbar-icon-top relative" title="Mon panier">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="absolute -top-1 -right-1 bg-noorea-rose-gold text-white text-xs rounded-full w-4 h-4 flex items-center justify-center text-[10px] cart-count">0</span>
                    </a>
                    <button type="button" class="navbar-icon-top md:hidden" id="mobile-menu-button" aria-label="Menu">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Barre de navigation inférieure -->
    <div class="backdrop-blur-sm border-t border-noorea-gold/20" style="background-color: #F7EAD5;">
        <div class="container mx-auto px-4">
            <!-- Navigation principale - desktop -->
            <nav class="hidden md:flex items-center justify-center py-3">
                <div class="flex space-x-8">
                    <a href="{{ route('home') }}" class="nav-link-gold {{ request()->routeIs('home') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                    <a href="{{ route('products') }}" class="nav-link-gold {{ request()->routeIs('products*') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-shopping-bag mr-2"></i>Boutique
                    </a>
                    <a href="{{ route('categories') }}" class="nav-link-gold {{ request()->routeIs('categories*') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-th-large mr-2"></i>Catégories
                    </a>
                    <a href="{{ route('brands') }}" class="nav-link-gold {{ request()->routeIs('brands*') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-crown mr-2"></i>Marques
                    </a>
                    <a href="{{ route('blog') }}" class="nav-link-gold {{ request()->routeIs('blog*') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-feather-alt mr-2"></i>Magazine Beauté
                    </a>
                    <a href="{{ route('about') }}" class="nav-link-gold {{ request()->routeIs('about*') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>À propos
                    </a>
                </div>
            </nav>

            <!-- Menu mobile -->
            <div id="mobile-menu" class="md:hidden hidden bg-white/95 backdrop-blur-sm rounded-b-2xl shadow-xl border-t border-noorea-gold/20 mt-1">
                <div class="py-4 space-y-2">
                    <!-- Recherche mobile -->
                    <div class="px-4 pb-4 border-b border-noorea-gold/20">
                        <form action="{{ route('products') }}" method="GET" class="relative">
                            <input 
                                type="search" 
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Rechercher..." 
                                class="w-full px-4 py-2 pr-10 rounded-full border border-noorea-gold/30 focus:outline-none focus:ring-2 focus:ring-noorea-gold/50 text-sm"
                            >
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-noorea-gold">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <!-- Liens navigation -->
                    <a href="{{ route('home') }}" class="nav-link-mobile {{ request()->routeIs('home') ? 'active-mobile' : '' }}">
                        <i class="fas fa-home mr-3 w-5"></i>Accueil
                    </a>
                    <a href="{{ route('products') }}" class="nav-link-mobile {{ request()->routeIs('products*') ? 'active-mobile' : '' }}">
                        <i class="fas fa-shopping-bag mr-3 w-5"></i>Boutique
                    </a>
                    <a href="{{ route('categories') }}" class="nav-link-mobile {{ request()->routeIs('categories*') ? 'active-mobile' : '' }}">
                        <i class="fas fa-th-large mr-3 w-5"></i>Catégories
                    </a>
                    <a href="{{ route('brands') }}" class="nav-link-mobile {{ request()->routeIs('brands*') ? 'active-mobile' : '' }}">
                        <i class="fas fa-crown mr-3 w-5"></i>Marques
                    </a>
                    <a href="{{ route('blog') }}" class="nav-link-mobile {{ request()->routeIs('blog*') ? 'active-mobile' : '' }}">
                        <i class="fas fa-feather-alt mr-3 w-5"></i>Magazine Beauté
                    </a>
                    <a href="{{ route('about') }}" class="nav-link-mobile {{ request()->routeIs('about*') ? 'active-mobile' : '' }}">
                        <i class="fas fa-info-circle mr-3 w-5"></i>À propos
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
/* Styles pour la navbar unifiée */
.navbar-icon-top {
    @apply text-noorea-dark hover:text-noorea-gold transition-colors duration-300 p-2 rounded-lg hover:bg-noorea-cream/30;
}

.nav-link-gold {
    @apply text-noorea-dark hover:text-noorea-gold transition-all duration-300 px-4 py-2 rounded-lg relative font-medium;
}

.nav-link-gold.active-gold {
    @apply text-noorea-gold bg-noorea-gold/10;
}

.nav-link-mobile {
    @apply block px-4 py-3 text-noorea-dark hover:text-noorea-gold hover:bg-noorea-cream/50 transition-all duration-300 flex items-center;
}

.nav-link-mobile.active-mobile {
    @apply text-noorea-gold bg-noorea-gold/10;
}
</style>

<script>
// Script pour le menu mobile
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            
            // Animation de l'icône
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });
        
        // Fermer le menu quand on clique en dehors
        document.addEventListener('click', function(e) {
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
                const icon = mobileMenuButton.querySelector('i');
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-times');
            }
        });
    }
});
</script>
