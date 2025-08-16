@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Modifier ' . $user->name;
    $breadcrumb = [
        ['title' => 'Système', 'url' => '#'],
        ['title' => 'Utilisateurs', 'url' => route('admin.users.index')],
        ['title' => 'Modifier']
    ];
@endphp

@section('page_actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('admin.users.show', $user) }}" class="btn-admin-outline">
        <i class="fas fa-eye mr-2"></i>
        Voir le profil
    </a>
    <a href="{{ route('admin.users.index') }}" class="btn-admin-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>
@endsection

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Formulaire principal -->
    <div class="lg:col-span-2">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" id="userForm">
            @csrf
            @method('PUT')
            
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
                               value="{{ old('name', $user->name) }}" 
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
                               value="{{ old('email', $user->email) }}" 
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
                               value="{{ old('phone', $user->phone) }}" 
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
                        Changer le mot de passe
                    </h3>
                    <p class="text-sm text-gray-500">Laissez vide pour conserver le mot de passe actuel</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nouveau mot de passe -->
                    <div>
                        <label for="password" class="admin-form-label">
                            <i class="fas fa-key mr-2"></i>Nouveau mot de passe
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="admin-form-input pr-10 @error('password') border-red-500 @enderror" 
                                   placeholder="Minimum 8 caractères">
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
                        <label for="password_confirmation" class="admin-form-label">
                            <i class="fas fa-key mr-2"></i>Confirmer le mot de passe
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="admin-form-input pr-10" 
                                   placeholder="Répéter le mot de passe">
                            <button type="button" onclick="togglePassword('password_confirmation')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Indicateur de force (si nouveau mot de passe) -->
                <div id="password-strength-container" class="mt-4 hidden">
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
                        <div id="avatar-preview" class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center overflow-hidden border-2 border-gray-300">
                            @if($user->avatar)
                                <img id="avatar-image" class="w-full h-full object-cover" 
                                     src="{{ Storage::url($user->avatar) }}" alt="Avatar actuel">
                                <i id="avatar-placeholder" class="fas fa-user text-gray-400 text-2xl hidden"></i>
                            @else
                                <i id="avatar-placeholder" class="fas fa-user text-gray-400 text-2xl"></i>
                                <img id="avatar-image" class="w-full h-full object-cover hidden" src="" alt="Aperçu">
                            @endif
                        </div>
                    </div>
                    
                    <!-- Upload -->
                    <div class="flex-1">
                        <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*" onchange="previewAvatar(this)">
                        <div class="space-x-2">
                            <label for="avatar" class="btn-admin-outline cursor-pointer">
                                <i class="fas fa-camera mr-2"></i>Changer la photo
                            </label>
                            @if($user->avatar)
                                <button type="button" onclick="removeAvatar()" class="btn-admin-secondary">
                                    <i class="fas fa-trash mr-2"></i>Supprimer
                                </button>
                                <input type="hidden" name="remove_avatar" id="remove_avatar" value="0">
                            @endif
                        </div>
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
                    Enregistrer les modifications
                </button>
                <a href="{{ route('admin.users.show', $user) }}" class="btn-admin-outline w-full text-center inline-block">
                    <i class="fas fa-eye mr-2"></i>
                    Voir le profil
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn-admin-secondary w-full text-center inline-block">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour à la liste
                </a>
            </div>

            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm text-yellow-800">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Les modifications prendront effet immédiatement.
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
                        onchange="updateRoleInfo()"
                        {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
                @if($user->id === auth()->id())
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Vous ne pouvez pas modifier votre propre rôle
                    </p>
                    <input type="hidden" name="role" value="{{ $user->role }}" form="userForm">
                @endif
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
                           {{ old('is_active', $user->is_active) ? 'checked' : '' }} 
                           form="userForm"
                           {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                    <span class="toggle-slider"></span>
                    <span class="status-label">Compte actif</span>
                </label>
                @if($user->id === auth()->id())
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Vous ne pouvez pas désactiver votre propre compte
                    </p>
                    <input type="hidden" name="is_active" value="1" form="userForm">
                @endif
            </div>

            <!-- Info rôle -->
            <div class="mt-4 p-3 rounded-lg" id="role-info">
                <!-- Contenu généré par JS -->
            </div>
        </div>

        <!-- Statistiques utilisateur -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-chart-bar text-noorea-gold mr-2"></i>
                    Statistiques
                </h3>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Membre depuis</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $user->created_at->format('d/m/Y') }}
                    </span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Dernière connexion</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Jamais' }}
                    </span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Profil modifié</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $user->updated_at->format('d/m/Y H:i') }}
                    </span>
                </div>
                
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Commandes passées</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $user->orders_count ?? 0 }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Actions dangereuses -->
        @if($user->id !== auth()->id())
        <div class="admin-card border-red-200">
            <div class="admin-card-header">
                <h3 class="admin-card-title text-red-600">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                    Zone dangereuse
                </h3>
            </div>

            <div class="space-y-3">
                <button type="button" onclick="resetPassword()" class="w-full text-left px-3 py-2 text-sm text-orange-700 hover:bg-orange-50 rounded-lg transition-colors">
                    <i class="fas fa-key mr-2"></i>
                    Réinitialiser le mot de passe
                </button>
                
                <button type="button" onclick="deleteAccount()" class="w-full text-left px-3 py-2 text-sm text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                    <i class="fas fa-trash mr-2"></i>
                    Supprimer le compte
                </button>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
