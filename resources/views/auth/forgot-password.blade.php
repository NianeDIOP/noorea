@extends('layouts.app')

@section('title', 'Mot de passe oublié - Noorea')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-noorea-cream to-white flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo et titre -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-noorea-gold rounded-full flex items-center justify-center">
                    <i class="fas fa-key text-white text-2xl"></i>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Mot de passe oublié</h2>
            <p class="text-gray-600">Entrez votre email pour recevoir un lien de réinitialisation</p>
        </div>

        <!-- Formulaire -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            @if(session('status'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form class="space-y-6" action="#" method="POST">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-envelope text-gray-400 mr-2"></i>
                        Adresse email
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-colors"
                        placeholder="votre@email.com"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Information -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                Nous vous enverrons un email avec un lien sécurisé pour réinitialiser votre mot de passe.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bouton -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-noorea-gold hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-noorea-gold transition-colors"
                    >
                        <i class="fas fa-paper-plane mr-2"></i>
                        Envoyer le lien de réinitialisation
                    </button>
                </div>

                <!-- Retour connexion -->
                <div class="text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-noorea-gold hover:text-yellow-600 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour à la connexion
                    </a>
                </div>
            </form>
        </div>

        <!-- Retour à l'accueil -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-noorea-gold transition-colors">
                <i class="fas fa-home mr-2"></i>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection
