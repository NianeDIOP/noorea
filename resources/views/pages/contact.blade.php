@extends('layouts.app')

@section('navbar')
<header class="absolute top-0 left-0 w-full z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between bg-transparent backdrop-blur-none px-4 py-3">
            <!-- Logo Premium -->
            <a href="{{ route('home') }}" class="flex items-center group navbar-logo">
                <div class="relative">
                    <!-- Logo principal -->
                    <div class="relative p-2 transition-all duration-300 rounded-xl">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Noorea - L'élégance multiculturelle" class="h-12 md:h-16 lg:h-20 w-auto transition-all duration-300">
                    </div>
                    <!-- Particules décoratives -->
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-noorea-gold rounded-full animate-pulse opacity-30"></div>
                    <div class="absolute -bottom-1 -left-1 w-2 h-2 bg-noorea-gold rounded-full animate-pulse opacity-20" style="animation-delay: 0.5s;"></div>
                </div>
            </a>
            <!-- Navigation principale - desktop -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="nav-link-dark {{ request()->routeIs('home') ? 'active-dark' : '' }}">Accueil</a>
                <a href="{{ route('products') }}" class="nav-link-dark {{ request()->routeIs('products') ? 'active-dark' : '' }}">Boutique</a>
                <a href="{{ route('categories') }}" class="nav-link-dark {{ request()->routeIs('categories') ? 'active-dark' : '' }}">Catégories</a>
                <a href="{{ route('brands') }}" class="nav-link-dark {{ request()->routeIs('brands') ? 'active-dark' : '' }}">Marques</a>
                <a href="{{ route('blog') }}" class="nav-link-dark {{ request()->routeIs('blog') ? 'active-dark' : '' }}">Beauté du Monde</a>
                <a href="{{ route('about') }}" class="nav-link-dark {{ request()->routeIs('about') ? 'active-dark' : '' }}">À propos</a>
            </nav>
            <!-- Actions utilisateur -->
            <div class="flex items-center space-x-5">
                <!-- Recherche -->
                <button type="button" class="navbar-icon text-lg" aria-label="Rechercher">
                    <i class="fas fa-search"></i>
                </button>
                <!-- Compte utilisateur -->
                <a href="{{ route('account.dashboard') }}" class="navbar-icon text-lg" aria-label="Mon compte">
                    <i class="fas fa-user"></i>
                </a>
                <!-- Wishlist -->
                <a href="{{ route('wishlist') }}" class="navbar-icon text-lg" aria-label="Ma wishlist">
                    <i class="fas fa-heart"></i>
                </a>
                <!-- Panier -->
                <a href="{{ route('cart') }}" class="navbar-icon text-lg relative" aria-label="Mon panier">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="absolute -top-2 -right-2 bg-noorea-rose text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg opacity-80">0</span>
                </a>
                <!-- Menu mobile toggle -->
                <button type="button" class="navbar-mobile-icon md:hidden text-lg" id="mobile-menu-button" aria-label="Menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <!-- Menu mobile -->
        <div class="md:hidden hidden bg-black/80 backdrop-blur-md rounded-lg mt-4 border border-noorea-gold/30" id="mobile-menu">
            <nav class="flex flex-col space-y-4 p-6">
                <a href="{{ route('home') }}" class="nav-link-dark {{ request()->routeIs('home') ? 'active-dark' : '' }}">Accueil</a>
                <a href="{{ route('products') }}" class="nav-link-dark {{ request()->routeIs('products') ? 'active-dark' : '' }}">Boutique</a>
                <a href="{{ route('categories') }}" class="nav-link-dark {{ request()->routeIs('categories') ? 'active-dark' : '' }}">Catégories</a>
                <a href="{{ route('brands') }}" class="nav-link-dark {{ request()->routeIs('brands') ? 'active-dark' : '' }}">Marques</a>
                <a href="{{ route('blog') }}" class="nav-link-dark {{ request()->routeIs('blog') ? 'active-dark' : '' }}">Beauté du Monde</a>
                <a href="{{ route('about') }}" class="nav-link-dark {{ request()->routeIs('about') ? 'active-dark' : '' }}">À propos</a>
            </nav>
        </div>
    </div>
</header>
@endsection

@section('content')
<!-- Hero Section Contact -->
<section class="relative h-96 overflow-hidden bg-gradient-to-br from-noorea-dark via-noorea-emerald/30 to-noorea-gold/40 pt-24 md:pt-28">
    <!-- Images de fond -->
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/7319070/pexels-photo-7319070.jpeg?auto=compress&cs=tinysrgb&w=1920&h=600&fit=crop')] bg-cover bg-center opacity-50"></div>
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/4474035/pexels-photo-4474035.jpeg?auto=compress&cs=tinysrgb&w=1920&h=600&fit=crop')] bg-cover bg-right opacity-30"></div>
    
    <!-- Overlay gradient -->
    <div class="absolute inset-0 bg-gradient-to-r from-noorea-dark/85 via-noorea-dark/60 to-transparent"></div>
    
    <!-- Contenu centré -->
    <div class="relative z-30 flex items-center h-full">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <nav class="text-noorea-gold mb-6 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-yellow-300 transition-colors">Accueil</a>
                    <span class="mx-2 text-white">/</span>
                    <span class="text-white font-medium">Contact</span>
                </nav>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-4 leading-tight">
                    Contactez-nous
                </h1>
                <p class="text-xl text-gray-200 leading-relaxed mb-6">
                    Notre équipe est à votre écoute pour vous conseiller et vous accompagner dans vos choix beauté. 
                    Contactez-nous facilement via WhatsApp ou par téléphone.
                </p>
                <div class="flex items-center gap-8 mt-8">
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">24/7</div>
                        <div class="text-sm text-gray-300">Disponible</div>
                    </div>
                    <div class="w-px h-12 bg-gray-400/50"></div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-3 border border-white/20">
                        <div class="text-3xl font-bold text-noorea-gold">1min</div>
                        <div class="text-sm text-gray-300">Réponse rapide</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Options de contact -->
<div class="bg-noorea-cream/30 py-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            
            <!-- WhatsApp -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <div class="bg-green-500 text-white p-6 text-center">
                    <i class="fab fa-whatsapp text-5xl mb-4"></i>
                    <h3 class="text-2xl font-bold">WhatsApp</h3>
                    <p class="text-green-100">Contact instantané</p>
                </div>
                <div class="p-6">
                    <h4 class="font-semibold text-lg mb-2">Messagerie instantanée</h4>
                    <p class="text-gray-600 mb-4">Discutez avec notre équipe en temps réel. Partagez des photos, posez vos questions, passez commande.</p>
                    <div class="space-y-3">
                        <a href="https://wa.me/221781029818?text=Bonjour%20Noorea%21%20J'aimerais%20obtenir%20des%20conseils%20beauté%20personnalisés." 
                           target="_blank"
                           class="block w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-medium text-center transition-colors">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Conseils beauté
                        </a>
                        <a href="https://wa.me/221781029818?text=Bonjour%20Noorea%21%20Je%20souhaite%20passer%20une%20commande." 
                           target="_blank"
                           class="block w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-medium text-center transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Passer commande
                        </a>
                        <a href="https://wa.me/221781029818?text=Bonjour%20Noorea%21%20J'ai%20une%20question%20sur%20un%20produit." 
                           target="_blank"
                           class="block w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-medium text-center transition-colors">
                            <i class="fas fa-question-circle mr-2"></i>
                            Questions produits
                        </a>
                    </div>
                </div>
            </div>

            <!-- Téléphone -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <div class="bg-noorea-gold text-white p-6 text-center">
                    <i class="fas fa-phone text-5xl mb-4"></i>
                    <h3 class="text-2xl font-bold">Téléphone</h3>
                    <p class="text-yellow-100">Appel direct</p>
                </div>
                <div class="p-6">
                    <h4 class="font-semibold text-lg mb-2">Service client</h4>
                    <p class="text-gray-600 mb-4">Parlez directement avec nos conseillers beauté pour un service personnalisé.</p>
                    <div class="space-y-3">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-noorea-dark mb-2">+221 78 102 98 18</div>
                            <p class="text-sm text-gray-500 mb-4">Lun-Sam : 8h-20h | Dim : 10h-18h</p>
                        </div>
                        <a href="tel:+221781029818" 
                           class="block w-full bg-noorea-gold hover:bg-yellow-600 text-white py-3 rounded-lg font-medium text-center transition-colors">
                            <i class="fas fa-phone mr-2"></i>
                            Appeler maintenant
                        </a>
                        <div class="text-center">
                            <p class="text-xs text-gray-500">Tarifs selon votre opérateur</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visite en magasin -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 md:col-span-2 lg:col-span-1">
                <div class="bg-noorea-emerald text-white p-6 text-center">
                    <i class="fas fa-store text-5xl mb-4"></i>
                    <h3 class="text-2xl font-bold">Boutique</h3>
                    <p class="text-emerald-100">Rendez-vous</p>
                </div>
                <div class="p-6">
                    <h4 class="font-semibold text-lg mb-2">Visite en magasin</h4>
                    <p class="text-gray-600 mb-4">Découvrez nos produits, testez les textures et bénéficiez de conseils sur-mesure.</p>
                    <div class="space-y-3">
                        <div class="text-center">
                            <p class="font-medium">123 Avenue Léopold Sédar Senghor</p>
                            <p class="text-gray-600">Dakar, Sénégal</p>
                        </div>
                        <a href="https://wa.me/221781029818?text=Bonjour%20Noorea%21%20J'aimerais%20prendre%20rendez-vous%20pour%20visiter%20votre%20boutique." 
                           target="_blank"
                           class="block w-full bg-noorea-emerald hover:bg-emerald-600 text-white py-3 rounded-lg font-medium text-center transition-colors">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Prendre RDV
                        </a>
                        <div class="text-center">
                            <p class="text-xs text-gray-500">Lun-Sam : 9h-19h | Fermé dimanche</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ rapide -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-serif font-bold text-noorea-dark mb-6 text-center">Questions fréquentes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold mb-2">💰 Quels sont les modes de paiement ?</h3>
                    <p class="text-gray-600 text-sm">Paiement à la livraison, Wave, Orange Money, virement bancaire.</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">🚚 Quels sont les délais de livraison ?</h3>
                    <p class="text-gray-600 text-sm">24-48h à Dakar, 2-5 jours en région, gratuit dès 30 000 CFA.</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">✨ Les produits sont-ils authentiques ?</h3>
                    <p class="text-gray-600 text-sm">100% authentiques, importés directement des marques partenaires.</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">📞 Puis-je être conseillé(e) ?</h3>
                    <p class="text-gray-600 text-sm">Oui ! Nos conseillers vous aident à choisir selon votre type de peau.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
