@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Changer le mot de passe';
    $breadcrumb = [
        ['title' => 'Paramètres', 'url' => route('admin.settings')],
        ['title' => 'Changer le mot de passe']
    ];
@endphp

<div class="max-w-2xl mx-auto">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">
                <i class="fas fa-key text-noorea-gold mr-2"></i>
                Modification du mot de passe
            </h3>
        </div>

        <form method="POST" action="{{ route('admin.password.change.post') }}" class="space-y-6">
            @csrf
            
            <!-- Mot de passe actuel -->
            <div>
                <label for="current_password" class="admin-form-label">
                    <i class="fas fa-lock mr-2 text-gray-400"></i>
                    Mot de passe actuel *
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="current_password" 
                        id="current_password" 
                        required 
                        class="admin-form-input pr-12 @error('current_password') border-red-500 @enderror"
                        placeholder="Saisissez votre mot de passe actuel"
                    >
                    <button 
                        type="button" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-noorea-gold transition-colors"
                        onclick="togglePassword('current_password')"
                    >
                        <i id="current_password_icon" class="fas fa-eye"></i>
                    </button>
                </div>
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nouveau mot de passe -->
            <div>
                <label for="new_password" class="admin-form-label">
                    <i class="fas fa-key mr-2 text-gray-400"></i>
                    Nouveau mot de passe *
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="new_password" 
                        id="new_password" 
                        required 
                        class="admin-form-input pr-12 @error('new_password') border-red-500 @enderror"
                        placeholder="Saisissez un nouveau mot de passe (min. 6 caractères)"
                        minlength="6"
                    >
                    <button 
                        type="button" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-noorea-gold transition-colors"
                        onclick="togglePassword('new_password')"
                    >
                        <i id="new_password_icon" class="fas fa-eye"></i>
                    </button>
                </div>
                @error('new_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">
                    Le mot de passe doit contenir au moins 6 caractères
                </p>
            </div>

            <!-- Confirmation du nouveau mot de passe -->
            <div>
                <label for="new_password_confirmation" class="admin-form-label">
                    <i class="fas fa-check-double mr-2 text-gray-400"></i>
                    Confirmer le nouveau mot de passe *
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="new_password_confirmation" 
                        id="new_password_confirmation" 
                        required 
                        class="admin-form-input pr-12"
                        placeholder="Confirmez votre nouveau mot de passe"
                        minlength="6"
                    >
                    <button 
                        type="button" 
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-noorea-gold transition-colors"
                        onclick="togglePassword('new_password_confirmation')"
                    >
                        <i id="new_password_confirmation_icon" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Conseils de sécurité -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="flex items-center text-sm font-medium text-blue-800 mb-2">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Conseils pour un mot de passe sécurisé
                </h4>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Au moins 8 caractères (recommandé)
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Mélange de lettres majuscules et minuscules
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Au moins un chiffre
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                        Au moins un caractère spécial (@, #, $, etc.)
                    </li>
                </ul>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-between space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.dashboard') }}" 
                   class="btn-admin-secondary">
                    <i class="fas fa-times mr-2"></i>
                    Annuler
                </a>
                
                <button type="submit" class="btn-admin-primary">
                    <i class="fas fa-save mr-2"></i>
                    Modifier le mot de passe
                </button>
            </div>
        </form>
    </div>

    <!-- Informations de sécurité -->
    <div class="admin-card mt-6">
        <div class="admin-card-header">
            <h3 class="admin-card-title text-amber-600">
                <i class="fas fa-exclamation-triangle text-amber-500 mr-2"></i>
                Informations importantes
            </h3>
        </div>
        <div class="text-sm text-gray-600 space-y-2">
            <p class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mr-2 mt-0.5 flex-shrink-0"></i>
                Après modification, vous devrez vous reconnecter avec le nouveau mot de passe.
            </p>
            <p class="flex items-start">
                <i class="fas fa-clock text-orange-500 mr-2 mt-0.5 flex-shrink-0"></i>
                Pour votre sécurité, changez votre mot de passe régulièrement (tous les 3-6 mois).
            </p>
            <p class="flex items-start">
                <i class="fas fa-user-shield text-green-500 mr-2 mt-0.5 flex-shrink-0"></i>
                Ne partagez jamais vos identifiants administrateur avec d'autres personnes.
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

// Vérification en temps réel de la correspondance des mots de passe
document.getElementById('new_password_confirmation').addEventListener('input', function() {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = this.value;
    
    if (confirmPassword && newPassword !== confirmPassword) {
        this.style.borderColor = '#ef4444';
    } else {
        this.style.borderColor = '#d1d5db';
    }
});

// Indicateur de force du mot de passe
document.getElementById('new_password').addEventListener('input', function() {
    const password = this.value;
    let strength = 0;
    
    if (password.length >= 6) strength++;
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
    if (/\d/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    // Vous pouvez ajouter un indicateur visuel ici si nécessaire
});
</script>
@endpush
