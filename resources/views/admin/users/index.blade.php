@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Gestion des Utilisateurs';
    $breadcrumb = [
        ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['title' => 'Système', 'url' => '#'],
        ['title' => 'Utilisateurs']
    ];
@endphp

@section('page_actions')
<div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
    <div class="flex items-center space-x-2">
        <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-users text-noorea-gold mr-2"></i>
            <span class="font-medium text-gray-700">{{ $users->total() }} utilisateur(s)</span>
        </div>
        @if(request()->hasAny(['search', 'role', 'status']))
        <div class="flex items-center bg-blue-50 text-blue-700 rounded-lg px-3 py-2 text-sm">
            <i class="fas fa-filter mr-2"></i>
            <span class="font-medium">Filtres actifs</span>
        </div>
        @endif
    </div>
    <div class="flex items-center space-x-2">
        <a href="{{ route('admin.users.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>
            Nouvel Utilisateur
        </a>
    </div>
</div>
@endsection

<!-- Statistiques rapides -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stats-card primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Utilisateurs</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card success">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Actifs</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['active_users'] }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card warning">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Administrateurs</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['admin_users'] }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-crown"></i>
            </div>
        </div>
    </div>
    
    <div class="stats-card info">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Nouveaux ce mois</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['new_users'] }}</p>
            </div>
            <div class="stats-card-icon">
                <i class="fas fa-user-plus"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filtres et recherche -->
<div class="admin-card mb-6">
    <div class="admin-card-header">
        <h3 class="admin-card-title">
            <i class="fas fa-filter text-noorea-gold mr-2"></i>
            Filtres et Recherche
        </h3>
        @if(request()->hasAny(['search', 'role', 'status']))
        <div class="flex items-center space-x-2">
            <span class="text-sm text-blue-600 bg-blue-50 px-3 py-1 rounded-lg">
                {{ collect(request()->only(['search', 'role', 'status']))->filter()->count() }} filtre(s) actif(s)
            </span>
            <a href="{{ route('admin.users.index') }}" class="btn-admin-secondary text-sm">
                <i class="fas fa-times mr-2"></i>Réinitialiser
            </a>
        </div>
        @endif
    </div>
    
    <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Recherche -->
        <div class="admin-form-group">
            <label class="admin-form-label">
                <i class="fas fa-search mr-1 text-gray-400"></i>
                Recherche
            </label>
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Nom, email..."
                       class="admin-form-input pl-10">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- Rôle -->
        <div class="admin-form-group">
            <label class="admin-form-label">
                <i class="fas fa-user-tag mr-1 text-gray-400"></i>
                Rôle
            </label>
            <select name="role" class="admin-form-select">
                <option value="">Tous les rôles</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrateurs</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>Utilisateurs</option>
            </select>
        </div>

        <!-- Statut -->
        <div class="admin-form-group">
            <label class="admin-form-label">
                <i class="fas fa-toggle-on mr-1 text-gray-400"></i>
                Statut
            </label>
            <select name="status" class="admin-form-select">
                <option value="">Tous les statuts</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actifs</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactifs</option>
            </select>
        </div>

        <!-- Actions -->
        <div class="admin-form-group flex items-end">
            <div class="flex space-x-2 w-full">
                <button type="submit" class="btn-admin-primary flex-1">
                    <i class="fas fa-search mr-2"></i>Rechercher
                </button>
                @if(request()->hasAny(['search', 'role', 'status']))
                    <a href="{{ route('admin.users.index') }}" class="btn-admin-secondary px-3" title="Réinitialiser les filtres">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

<!-- Actions de sélection multiple -->
<div id="bulk-actions" class="hidden bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-blue-400 mr-2"></i>
            <span class="text-sm font-medium text-blue-800">
                <span id="selected-count">0</span> utilisateur(s) sélectionné(s)
            </span>
        </div>
        <div class="flex space-x-3">
            <button onclick="bulkAction('activate')" 
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                <i class="fas fa-check-circle mr-2"></i>Activer la sélection
            </button>
            <button onclick="bulkAction('deactivate')" 
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200">
                <i class="fas fa-times-circle mr-2"></i>Désactiver la sélection
            </button>
            <button onclick="bulkAction('promote')" 
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200">
                <i class="fas fa-crown mr-2"></i>Promouvoir en admin
            </button>
            <button onclick="bulkAction('demote')" 
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200">
                <i class="fas fa-user mr-2"></i>Retirer privilèges admin
            </button>
        </div>
    </div>
