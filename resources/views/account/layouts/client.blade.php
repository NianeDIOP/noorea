<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ isset($title) ? $title . ' | ' : '' }}Mon Compte - Noorea</title>
    
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
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Styles spéciaux pour l'espace client */
        .client-card {
            background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(212, 175, 55, 0.1);
            transition: all 0.3s ease;
        }

        .client-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stats-card {
            @apply bg-white rounded-xl p-6 border border-gray-200;
            background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .stats-card.primary {
            border-left: 4px solid #d4af37;
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
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stats-card.primary .stats-card-icon {
            background: linear-gradient(135deg, #d4af37, #f1c40f);
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

        .client-nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
            border: 1px solid transparent;
        }

        .client-nav-link:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(241, 196, 15, 0.1));
            color: #d4af37;
            transform: translateX(4px);
            border-color: rgba(212, 175, 55, 0.2);
        }

        .client-nav-link.active {
            background: linear-gradient(135deg, #d4af37, #f1c40f);
            color: white;
            box-shadow: 0 4px 6px rgba(212, 175, 55, 0.4);
        }

        .client-nav-link i {
            width: 1.25rem;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .page-header {
            background: linear-gradient(135deg, #d4af37 0%, #f1c40f 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-radius: 1rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .content-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.1);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid rgba(212, 175, 55, 0.2);
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 0.75rem;
            color: #d4af37;
        }

        .btn-primary {
            background: linear-gradient(135deg, #d4af37, #f1c40f);
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(212, 175, 55, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(212, 175, 55, 0.4);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        @include('components.unified-navbar')
        
        <!-- Header de la page -->
        <div class="page-header">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold font-serif mb-2">Mon Espace Personnel</h1>
                        <p class="text-yellow-100 text-lg">Gérez votre compte, vos commandes et vos préférences</p>
                    </div>
                    <div class="hidden md:flex items-center space-x-6">
                        <div class="text-right">
                            <p class="text-sm text-yellow-100">Bienvenue,</p>
                            <p class="font-semibold text-xl">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-yellow-100">Membre depuis {{ Auth::user()->created_at->format('M Y') }}</p>
                        </div>
                        <div class="w-16 h-16 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                            <i class="fas fa-user text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="client-card p-6 sticky top-4">
                        <h2 class="font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-user-circle text-noorea-gold mr-3 text-xl"></i>
                            Navigation
                        </h2>
                        <nav class="space-y-1">
                            <a href="{{ route('account.dashboard') }}" class="client-nav-link {{ request()->routeIs('account.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-chart-line"></i>
                                <span>Tableau de bord</span>
                            </a>
                            <a href="{{ route('account.profile') }}" class="client-nav-link {{ request()->routeIs('account.profile') ? 'active' : '' }}">
                                <i class="fas fa-user-edit"></i>
                                <span>Mon Profil</span>
                            </a>
                            <a href="{{ route('account.orders') }}" class="client-nav-link {{ request()->routeIs('account.orders*') ? 'active' : '' }}">
                                <i class="fas fa-shopping-bag"></i>
                                <span>Mes Commandes</span>
                            </a>
                            <a href="{{ route('account.wishlist') }}" class="client-nav-link {{ request()->routeIs('account.wishlist') ? 'active' : '' }}">
                                <i class="fas fa-heart"></i>
                                <span>Ma Liste de Souhaits</span>
                            </a>
                            <a href="{{ route('account.addresses') }}" class="client-nav-link {{ request()->routeIs('account.addresses') ? 'active' : '' }}">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Mes Adresses</span>
                            </a>
                            <a href="{{ route('account.security') }}" class="client-nav-link {{ request()->routeIs('account.security') ? 'active' : '' }}">
                                <i class="fas fa-shield-alt"></i>
                                <span>Sécurité</span>
                            </a>
                            
                            <hr class="my-4">
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="client-nav-link w-full text-left text-red-600 hover:text-red-700 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>

                <!-- Contenu principal -->
                <div class="lg:col-span-3">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('components.mini-cart')
</body>
</html>
