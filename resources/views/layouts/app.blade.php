<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Noorea - Boutique de cosmétiques et parfums multiculturels premium au Sénégal">
    
    <title>{{ isset($title) ? $title . ' | ' : '' }}Noorea - L'expérience beauté multiculturelle</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/noorea.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<body class="antialiased">
    @yield('navbar')

    <main>
        @yield('content')
    </main>

    <footer class="bg-noorea-dark text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Logo et à propos -->
                <div>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Noorea" class="h-12 w-auto">
                        <div class="ml-3">
                            <div class="text-2xl font-serif font-semibold text-noorea-gold">Noorea</div>
                            <div class="text-sm text-noorea-gold/80 italic font-light">Révélez votre lumière</div>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">Votre destination beauté multiculturelle au Sénégal. Des produits de qualité issus de différentes traditions pour une beauté unique.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-noorea-gold transition-colors" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-white hover:text-noorea-gold transition-colors" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-white hover:text-noorea-gold transition-colors" aria-label="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="#" class="text-white hover:text-noorea-gold transition-colors" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Liens rapides -->
                <div>
                    <h3 class="text-xl font-serif mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">Accueil</a></li>
                        <li><a href="{{ route('products') }}" class="text-gray-300 hover:text-white transition-colors">Boutique</a></li>
                        <li><a href="{{ route('blog') }}" class="text-gray-300 hover:text-white transition-colors">Blog Beauté</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors">À propos</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Catégories -->
                <div>
                    <h3 class="text-xl font-serif mb-4">Catégories</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Soins visage</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Maquillage</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Parfums</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Soins capillaires</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Bien-être</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="text-xl font-serif mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-noorea-gold"></i>
                            <span class="text-gray-300">123 Avenue de la Beauté, Dakar, Sénégal</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-noorea-gold"></i>
                            <span class="text-gray-300">+221 76 123 45 67</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-noorea-gold"></i>
                            <span class="text-gray-300">contact@noorea.sn</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="divider-gold mx-auto w-1/2 my-10"></div>
            
            <!-- Bas de page -->
            <div class="text-center text-gray-400 text-sm">
                <p class="text-noorea-gold/60 italic mb-2">"Révélez votre lumière"</p>
                <p>&copy; {{ date('Y') }} Noorea. Tous droits réservés.</p>
                <div class="flex justify-center mt-2 space-x-4">
                    <a href="#" class="hover:text-white transition-colors">Mentions légales</a>
                    <a href="#" class="hover:text-white transition-colors">Politique de confidentialité</a>
                    <a href="#" class="hover:text-white transition-colors">CGV</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modals, si nécessaire -->
    <div id="search-modal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-serif text-noorea-dark">Rechercher</h3>
                <button type="button" id="close-search" class="text-noorea-dark hover:text-noorea-emerald">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('search') }}" method="GET">
                <div class="relative">
                    <input type="text" name="q" placeholder="Rechercher un produit, une marque, etc." 
                           class="w-full border-gray-300 focus:border-noorea-gold focus:ring focus:ring-noorea-gold/20 rounded-lg pl-10 py-3">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle menu mobile
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        
        // Contrôle modal de recherche
        document.querySelector('[aria-label="Rechercher"]').addEventListener('click', function() {
            document.getElementById('search-modal').classList.remove('hidden');
        });
        
        document.getElementById('close-search')?.addEventListener('click', function() {
            document.getElementById('search-modal').classList.add('hidden');
        });
        
        // Fermer modal en cliquant à l'extérieur
        document.getElementById('search-modal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>

    <!-- Composant WhatsApp flottant -->
    @include('components.whatsapp-float')
    
    @stack('scripts')
</body>
</html>