// Prévisualisation de l'avatar
function previewAvatar(input) {
    const preview = document.getElementById('avatar-image');
    const placeholder = document.getElementById('avatar-placeholder');
    const removeInput = document.getElementById('remove_avatar');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
            if (removeInput) removeInput.value = '0';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Supprimer l'avatar
function removeAvatar() {
    const preview = document.getElementById('avatar-image');
    const placeholder = document.getElementById('avatar-placeholder');
    const fileInput = document.getElementById('avatar');
    const removeInput = document.getElementById('remove_avatar');
    
    preview.classList.add('hidden');
    placeholder.classList.remove('hidden');
    fileInput.value = '';
    removeInput.value = '1';
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
    const container = document.getElementById('password-strength-container');
    const strengthBar = document.getElementById('password-strength');
    const strengthText = document.getElementById('password-strength-text');
    
    if (password.length > 0) {
        container.classList.remove('hidden');
        
        let strength = 0;
        let color = 'bg-gray-300';
        let text = '-';
        
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
        
        strengthBar.style.width = strength + '%';
        strengthBar.className = `h-2 rounded-full transition-all duration-300 ${color}`;
        strengthText.textContent = text;
    } else {
        container.classList.add('hidden');
    }
});

// Mettre à jour les informations du rôle
function updateRoleInfo() {
    const roleSelect = document.getElementById('role');
    const roleInfo = document.getElementById('role-info');
    
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
    }
}

// Actions dangereuses
function resetPassword() {
    if (confirm('Êtes-vous sûr de vouloir réinitialiser le mot de passe de cet utilisateur ? Un nouveau mot de passe temporaire sera généré et envoyé par email.')) {
        // Implementation via AJAX
        fetch(`/admin/users/{{ $user->id }}/reset-password`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Le mot de passe a été réinitialisé. Un email a été envoyé à l\'utilisateur.');
            } else {
                alert('Une erreur est survenue lors de la réinitialisation du mot de passe.');
            }
        });
    }
}

function deleteAccount() {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce compte utilisateur ? Cette action est irréversible et supprimera toutes les données associées.')) {
        if (confirm('Cette action est définitive. Confirmez-vous la suppression ?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.users.destroy", $user) }}';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    }
}

// Validation du formulaire
document.getElementById('userForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    
    if (password && password !== passwordConfirmation) {
        e.preventDefault();
        alert('Les mots de passe ne correspondent pas');
        document.getElementById('password_confirmation').focus();
        return false;
    }
    
    if (password && password.length < 8) {
        e.preventDefault();
        alert('Le nouveau mot de passe doit contenir au moins 8 caractères');
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