</div>

<!-- Liste des utilisateurs -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">
            <i class="fas fa-list text-noorea-gold mr-2"></i>
            Liste des Utilisateurs
        </h3>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-500">
                {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} sur {{ $users->total() }}
            </span>
            @if($users->hasPages())
            <div class="flex items-center space-x-1 text-sm text-gray-500">
                <i class="fas fa-file-alt"></i>
                <span>Page {{ $users->currentPage() }} sur {{ $users->lastPage() }}</span>
            </div>
            @endif
        </div>
    </div>

    @if($users->count() > 0)
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-noorea-gold focus:ring-noorea-gold">
                    </th>
                    <th>Utilisateur</th>
                    <th>Contact</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr id="user-{{ $user->id }}">
                    <!-- Sélection -->
                    <td>
                        <input type="checkbox" class="user-checkbox rounded border-gray-300 text-noorea-gold focus:ring-noorea-gold" 
                               value="{{ $user->id }}">
                    </td>

                    <!-- Utilisateur -->
                    <td>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                @if($user->avatar)
                                    <img class="h-10 w-10 rounded-full object-cover" 
                                         src="{{ Storage::url($user->avatar) }}" 
                                         alt="{{ $user->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-600 font-medium text-sm">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <a href="{{ route('admin.users.show', $user) }}" 
                                       class="hover:text-noorea-gold transition-colors">
                                        {{ $user->name }}
                                    </a>
                                </div>
                                <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                            </div>
                        </div>
                    </td>

                    <!-- Contact -->
                    <td>
                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                        @if($user->phone)
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-phone mr-1"></i>{{ $user->phone }}
                            </div>
                        @endif
                    </td>

                    <!-- Rôle -->
                    <td>
                        @if($user->role === 'admin')
                            <span class="status-badge warning">
                                <i class="fas fa-crown mr-1"></i>Admin
                            </span>
                        @else
                            <span class="status-badge info">
                                <i class="fas fa-user mr-1"></i>User
                            </span>
                        @endif
                    </td>

                    <!-- Statut -->
                    <td>
                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="inline">
                            @csrf
                            <label class="admin-toggle" title="{{ $user->is_active ? 'Désactiver' : 'Activer' }} cet utilisateur">
                                <input type="checkbox" {{ $user->is_active ? 'checked' : '' }} 
                                       onchange="confirmToggleStatusInline(this, '{{ $user->is_active ? "désactiver" : "activer" }}', '{{ $user->name }}')">
                                <span class="toggle-slider"></span>
                                <span class="status-label {{ $user->is_active ? 'active' : 'inactive' }}">
                                    {{ $user->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </label>
                        </form>
                    </td>

                    <!-- Date d'inscription -->
                    <td>
                        <div class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $user->created_at->format('H:i') }}</div>
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.users.show', $user) }}" 
                               class="text-blue-600 hover:text-blue-800 transition-colors" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" 
                               class="text-noorea-gold hover:text-noorea-gold/80 transition-colors" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="toggleRole({{ $user->id }})" 
                                    class="text-purple-600 hover:text-purple-800 transition-colors" 
                                    title="{{ $user->role === 'admin' ? 'Retirer admin' : 'Promouvoir admin' }}">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                            @if($user->phone)
                            <button onclick="contactUser({{ $user->id }})" 
                                    class="text-green-600 hover:text-green-800 transition-colors" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </button>
                            @endif
                            @if($user->id !== auth()->id())
                                <button onclick="deleteUser({{ $user->id }})" 
                                        class="text-red-600 hover:text-red-800 transition-colors" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @else
                                <span class="text-gray-300" title="Impossible de supprimer votre propre compte">
                                    <i class="fas fa-lock"></i>
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->appends(request()->query())->links() }}
    </div>

    @else
    <div class="text-center py-12">
        <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
            <i class="fas fa-users text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun utilisateur trouvé</h3>
        <p class="text-gray-500 mb-6">
            @if(request()->hasAny(['search', 'role', 'status']))
                Aucun utilisateur ne correspond à vos critères de recherche.
            @else
                Commencez par créer votre premier utilisateur.
            @endif
        </p>
        @if(request()->hasAny(['search', 'role', 'status']))
            <a href="{{ route('admin.users.index') }}" class="btn-admin-secondary mr-3">
                <i class="fas fa-times mr-2"></i>Effacer les filtres
            </a>
        @endif
        <a href="{{ route('admin.users.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus mr-2"></i>Créer un utilisateur
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Variables globales
let selectedUsers = [];

