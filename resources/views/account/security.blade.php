@extends('account.layouts.app')

@section('title', 'Sécurité - Mon Compte')

@section('account-content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Sécurité</h2>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="space-y-8">
        <!-- Changer le mot de passe -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Changer le mot de passe</h3>
            
            <form method="POST" action="{{ route('account.password.change') }}" class="space-y-4">
                @csrf
                
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">
                        Mot de passe actuel <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="current_password" id="current_password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-transparent">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Nouveau mot de passe <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-transparent">
                        <p class="text-xs text-gray-600 mt-1">Minimum 8 caractères</p>
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                            Confirmer le mot de passe <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-transparent">
                    </div>
                </div>
                
                <div class="flex items-center justify-end">
                    <button type="submit" class="px-6 py-2 bg-noorea-gold text-white rounded-lg hover:bg-yellow-600">
                        <i class="fas fa-lock mr-2"></i>
                        Changer le mot de passe
                    </button>
                </div>
            </form>
        </div>

        <!-- Informations de sécurité -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations de sécurité</h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-shield-alt text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Compte vérifié</p>
                            <p class="text-sm text-gray-600">Votre adresse email est vérifiée</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                        <i class="fas fa-check mr-1"></i>
                        Vérifié
                    </span>
                </div>
                
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-key text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Mot de passe</p>
                            <p class="text-sm text-gray-600">Dernière modification: Il y a 30 jours</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        À renouveler
                    </span>
                </div>
                
                <div class="flex items-center justify-between py-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-mobile-alt text-gray-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Authentification à deux facteurs</p>
                            <p class="text-sm text-gray-600">Sécurité renforcée pour votre compte</p>
                        </div>
                    </div>
                    <button class="text-noorea-gold hover:text-yellow-600 text-sm">
                        Activer
                    </button>
                </div>
            </div>
        </div>

        <!-- Sessions actives -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Sessions actives</h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-green-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-desktop text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Session actuelle</p>
                            <p class="text-sm text-gray-600">Windows • Chrome • Dakar, Sénégal</p>
                            <p class="text-xs text-gray-500">Maintenant</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                        <i class="fas fa-circle mr-1"></i>
                        Actuelle
                    </span>
                </div>
                
                <div class="text-center">
                    <button class="text-red-600 hover:text-red-700 text-sm">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        Déconnecter toutes les autres sessions
                    </button>
                </div>
            </div>
        </div>

        <!-- Actions de sécurité -->
        <div class="bg-red-50 rounded-lg p-6 border border-red-200">
            <h3 class="text-lg font-semibold text-red-800 mb-4">Zone de danger</h3>
            <p class="text-red-700 mb-4">
                Ces actions sont irréversibles. Assurez-vous de bien comprendre leurs conséquences.
            </p>
            
            <div class="space-y-3">
                <button class="w-full text-left px-4 py-3 bg-white border border-red-300 rounded-lg text-red-700 hover:bg-red-50">
                    <i class="fas fa-download mr-2"></i>
                    Télécharger mes données
                </button>
                
                <button class="w-full text-left px-4 py-3 bg-white border border-red-300 rounded-lg text-red-700 hover:bg-red-50">
                    <i class="fas fa-user-times mr-2"></i>
                    Supprimer mon compte
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
