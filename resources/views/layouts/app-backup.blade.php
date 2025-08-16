<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>{{ isset($seo_title) ? $seo_title : (isset($title) ? $title . ' | Noorea - L\'expérience beauté multiculturelle' : 'Noorea - Boutique de cosmétiques et parfums multiculturels premium au Sénégal') }}</title>
    <meta name="description" content="{{ isset($seo_description) ? $seo_description : 'Noorea - Boutique de cosmétiques et parfums multiculturels premium au Sénégal. Découvrez notre sélection de produits de beauté authentiques issus des traditions du monde entier.' }}">
    <meta name="keywords" content="{{ isset($seo_keywords) ? $seo_keywords : 'cosmétiques, parfums, beauté multiculturelle, Sénégal, soins naturels, produits de beauté, maquillage, parfumerie, Dakar, beauté africaine' }}">
    <meta name="author" content="Noorea">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ isset($canonical_url) ? $canonical_url : url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ isset($og_title) ? $og_title : (isset($title) ? $title . ' | Noorea' : 'Noorea - L\'expérience beauté multiculturelle') }}">
    <meta property="og:description" content="{{ isset($og_description) ? $og_description : 'Découvrez Noorea, votre boutique de cosmétiques et parfums multiculturels premium au Sénégal.' }}">
    <meta property="og:image" content="{{ isset($og_image) ? $og_image : asset('images/logo.jpg') }}">
    <meta property="og:locale" content="fr_SN">
    <meta property="og:site_name" content="Noorea">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ isset($twitter_title) ? $twitter_title : (isset($title) ? $title . ' | Noorea' : 'Noorea - L\'expérience beauté multiculturelle') }}">
    <meta property="twitter:description" content="{{ isset($twitter_description) ? $twitter_description : 'Découvrez Noorea, votre boutique de cosmétiques et parfums multiculturels premium au Sénégal.' }}">
    <meta property="twitter:image" content="{{ isset($twitter_image) ? $twitter_image : asset('images/logo.jpg') }}">
    
    <!-- Schema.org for Local Business -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Store",
        "name": "Noorea",
        "description": "Boutique de cosmétiques et parfums multiculturels premium au Sénégal",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo.jpg') }}",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "SN",
            "addressLocality": "Dakar"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "availableLanguage": ["French", "Wolof"]
        },
        "currenciesAccepted": "XOF",
        "paymentAccepted": ["Cash", "Credit Card", "Orange Money", "Wave"],
        "priceRange": "$$"
    }
    </script>
    
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('favicon.ico') }}?v={{ time() }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.png') }}?v={{ time() }}" type="image/png">
    <link rel="icon" href="{{ asset('favicon-192x192.png') }}?v={{ time() }}" sizes="192x192" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}?v={{ time() }}" sizes="180x180">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/noorea.css', 'resources/js/app.js', 'resources/js/cart.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
    
    <!-- Google Analytics (décommentez et ajoutez votre ID en production) -->
    <!--
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    </script>
    -->
    
    <!-- Google Search Console (décommentez et ajoutez votre code de vérification en production) -->
    <!-- <meta name="google-site-verification" content="YOUR_VERIFICATION_CODE" /> -->
    
    @stack('head')
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
    
    <!-- Composant du mini-panier -->
    @include('components.mini-cart')

    <!-- Scripts -->
    <script>
        // Toggle menu mobile
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        
        // Contrôle modal de recherche
        document.querySelector('[aria-label="Rechercher"]')?.addEventListener('click', function() {
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
        
        // Assurer que le bouton du mini-panier fonctionne dès le chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            // S'assurer que le bouton du mini-panier fonctionne, même avant que cart.js soit entièrement chargé
            const navbarCartButton = document.getElementById('navbar-cart-button');
            if (navbarCartButton) {
                navbarCartButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Bouton panier navbar cliqué via script global');
                    
                    // Le module cart.js se charge de tout maintenant
                    if (typeof window.toggleMiniCart === 'function') {
                        window.toggleMiniCart();
                    } else {
                        console.warn('Module cart.js non encore chargé');
                    }
                });
            }
            
            // Le module cart.js gère maintenant tous les écouteurs du mini-panier
        });
    </script>

    <!-- Composant WhatsApp flottant -->
    @include('components.whatsapp-float')
    
    @stack('scripts')
</body>
</html>
