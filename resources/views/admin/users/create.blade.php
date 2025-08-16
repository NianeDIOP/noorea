@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Nouvel Utilisateur';
    $breadcrumb = [
        ['title' => 'Système', 'url' => '#'],
        ['title' => 'Utilisateurs', 'url' => route('admin.users.index')],
        ['title' => 'Nouveau']
    ];
@endphp

@section('page_actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('admin.users.index') }}" class="btn-admin-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>
@endsection

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Formulaire principal -->
    <div class="lg:col-span-2">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" id="userForm">
            @csrf
            
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3 class="admin-card-title">
                        <i class="fas fa-info-circle text-noorea-gold mr-2"></i>
                        Informations générales
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom complet -->
                    <div class="md:col-span-2">
                        <label for="name" class="admin-form-label required">
                            <i class="fas fa-user mr-2"></i>Nom complet
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="admin-form-input @error('name') border-red-500 @enderror" 
                               value="{{ old('name') }}" 
                               placeholder="Nom complet de l'utilisateur"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="admin-form-label required">
                            <i class="fas fa-envelope mr-2"></i>Adresse email
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="admin-form-input @error('email') border-red-500 @enderror" 
                               value="{{ old('email') }}" 
                               placeholder="email@example.com"
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label for="phone" class="admin-form-label">
                            <i class="fas fa-phone mr-2"></i>Téléphone
                        </label>
                        <input type="text" 
                               name="phone" 
                               id="phone" 
                               class="admin-form-input @error('phone') border-red-500 @enderror" 
                               value="{{ old('phone') }}" 
                               placeholder="+221 77 123 45 67">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="admin-card mt-6">
                <div class="admin-card-header">
                    <h3 class="admin-card-title">
                        <i class="fas fa-lock text-noorea-gold mr-2"></i>
                        Sécurité
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="admin-form-label required">
                            <i class="fas fa-key mr-2"></i>Mot de passe
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="admin-form-input pr-10 @error('password') border-red-500 @enderror" 
                                   placeholder="Minimum 8 caractères"
                                   required>
                            <button type="button" onclick="togglePassword('password')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div>
                        <label for="password_confirmation" class="admin-form-label required">
                            <i class="fas fa-key mr-2"></i>Confirmer le mot de passe
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="admin-form-input pr-10" 
                                   placeholder="Répéter le mot de passe"
                                   required>
                            <button type="button" onclick="togglePassword('password_confirmation')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Indicateur de force -->
                <div class="mt-4">
                    <div class="flex items-center space-x-2 text-sm">
                        <span class="text-gray-600">Force du mot de passe :</span>
                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                            <div id="password-strength" class="h-2 rounded-full transition-all duration-300 bg-gray-300" style="width: 0%"></div>
                        </div>
                        <span id="password-strength-text" class="text-gray-500 font-medium">-</span>
                    </div>
                </div>
            </div>

            <div class="admin-card mt-6">
                <div class="admin-card-header">
                    <h3 class="admin-card-title">
                        <i class="fas fa-image text-noorea-gold mr-2"></i>
                        Photo de profil
                    </h3>
                </div>

                <div class="flex items-center space-x-6">
                    <!-- Prévisualisation -->
                    <div class="flex-shrink-0">
                        <div id="avatar-preview" class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden border-2 border-dashed border-gray-300">
                            <i class="fas fa-user text-gray-400 text-2xl" id="avatar-placeholder"></i>
                            <img id="avatar-image" class="w-full h-full object-cover hidden" src="" alt="Aperçu">
                        </div>
                    </div>
                    
                    <!-- Upload -->
                    <div class="flex-1">
                        <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*" onchange="previewAvatar(this)">
                        <label for="avatar" class="btn-admin-outline cursor-pointer">
                            <i class="fas fa-camera mr-2"></i>Choisir une photo
                        </label>
                        <p class="text-sm text-gray-500 mt-1">
                            JPG, PNG ou GIF - Maximum 2 MB
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Actions -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-cog text-noorea-gold mr-2"></i>
                    Actions
                </h3>
            </div>

            <div class="space-y-3">
                <button type="submit" form="userForm" class="btn-admin-primary w-full">
                    <i class="fas fa-save mr-2"></i>
                    Créer l'utilisateur
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-admin-secondary w-full text-center inline-block">
                    <i class="fas fa-times mr-2"></i>
                    Annuler
                </a>
            </div>

            <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-sm text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    L'utilisateur recevra un email de bienvenue avec ses informations de connexion.
                </p>
            </div>
        </div>

        <!-- Configuration -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-user-cog text-noorea-gold mr-2"></i>
                    Configuration du compte
                </h3>
            </div>

            <!-- Rôle -->
            <div class="admin-form-group">
                <label for="role" class="admin-form-label required">
                    <i class="fas fa-user-tag mr-2"></i>Rôle
                </label>
                <select name="role" id="role" form="userForm" 
                        class="admin-form-select @error('role') border-red-500 @enderror"
                        onchange="updateRoleInfo()">
                    <option value="user" {{ old('role', 'user') === 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Statut -->
            <div class="admin-form-group">
                <label for="is_active" class="admin-form-label">
                    <i class="fas fa-toggle-on mr-2"></i>Statut du compte
                </label>
                <label class="admin-toggle">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                           {{ old('is_active', true) ? 'checked' : '' }} form="userForm">
                    <span class="toggle-slider"></span>
                    <span class="status-label">Compte actif</span>
                </label>
            </div>

            <!-- Info rôle -->
            <div class="mt-4 p-3 rounded-lg" id="role-info">
                <!-- Contenu généré par JS -->
            </div>
        </div>

        <!-- Permissions -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-shield-alt text-noorea-gold mr-2"></i>
                    Permissions
                </h3>
            </div>

            <div id="permissions-list" class="space-y-2">
                <!-- Contenu généré par JS -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Prévisualisation de l'avatar
function previewAvatar(input) {
    const preview = document.getElementById('avatar-image');
    const placeholder = document.getElementById('avatar-placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
    }
}

// Basculer la visibilité du mot de passe
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Vérifier la force du mot de passe
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthBar = document.getElementById('password-strength');
    const strengthText = document.getElementById('password-strength-text');
    
    let strength = 0;
    let color = 'bg-gray-300';
    let text = '-';
    
    if (password.length > 0) {
        if (password.length >= 8) strength += 25;
        if (password.match(/[a-z]/)) strength += 25;
        if (password.match(/[A-Z]/)) strength += 25;
        if (password.match(/[0-9]/)) strength += 12.5;
        if (password.match(/[^a-zA-Z0-9]/)) strength += 12.5;
        
        if (strength < 25) {
            color = 'bg-red-400';
            text = 'Faible';
        } else if (strength < 50) {
            color = 'bg-orange-400';
            text = 'Moyen';
        } else if (strength < 75) {
            color = 'bg-yellow-400';
            text = 'Bon';
        } else {
            color = 'bg-green-400';
            text = 'Excellent';
        }
    }
    
    strengthBar.style.width = strength + '%';
    strengthBar.className = `h-2 rounded-full transition-all duration-300 ${color}`;
    strengthText.textContent = text;
});

// Mettre à jour les informations du rôle
function updateRoleInfo() {
    const roleSelect = document.getElementById('role');
    const roleInfo = document.getElementById('role-info');
    const permissionsList = document.getElementById('permissions-list');
    
    if (roleSelect.value === 'admin') {
        roleInfo.className = 'mt-4 p-3 rounded-lg bg-purple-50 border border-purple-200';
        roleInfo.innerHTML = `
            <div class="flex items-center text-purple-800">
                <i class="fas fa-crown mr-2"></i>
                <span class="font-medium">Administrateur</span>
            </div>
            <p class="text-sm text-purple-700 mt-1">
                Accès complet à toutes les fonctionnalités d'administration
            </p>
        `;
        
        permissionsList.innerHTML = `
            <div class="flex items-center text-sm text-green-700">
                <i class="fas fa-check-circle mr-2 w-4"></i>
                <span>Gestion des produits et catégories</span>
            </div>
            <div class="flex items-center text-sm text-green-700">
                <i class="fas fa-check-circle mr-2 w-4"></i>
                <span>Gestion des commandes</span>
            </div>
            <div class="flex items-center text-sm text-green-700">
                <i class="fas fa-check-circle mr-2 w-4"></i>
                <span>Gestion des utilisateurs</span>
            </div>
            <div class="flex items-center text-sm text-green-700">
                <i class="fas fa-check-circle mr-2 w-4"></i>
                <span>Accès aux rapports et statistiques</span>
            </div>
            <div class="flex items-center text-sm text-green-700">
                <i class="fas fa-check-circle mr-2 w-4"></i>
                <span>Configuration du système</span>
            </div>
        `;
    } else {
        roleInfo.className = 'mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200';
        roleInfo.innerHTML = `
            <div class="flex items-center text-blue-800">
                <i class="fas fa-user mr-2"></i>
                <span class="font-medium">Utilisateur standard</span>
            </div>
            <p class="text-sm text-blue-700 mt-1">
                Accès limité aux fonctionnalités de base
            </p>
        `;
        
        permissionsList.innerHTML = `
            <div class="flex items-center text-sm text-green-700">
                <i class="fas fa-check-circle mr-2 w-4"></i>
                <span>Passer des commandes</span>
            </div>
            <div class="flex items-center text-sm text-green-700">
                <i class="fas fa-check-circle mr-2 w-4"></i>
                <span>Voir l'historique des commandes</span>
            </div>
            <div class="flex items-center text-sm text-green-700">
                <i class="fas fa-check-circle mr-2 w-4"></i>
                <span>Modifier son profil</span>
            </div>
            <div class="flex items-center text-sm text-gray-500">
                <i class="fas fa-times-circle mr-2 w-4"></i>
                <span>Gestion administrative</span>
            </div>
            <div class="flex items-center text-sm text-gray-500">
                <i class="fas fa-times-circle mr-2 w-4"></i>
                <span>Accès aux rapports</span>
            </div>
        `;
    }
}

// Validation du formulaire
document.getElementById('userForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    
    if (password !== passwordConfirmation) {
        e.preventDefault();
        alert('Les mots de passe ne correspondent pas');
        document.getElementById('password_confirmation').focus();
        return false;
    }
    
    if (password.length < 8) {
        e.preventDefault();
        alert('Le mot de passe doit contenir au moins 8 caractères');
        document.getElementById('password').focus();
        return false;
    }
});

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    updateRoleInfo();
});
</script>
@endpush
