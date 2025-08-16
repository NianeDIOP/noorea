<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ isset($title) ? $title . ' | ' : '' }}Mon Espace - Noorea</title>
    
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('favicon.ico') }}?v={{ time() }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.png') }}?v={{ time() }}" type="image/png">
    <link rel="icon" href="{{ asset('favicon-192x192.png') }}?v={{ time() }}" sizes="192x192" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}?v={{ time() }}" sizes="180x180">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/noorea.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Styles pour l'espace client - Inspirés de l'admin */
        .client-nav-link {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            border-radius: 0.5rem;
            text-decoration: none;
        }

        .client-nav-link:hover {
            color: var(--color-noorea-gold);
        }

        .client-nav-link.active {
            color: var(--color-noorea-gold);
            background-color: rgba(212, 175, 55, 0.1);
        }

        .dropdown-link {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            transition: all 0.15s;
            text-decoration: none;
        }

        .dropdown-link:hover {
            background-color: rgba(212, 175, 55, 0.1);
            color: var(--color-noorea-gold);
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            font-weight: 500;
            color: #374151;
            transition: all 0.15s;
            border-radius: 0.5rem;
            text-decoration: none;
        }

        .mobile-nav-link:hover {
            color: var(--color-noorea-gold);
            background-color: rgba(212, 175, 55, 0.1);
        }

        /* Cards et containers */
        .client-card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid #f3f4f6;
            padding: 1.5rem;
        }

        .client-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f3f4f6;
            margin-bottom: 1rem;
        }

        .client-card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            display: flex;
            align-items: center;
        }

        /* Boutons */
        .btn-client-primary {
            background-color: var(--color-noorea-gold);
            color: white;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-client-primary:hover {
            background-color: #b8941f;
            transform: translateY(-1px);
        }

        .btn-client-secondary {
            background-color: white;
            color: var(--color-noorea-gold);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid var(--color-noorea-gold);
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-client-secondary:hover {
            background-color: var(--color-noorea-gold);
            color: white;
        }

        /* Stats cards */
        .stats-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid #f3f4f6;
            transition: all 0.2s;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .stats-card.primary {
            border-left: 4px solid var(--color-noorea-gold);
        }

        .stats-card.info {
            border-left: 4px solid #3b82f6;
        }

        .stats-card.success {
            border-left: 4px solid #10b981;
        }

        .stats-card.warning {
            border-left: 4px solid #f59e0b;
        }

        .stats-card-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        .stats-card.primary .stats-card-icon {
            background: linear-gradient(135deg, var(--color-noorea-gold), #f1c40f);
        }

        .stats-card.info .stats-card-icon {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }

        .stats-card.success .stats-card-icon {
            background: linear-gradient(135deg, #10b981, #34d399);
        }

        .stats-card.warning .stats-card-icon {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg border-b border-gray-200">
            <div class="mx-auto px-6">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <!-- Logo Noorea -->
                        <div class="flex-shrink-0">
                            <a href="{{ route('account.dashboard') }}" class="flex items-center group">
                                <img src="{{ asset('images/logo.png') }}" alt="Noorea" class="h-10 w-auto">
                                <div class="ml-3">
                                    <div class="text-2xl font-serif font-semibold text-noorea-gold">Noorea</div>
                                    <div class="text-xs text-gray-500 font-medium uppercase tracking-wide">Mon Espace</div>
                                </div>
                            </a>
                        </div>

                        <!-- Navigation principale -->
                        <div class="hidden md:ml-10 md:flex md:items-center md:space-x-8">
                            <a href="{{ route('account.dashboard') }}" 
                               class="client-nav-link {{ request()->routeIs('account.dashboard*') ? 'active' : '' }}">
                                <i class="fas fa-chart-line mr-2"></i>
                                Dashboard
                            </a>
                            
                            <a href="{{ route('account.profile') }}" 
                               class="client-nav-link {{ request()->routeIs('account.profile*') ? 'active' : '' }}">
                                <i class="fas fa-user-edit mr-2"></i>
                                Mon Profil
                            </a>

                            <a href="{{ route('account.orders') }}" 
                               class="client-nav-link {{ request()->routeIs('account.orders*') ? 'active' : '' }}">
                                <i class="fas fa-shopping-bag mr-2"></i>
                                Mes Commandes
                            </a>
                            
                            <a href="{{ route('account.wishlist') }}" 
                               class="client-nav-link {{ request()->routeIs('account.wishlist*') ? 'active' : '' }}">
                                <i class="fas fa-heart mr-2"></i>
                                Ma Wishlist
                            </a>

                            <a href="{{ route('account.addresses') }}" 
                               class="client-nav-link {{ request()->routeIs('account.addresses*') ? 'active' : '' }}">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                Mes Adresses
                            </a>

                            <a href="{{ route('account.security') }}" 
                               class="client-nav-link {{ request()->routeIs('account.security*') ? 'active' : '' }}">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Sécurité
                            </a>
                        </div>
                    </div>

                    <!-- Actions utilisateur -->
                    <div class="flex items-center space-x-4">
                        <!-- Retour au site -->
                        <a href="{{ route('home') }}" 
                           class="px-4 py-2 text-sm text-noorea-emerald border border-noorea-emerald rounded-lg hover:bg-noorea-emerald hover:text-white transition-all duration-200">
                            <i class="fas fa-shopping-bag mr-2"></i>
                            Continuer mes achats
                        </a>

                        <!-- Menu utilisateur -->
                        <div class="relative group">
                            <button class="flex items-center space-x-3 p-2 text-sm text-gray-700 hover:text-noorea-gold transition-colors">
                                <div class="w-8 h-8 bg-noorea-gold rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span class="font-medium">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('account.profile') }}" class="dropdown-link">
                                    <i class="fas fa-user mr-2"></i>
                                    Mon Profil
                                </a>
                                <a href="{{ route('account.security') }}" class="dropdown-link">
                                    <i class="fas fa-key mr-2"></i>
                                    Changer le mot de passe
                                </a>
                                <div class="border-t border-gray-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-link w-full text-left text-red-600 hover:bg-red-50">
                                            <i class="fas fa-sign-out-alt mr-2"></i>
                                            Se déconnecter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu mobile -->
                    <div class="md:hidden flex items-center">
                        <button type="button" class="mobile-menu-button p-2 text-gray-600 hover:text-noorea-gold">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menu mobile -->
            <div class="md:hidden mobile-menu hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                    <a href="{{ route('account.dashboard') }}" class="mobile-nav-link">
                        <i class="fas fa-chart-line mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('account.profile') }}" class="mobile-nav-link">
                        <i class="fas fa-user-edit mr-3"></i>
                        Mon Profil
                    </a>
                    <a href="{{ route('account.orders') }}" class="mobile-nav-link">
                        <i class="fas fa-shopping-bag mr-3"></i>
                        Mes Commandes
                    </a>
                    <a href="{{ route('account.wishlist') }}" class="mobile-nav-link">
                        <i class="fas fa-heart mr-3"></i>
                        Ma Wishlist
                    </a>
                    <a href="{{ route('account.addresses') }}" class="mobile-nav-link">
                        <i class="fas fa-map-marker-alt mr-3"></i>
                        Mes Adresses
                    </a>
                    <a href="{{ route('account.security') }}" class="mobile-nav-link">
                        <i class="fas fa-shield-alt mr-3"></i>
                        Sécurité
                    </a>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="flex-1">
            <!-- Breadcrumb et titre -->
            @if(isset($breadcrumb) || isset($page_title))
            <div class="bg-white shadow-sm border-b border-gray-200">
                <div class="mx-auto px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            @if(isset($page_title))
                                <h1 class="text-2xl font-bold text-gray-900">{{ $page_title }}</h1>
                            @endif
                            @if(isset($breadcrumb))
                                <nav class="flex mt-2" aria-label="Breadcrumb">
                                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                        <li class="inline-flex items-center">
                                            <a href="{{ route('account.dashboard') }}" class="text-gray-700 hover:text-noorea-gold">
                                                <i class="fas fa-home mr-2"></i>
                                                Dashboard
                                            </a>
                                        </li>
                                        @foreach($breadcrumb as $item)
                                            <li>
                                                <div class="flex items-center">
                                                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                                    @if(isset($item['url']))
                                                        <a href="{{ $item['url'] }}" class="text-gray-700 hover:text-noorea-gold">{{ $item['title'] }}</a>
                                                    @else
                                                        <span class="text-gray-500">{{ $item['title'] }}</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </nav>
                            @endif
                        </div>
                        @yield('page_actions')
                    </div>
                </div>
            </div>
            @endif

            <!-- Messages flash -->
            @if(session('success'))
                <div class="mx-auto px-6 pt-6">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-auto px-6 pt-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Contenu de la page -->
            <div class="mx-auto px-6 py-6">
                @yield('content')
            </div>
        </main>
    </div>

    @include('components.mini-cart')

    <!-- Scripts -->
    <script>
        // Menu mobile
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>
