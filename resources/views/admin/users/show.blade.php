@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Profil de ' . $user->name;
    $breadcrumb = [
        ['title' => 'Système', 'url' => '#'],
        ['title' => 'Utilisateurs', 'url' => route('admin.users.index')],
        ['title' => $user->name]
    ];
@endphp

@section('page_actions')
<div class="flex items-center space-x-3">
    <a href="{{ route('admin.users.edit', $user) }}" class="btn-admin-primary">
        <i class="fas fa-edit mr-2"></i>
        Modifier
    </a>
    <a href="{{ route('admin.users.index') }}" class="btn-admin-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Retour à la liste
    </a>
</div>
@endsection

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Informations principales -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Profil utilisateur -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-user text-noorea-gold mr-2"></i>
                    Informations du profil
                </h3>
            </div>

            <div class="flex items-center space-x-6 mb-6">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    @if($user->avatar)
                        <img class="h-24 w-24 rounded-full object-cover border-4 border-gray-200" 
                             src="{{ Storage::url($user->avatar) }}" 
                             alt="{{ $user->name }}">
                    @else
                        <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center border-4 border-gray-200">
                            <span class="text-gray-600 font-bold text-2xl">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Informations de base -->
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-gray-600 mt-1">{{ $user->email }}</p>
                    
                    <div class="flex items-center space-x-4 mt-3">
                        <!-- Rôle -->
                        @if($user->role === 'admin')
                            <span class="status-badge warning">
                                <i class="fas fa-crown mr-1"></i>Administrateur
                            </span>
                        @else
                            <span class="status-badge info">
                                <i class="fas fa-user mr-1"></i>Utilisateur
                            </span>
                        @endif

                        <!-- Statut -->
                        @if($user->is_active)
                            <span class="status-badge success">
                                <i class="fas fa-check-circle mr-1"></i>Actif
                            </span>
                        @else
                            <span class="status-badge danger">
                                <i class="fas fa-times-circle mr-1"></i>Inactif
                            </span>
                        @endif

                        <!-- ID -->
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-hashtag mr-1"></i>ID: {{ $user->id }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Détails -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user mr-2"></i>Nom complet
                        </label>
                        <p class="text-sm text-gray-900 p-2 bg-gray-50 rounded-lg">{{ $user->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-envelope mr-2"></i>Adresse email
                        </label>
                        <p class="text-sm text-gray-900 p-2 bg-gray-50 rounded-lg">
                            <a href="mailto:{{ $user->email }}" class="text-noorea-gold hover:underline">
                                {{ $user->email }}
                            </a>
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-phone mr-2"></i>Téléphone
                        </label>
                        <p class="text-sm text-gray-900 p-2 bg-gray-50 rounded-lg">
                            @if($user->phone)
                                <a href="tel:{{ $user->phone }}" class="text-noorea-gold hover:underline">
                                    {{ $user->phone }}
                                </a>
                            @else
                                <span class="text-gray-500 italic">Non renseigné</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user-tag mr-2"></i>Rôle
                        </label>
                        <p class="text-sm text-gray-900 p-2 bg-gray-50 rounded-lg">
                            {{ $user->role === 'admin' ? 'Administrateur' : 'Utilisateur' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historique des commandes (si applicable) -->
        @if($user->orders && $user->orders->count() > 0)
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-shopping-cart text-noorea-gold mr-2"></i>
                    Historique des commandes
                </h3>
                <span class="text-sm text-gray-500">{{ $user->orders->count() }} commande(s)</span>
            </div>

            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>N° Commande</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->orders->take(5) as $order)
                        <tr>
                            <td>
                                <span class="font-mono text-sm">#{{ $order->reference }}</span>
                            </td>
                            <td>
                                <div class="text-sm text-gray-900">{{ $order->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $order->created_at->format('H:i') }}</div>
                            </td>
                            <td>
                                <span class="font-medium">{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                            </td>
                            <td>
                                <span class="status-badge {{ $order->status === 'delivered' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors" 
                                   title="Voir la commande">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($user->orders->count() > 5)
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.orders.index', ['user' => $user->id]) }}" class="btn-admin-outline">
                        <i class="fas fa-list mr-2"></i>
                        Voir toutes les commandes ({{ $user->orders->count() }})
                    </a>
                </div>
            @endif
        </div>
        @endif

        <!-- Activité récente -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-history text-noorea-gold mr-2"></i>
                    Journal d'activité
                </h3>
            </div>

            <div class="space-y-3">
                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-blue-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Compte créé</p>
                        <p class="text-xs text-gray-500">{{ $user->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>

                @if($user->updated_at != $user->created_at)
                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-edit text-green-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Profil mis à jour</p>
                        <p class="text-xs text-gray-500">{{ $user->updated_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
                @endif

                @if($user->last_login_at)
                <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-sign-in-alt text-purple-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Dernière connexion</p>
                        <p class="text-xs text-gray-500">{{ $user->last_login_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Actions rapides -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-bolt text-noorea-gold mr-2"></i>
                    Actions rapides
                </h3>
            </div>

            <div class="space-y-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn-admin-primary w-full">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier le profil
                </a>
                
                @if($user->phone)
                <button onclick="contactWhatsApp()" class="btn-admin-outline w-full">
                    <i class="fab fa-whatsapp mr-2"></i>
                    Contacter par WhatsApp
                </button>
                @endif

                <button onclick="sendEmail()" class="btn-admin-outline w-full">
                    <i class="fas fa-envelope mr-2"></i>
                    Envoyer un email
                </button>

                <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="btn-admin-secondary w-full" 
                            onclick="return confirm('Êtes-vous sûr de vouloir {{ $user->is_active ? 'désactiver' : 'activer' }} ce compte ?')">
                        <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }} mr-2"></i>
                        {{ $user->is_active ? 'Désactiver' : 'Activer' }} le compte
                    </button>
                </form>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-chart-bar text-noorea-gold mr-2"></i>
                    Statistiques
                </h3>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-shopping-cart text-blue-600 mr-2"></i>
                        <span class="text-sm text-blue-800">Commandes</span>
                    </div>
                    <span class="font-bold text-blue-900">{{ $user->orders_count ?? 0 }}</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-euro-sign text-green-600 mr-2"></i>
                        <span class="text-sm text-green-800">Total dépensé</span>
                    </div>
                    <span class="font-bold text-green-900">{{ number_format($user->total_spent ?? 0, 0, ',', ' ') }} F</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-purple-600 mr-2"></i>
                        <span class="text-sm text-purple-800">Ancienneté</span>
                    </div>
                    <span class="font-bold text-purple-900">{{ $user->created_at->diffInDays() }} jours</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-star text-orange-600 mr-2"></i>
                        <span class="text-sm text-orange-800">Niveau</span>
                    </div>
                    <span class="font-bold text-orange-900">
                        @if(($user->orders_count ?? 0) > 10)
                            VIP
                        @elseif(($user->orders_count ?? 0) > 5)
                            Fidèle
                        @else
                            Standard
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Informations système -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-cog text-noorea-gold mr-2"></i>
                    Informations système
                </h3>
            </div>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">ID utilisateur</span>
                    <span class="font-mono text-gray-900">#{{ $user->id }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Date de création</span>
                    <span class="text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Dernière modification</span>
                    <span class="text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Email vérifié</span>
                    <span class="{{ $user->email_verified_at ? 'text-green-600' : 'text-red-600' }}">
                        {{ $user->email_verified_at ? 'Oui' : 'Non' }}
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

            <div class="space-y-2">
                <button onclick="resetPassword()" class="w-full text-left px-3 py-2 text-sm text-orange-700 hover:bg-orange-50 rounded-lg transition-colors">
                    <i class="fas fa-key mr-2"></i>
                    Réinitialiser le mot de passe
                </button>
                
                <button onclick="deleteAccount()" class="w-full text-left px-3 py-2 text-sm text-red-700 hover:bg-red-50 rounded-lg transition-colors">
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
function contactWhatsApp() {
    const phone = '{{ $user->phone }}';
    const message = encodeURIComponent('Bonjour {{ $user->name }}, ');
    window.open(`https://wa.me/${phone.replace(/\D/g, '')}?text=${message}`, '_blank');
}

function sendEmail() {
    const email = '{{ $user->email }}';
    const subject = encodeURIComponent('Message de Noorea');
    window.open(`mailto:${email}?subject=${subject}`, '_blank');
}

function resetPassword() {
    if (confirm('Êtes-vous sûr de vouloir réinitialiser le mot de passe de {{ $user->name }} ? Un nouveau mot de passe temporaire sera généré et envoyé par email.')) {
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
        })
        .catch(error => {
            alert('Une erreur est survenue lors de la réinitialisation du mot de passe.');
        });
    }
}

function deleteAccount() {
    if (confirm('Êtes-vous sûr de vouloir supprimer le compte de {{ $user->name }} ? Cette action est irréversible et supprimera toutes les données associées.')) {
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
</script>
@endpush