// Sélection multiple
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateSelectedCount();
    toggleBulkActions();
});

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('user-checkbox')) {
        updateSelectedCount();
        toggleBulkActions();
        updateSelectAllState();
    }
});

function updateSelectedCount() {
    const checked = document.querySelectorAll('.user-checkbox:checked');
    selectedUsers = Array.from(checked).map(cb => cb.value);
    document.getElementById('selected-count').textContent = selectedUsers.length;
}

function toggleBulkActions() {
    const bulkActions = document.getElementById('bulk-actions');
    if (selectedUsers.length > 0) {
        bulkActions.classList.remove('hidden');
    } else {
        bulkActions.classList.add('hidden');
    }
}

function updateSelectAllState() {
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
    
    if (checkedBoxes.length === 0) {
        selectAll.checked = false;
        selectAll.indeterminate = false;
    } else if (checkedBoxes.length === checkboxes.length) {
        selectAll.checked = true;
        selectAll.indeterminate = false;
    } else {
        selectAll.checked = false;
        selectAll.indeterminate = true;
    }
}

// Actions individuelles
function toggleStatus(userId) {
    if (confirm('Êtes-vous sûr de vouloir changer le statut de cet utilisateur ?')) {
        // Implementation via AJAX ou form submission
        console.log('Toggle status for user:', userId);
    }
}

function toggleRole(userId) {
    if (confirm('Êtes-vous sûr de vouloir changer le rôle de cet utilisateur ?')) {
        fetch(`/admin/users/${userId}/toggle-role`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Une erreur est survenue');
            }
        });
    }
}

function contactUser(userId) {
    // Récupérer les informations utilisateur et ouvrir WhatsApp
    console.log('Contact user via WhatsApp:', userId);
}

function deleteUser(userId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/users/${userId}`;
        
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

// Actions multiples
function bulkAction(action) {
    if (selectedUsers.length === 0) {
        alert('Veuillez sélectionner au moins un utilisateur');
        return;
    }
    
    let message = '';
    switch(action) {
        case 'activate':
            message = `Activer ${selectedUsers.length} utilisateur(s) ?`;
            break;
        case 'deactivate':
            message = `Désactiver ${selectedUsers.length} utilisateur(s) ?`;
            break;
        case 'promote':
            message = `Promouvoir ${selectedUsers.length} utilisateur(s) en administrateur ?`;
            break;
        case 'demote':
            message = `Retirer les privilèges admin à ${selectedUsers.length} utilisateur(s) ?`;
            break;
    }
    
    if (confirm(message)) {
        fetch('/admin/users/bulk-action', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: action,
                users: selectedUsers
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Une erreur est survenue');
            }
        });
    }
}

function confirmToggleStatusInline(checkbox, action, userName) {
    // Remettre le checkbox à son état précédent temporairement
    checkbox.checked = !checkbox.checked;
    
    if (confirm(`Êtes-vous sûr de vouloir ${action} l'utilisateur "${userName}" ?`)) {
        // Remettre le bon état et soumettre
        checkbox.checked = !checkbox.checked;
        checkbox.closest('form').submit();
    }
}
</script>
@endpush
