@extends('layouts.app')

@section('title', 'Inscription - Noorea')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-noorea-cream to-white flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo et titre -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-noorea-gold rounded-full flex items-center justify-center">
                    <i class="fas fa-user-plus text-white text-2xl"></i>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Créer un compte</h2>
            <p class="text-gray-600">Rejoignez la communauté Noorea</p>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form class="space-y-6" action="#" method="POST">
                @csrf
                
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-user text-gray-400 mr-2"></i>
                        Nom complet
                    </label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-colors"
                        placeholder="Votre nom complet"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

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

                <!-- Téléphone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-phone text-gray-400 mr-2"></i>
                        Téléphone (optionnel)
                    </label>
                    <input 
                        id="phone" 
                        name="phone" 
                        type="tel" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-colors"
                        placeholder="+221 XX XXX XX XX"
                        value="{{ old('phone') }}"
                    >
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-lock text-gray-400 mr-2"></i>
                        Mot de passe
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-colors"
                            placeholder="Au moins 6 caractères"
                            minlength="6"
                        >
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            onclick="togglePassword('password')"
                        >
                            <i id="password-icon" class="fas fa-eye text-gray-400 hover:text-noorea-gold transition-colors"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmation mot de passe -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-check-double text-gray-400 mr-2"></i>
                        Confirmer le mot de passe
                    </label>
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            required 
                            class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-noorea-gold transition-colors"
                            placeholder="Confirmez votre mot de passe"
                            minlength="6"
                        >
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            onclick="togglePassword('password_confirmation')"
                        >
                            <i id="password_confirmation-icon" class="fas fa-eye text-gray-400 hover:text-noorea-gold transition-colors"></i>
                        </button>
                    </div>
                </div>

                <!-- Conditions générales -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input 
                            id="terms" 
                            name="terms" 
                            type="checkbox" 
                            required
                            class="h-4 w-4 text-noorea-gold focus:ring-noorea-gold border-gray-300 rounded"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="text-gray-600">
                            J'accepte les 
                            <a href="#" class="text-noorea-gold hover:text-yellow-600">conditions générales</a> 
                            et la 
                            <a href="#" class="text-noorea-gold hover:text-yellow-600">politique de confidentialité</a>
                        </label>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="flex items-center">
                    <input 
                        id="newsletter" 
                        name="newsletter" 
                        type="checkbox" 
                        class="h-4 w-4 text-noorea-gold focus:ring-noorea-gold border-gray-300 rounded"
                    >
                    <label for="newsletter" class="ml-2 block text-sm text-gray-600">
                        Je souhaite recevoir les actualités et offres Noorea
                    </label>
                </div>

                <!-- Bouton d'inscription -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-noorea-gold hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-noorea-gold transition-colors"
                    >
                        <i class="fas fa-user-plus mr-2"></i>
                        Créer mon compte
                    </button>
                </div>

                <!-- Séparateur -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">ou</span>
                    </div>
                </div>

                <!-- Lien de connexion -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Déjà un compte ?
                        <a href="{{ route('login') }}" class="font-medium text-noorea-gold hover:text-yellow-600">
                            Se connecter
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Retour à l'accueil -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-noorea-gold transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const passwordIcon = document.getElementById(fieldId + '-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash text-gray-400 hover:text-noorea-gold transition-colors';
    } else {
        passwordInput.type = 'password';
        passwordIcon.className = 'fas fa-eye text-gray-400 hover:text-noorea-gold transition-colors';
    }
}

// Vérification en temps réel de la correspondance des mots de passe
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    
    if (confirmPassword && password !== confirmPassword) {
        this.style.borderColor = '#ef4444';
    } else {
        this.style.borderColor = '#d1d5db';
    }
});
</script>
@endsection
