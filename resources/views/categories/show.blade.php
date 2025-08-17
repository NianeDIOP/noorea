@extends('layouts.app')

@section('navbar')
<header class="absolute top-0 left-0 w-full z-50 backdrop-blur-md transition-all duration-300">
    <!-- Barre supérieure avec logo, recherche et icônes -->
    <div class="backdrop-blur-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Logo à gauche -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Noorea - L'élégance multiculturelle" class="h-14 md:h-16 w-auto">
                    </a>
                </div>
                
                <!-- Barre de recherche centrale -->
                <div class="flex-1 max-w-2xl mx-8">
                    <div class="relative">
                        <input 
                            type="search" 
                            placeholder="Rechercher des produits, marques, catégories..." 
                            class="w-full px-5 py-3 pl-12 pr-14 bg-white border-2 border-white/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-all duration-300 shadow-xl text-gray-800 placeholder-gray-500 font-medium"
                        >
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-search text-gray-600 text-xl"></i>
                        </div>
                        <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-noorea-gold hover:bg-yellow-600 text-white p-3 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                            <i class="fas fa-search text-lg"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Icônes à droite -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('account.dashboard') }}" class="navbar-icon-top" title="Mon compte">
                        <i class="fas fa-user text-xl"></i>
                    </a>
                    <a href="{{ route('wishlist') }}" class="navbar-icon-top relative" title="Ma wishlist">
                        <i class="fas fa-heart text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">3</span>
                    </a>
                    <a href="{{ route('cart') }}" class="navbar-icon-top relative" title="Mon panier">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-noorea-gold text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow-lg">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Barre de navigation inférieure -->
    <div class="backdrop-blur-sm border-t border-noorea-gold/20" style="background-color: #F7EAD5;">
        <div class="container mx-auto px-4">
            <nav class="hidden md:flex items-center justify-center py-3">
                <div class="flex space-x-8">
                    <a href="{{ route('home') }}" class="nav-link-gold {{ request()->routeIs('home') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                    <a href="{{ route('products') }}" class="nav-link-gold {{ request()->routeIs('products') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-shopping-bag mr-2"></i>Boutique
                    </a>
                    <a href="{{ route('categories') }}" class="nav-link-gold {{ request()->routeIs('categories*') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-th-large mr-2"></i>Catégories
                    </a>
                    <a href="{{ route('brands') }}" class="nav-link-gold {{ request()->routeIs('brands') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-crown mr-2"></i>Marques
                    </a>
                    <a href="{{ route('blog') }}" class="nav-link-gold {{ request()->routeIs('blog') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-globe mr-2"></i>Beauté du Monde
                    </a>
                    <a href="{{ route('about') }}" class="nav-link-gold {{ request()->routeIs('about') ? 'active-gold' : '' }} flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>À propos
                    </a>
                </div>
            </nav>
        </div>
    </div>
</header>
@endsection

@section('content')
<!-- Fil d'Ariane -->
<section class="pt-32 pb-8 bg-noorea-cream/30">
    <div class="container mx-auto px-4">
        <nav class="text-sm breadcrumbs">
            <ol class="flex items-center space-x-2 text-gray-600">
                <li><a href="{{ route('home') }}" class="hover:text-noorea-gold transition-colors">Accueil</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                <li><a href="{{ route('categories') }}" class="hover:text-noorea-gold transition-colors">Catégories</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                <li class="text-gray-800 font-medium">{{ $category->name }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- En-tête de la catégorie -->
<section class="py-16 bg-gradient-to-br from-noorea-cream/20 via-white to-noorea-cream/10 relative overflow-hidden">
    <!-- Éléments décoratifs -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-noorea-gold/10 rounded-full blur-xl"></div>
    <div class="absolute bottom-20 right-20 w-32 h-32 bg-noorea-emerald/10 rounded-full blur-xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <!-- Icône de la catégorie -->
            @if($category->image)
                <div class="w-24 h-24 mx-auto mb-6 rounded-full overflow-hidden border-4 border-noorea-gold/20">
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-noorea-gold to-noorea-rose-gold flex items-center justify-center">
                    <i class="fas fa-th-large text-3xl text-white"></i>
                </div>
            @endif
            
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-noorea-dark mb-6">
                {{ $category->name }}
            </h1>
            
            @if($category->description)
                <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-2xl mx-auto">
                    {{ $category->description }}
                </p>
            @endif
            
            <div class="flex items-center justify-center space-x-6 text-sm text-gray-500">
                <div class="flex items-center">
                    <i class="fas fa-box mr-2 text-noorea-gold"></i>
                    {{ $products->total() }} {{ $products->total() > 1 ? 'produits' : 'produit' }}
                </div>
                @if($category->created_at)
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-2 text-noorea-gold"></i>
                        Créée le {{ $category->created_at->format('d/m/Y') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Grille des produits -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:translate-y-[-8px] border border-noorea-gold/5">
                        <!-- Image -->
                        <div class="relative h-64 overflow-hidden">
                            <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block h-full">
                                @if($product->main_image)
                                    <img src="{{ $product->main_image_url }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-noorea-cream to-noorea-rose-gold flex items-center justify-center">
                                        <i class="fas fa-image text-4xl text-white/70"></i>
                                    </div>
                                @endif
                            </a>
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-noorea-dark/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 space-y-2">
                                @if($product->is_featured)
                                    <div class="bg-noorea-gold text-white px-3 py-1 rounded-full text-xs font-medium flex items-center">
                                        <i class="fas fa-star mr-1"></i> Coup de Cœur
                                    </div>
                                @endif
                                @if($product->is_on_sale)
                                    <div class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                        -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Contenu -->
                        <div class="p-6">
                            <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="block">
                                <h3 class="text-lg font-semibold text-noorea-dark mb-2 group-hover:text-noorea-gold transition-colors duration-300">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            
                            @if($product->brand)
                                <p class="text-sm text-noorea-gold font-medium mb-3">
                                    {{ $product->brand->name }}
                                </p>
                            @endif
                            
                            <!-- Prix -->
                            <div class="flex items-center justify-between mb-4">
                                @if($product->is_on_sale)
                                    <div class="space-x-2">
                                        <span class="text-lg font-bold text-noorea-gold">
                                            {{ number_format($product->sale_price, 0, ',', ' ') }} FCFA
                                        </span>
                                        <span class="text-sm text-gray-500 line-through">
                                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                        </span>
                                    </div>
                                @else
                                    <span class="text-lg font-bold text-noorea-gold">
                                        {{ $product->formatted_price }}
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Bouton -->
                            <a href="{{ route('products.show', $product->slug ?? $product->id) }}" 
                               class="block w-full bg-noorea-gold hover:bg-yellow-600 text-white text-center font-medium px-4 py-3 rounded-lg transition-all duration-300">
                                Voir le produit
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-16">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <!-- Aucun produit -->
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-noorea-cream to-noorea-rose-gold flex items-center justify-center">
                    <i class="fas fa-box-open text-4xl text-white/70"></i>
                </div>
                <h3 class="text-2xl font-semibold text-noorea-dark mb-4">Aucun produit dans cette catégorie</h3>
                <p class="text-gray-600 mb-8">La catégorie "{{ $category->name }}" ne contient pas encore de produits.</p>
                <a href="{{ route('products') }}" class="inline-flex items-center bg-noorea-gold hover:bg-yellow-600 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour à la boutique
                </a>
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .navbar-icon-top {
        @apply w-12 h-12 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 text-white flex items-center justify-center transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105;
    }
</style>
@endpush
@endsection
