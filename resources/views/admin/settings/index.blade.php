@extends('admin.layouts.app')

@section('content')
@php
    $page_title = 'Paramètres';
    $breadcrumb = [
        ['title' => 'Paramètres']
    ];
@endphp

<div class="space-y-6">
    <!-- Paramètres généraux -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">
                <i class="fas fa-cog text-noorea-gold mr-2"></i>
                Paramètres généraux
            </h3>
            <p class="text-sm text-gray-600">Configuration générale de la boutique</p>
        </div>

        <form method="POST" action="{{ route('admin.settings.general') }}" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Nom de la boutique -->
                <div>
                    <label for="shop_name" class="admin-form-label">
                        <i class="fas fa-store mr-2 text-gray-400"></i>
                        Nom de la boutique *
                    </label>
                    <input 
                        type="text" 
                        name="shop_name" 
                        id="shop_name" 
                        value="Noorea Boutique" 
                        required 
                        class="admin-form-input"
                        placeholder="Nom de votre boutique"
                    >
                </div>

                <!-- Email de contact -->
                <div>
                    <label for="contact_email" class="admin-form-label">
                        <i class="fas fa-envelope mr-2 text-gray-400"></i>
                        Email de contact *
                    </label>
                    <input 
                        type="email" 
                        name="contact_email" 
                        id="contact_email" 
                        value="contact@noorea.sn" 
                        required 
                        class="admin-form-input"
                        placeholder="contact@example.com"
                    >
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="phone" class="admin-form-label">
                        <i class="fas fa-phone mr-2 text-gray-400"></i>
                        Téléphone
                    </label>
                    <input 
                        type="tel" 
                        name="phone" 
                        id="phone" 
                        value="+221 77 123 45 67" 
                        class="admin-form-input"
                        placeholder="+221 XX XXX XX XX"
                    >
                </div>

                <!-- Adresse -->
                <div>
                    <label for="address" class="admin-form-label">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                        Adresse
                    </label>
                    <input 
                        type="text" 
                        name="address" 
                        id="address" 
                        value="Dakar, Sénégal" 
                        class="admin-form-input"
                        placeholder="Adresse complète"
                    >
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="admin-form-label">
                    <i class="fas fa-align-left mr-2 text-gray-400"></i>
                    Description de la boutique
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="3" 
                    class="admin-form-input"
                    placeholder="Description de votre boutique..."
                >Votre destination beauté au Sénégal. Découvrez nos produits de beauté authentiques et naturels.</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-admin-primary">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>

    <!-- Paramètres WhatsApp Business -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">
                <i class="fab fa-whatsapp text-green-500 mr-2"></i>
                WhatsApp Business
            </h3>
            <p class="text-sm text-gray-600">Configuration pour les commandes via WhatsApp</p>
        </div>

        <form method="POST" action="{{ route('admin.settings.whatsapp') }}" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Numéro WhatsApp -->
                <div>
                    <label for="whatsapp_number" class="admin-form-label">
                        <i class="fab fa-whatsapp mr-2 text-green-500"></i>
                        Numéro WhatsApp Business *
                    </label>
                    <input 
                        type="tel" 
                        name="whatsapp_number" 
                        id="whatsapp_number" 
                        value="+221771234567" 
                        required 
                        class="admin-form-input"
                        placeholder="+221XXXXXXXXX (sans espaces)"
                    >
                    <p class="text-sm text-gray-500 mt-1">Format international sans espaces ni tirets</p>
                </div>

                <!-- Message par défaut -->
                <div>
                    <label for="whatsapp_message_template" class="admin-form-label">
                        <i class="fas fa-comment mr-2 text-gray-400"></i>
                        Message de commande personnalisé
                    </label>
                    <textarea 
                        name="whatsapp_message_template" 
                        id="whatsapp_message_template" 
                        rows="4" 
                        class="admin-form-input"
                        placeholder="Template du message WhatsApp..."
                    >Bonjour Noorea! 🌺

Je souhaite passer commande :

%PRODUCTS%

Total : %TOTAL% FCFA

Merci!</textarea>
                    <p class="text-sm text-gray-500 mt-1">
                        Variables disponibles : %PRODUCTS%, %TOTAL%, %CUSTOMER_NAME%, %CUSTOMER_PHONE%
                    </p>
                </div>
            </div>

            <!-- Options WhatsApp -->
            <div class="space-y-4">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="whatsapp_enabled" 
                        id="whatsapp_enabled" 
                        checked 
                        class="h-4 w-4 text-noorea-gold focus:ring-noorea-gold border-gray-300 rounded"
                    >
                    <label for="whatsapp_enabled" class="ml-2 text-sm text-gray-700">
                        Activer les commandes WhatsApp
                    </label>
                </div>

                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="whatsapp_auto_redirect" 
                        id="whatsapp_auto_redirect" 
                        checked 
                        class="h-4 w-4 text-noorea-gold focus:ring-noorea-gold border-gray-300 rounded"
                    >
                    <label for="whatsapp_auto_redirect" class="ml-2 text-sm text-gray-700">
                        Redirection automatique vers WhatsApp après ajout au panier
                    </label>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-admin-primary">
                    <i class="fab fa-whatsapp mr-2"></i>
                    Mettre à jour WhatsApp
                </button>
            </div>
        </form>
    </div>

    <!-- Paramètres de sécurité -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">
                <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                Sécurité & Maintenance
            </h3>
            <p class="text-sm text-gray-600">Paramètres de sécurité et maintenance du site</p>
        </div>

        <div class="space-y-6">
            <!-- Changement de mot de passe -->
            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border border-blue-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-key text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-blue-800">Modifier le mot de passe</h4>
                        <p class="text-sm text-blue-600">Changez votre mot de passe administrateur</p>
                    </div>
                </div>
                <a href="{{ route('admin.password.change') }}" class="btn-admin-secondary text-sm">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier
                </a>
            </div>

            <!-- Sessions actives -->
            <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border border-green-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-green-800">Sessions actives</h4>
                        <p class="text-sm text-green-600">Gérez les sessions administrateur actives</p>
                    </div>
                </div>
                <button type="button" class="btn-admin-secondary text-sm" onclick="clearAllSessions()">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Tout déconnecter
                </button>
            </div>

            <!-- Cache -->
            <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg border border-orange-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-database text-orange-600"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-orange-800">Vider le cache</h4>
                        <p class="text-sm text-orange-600">Améliore les performances après modifications</p>
                    </div>
                </div>
                <button type="button" class="btn-admin-secondary text-sm" onclick="clearCache()">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Vider
                </button>
            </div>
        </div>
    </div>

    <!-- Informations système -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">
                <i class="fas fa-info-circle text-purple-600 mr-2"></i>
                Informations système
            </h3>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-2xl font-bold text-noorea-gold">{{ App\Models\Product::count() }}</div>
                <div class="text-sm text-gray-600">Produits</div>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-2xl font-bold text-noorea-gold">{{ App\Models\Order::count() }}</div>
                <div class="text-sm text-gray-600">Commandes</div>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-2xl font-bold text-noorea-gold">{{ App\Models\User::where('is_admin', false)->count() }}</div>
                <div class="text-sm text-gray-600">Clients</div>
            </div>
        </div>

        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <h4 class="text-sm font-medium text-gray-800 mb-2">Détails techniques</h4>
            <div class="text-sm text-gray-600 space-y-1">
                <p><strong>Version Laravel:</strong> {{ app()->version() }}</p>
                <p><strong>Version PHP:</strong> {{ phpversion() }}</p>
                <p><strong>Environnement:</strong> {{ app()->environment() }}</p>
                <p><strong>Dernière mise à jour:</strong> {{ date('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function clearAllSessions() {
    if (confirm('Êtes-vous sûr de vouloir déconnecter toutes les sessions administrateur actives ?')) {
        // Implémentation future
        alert('Fonctionnalité en cours de développement');
    }
}

function clearCache() {
    if (confirm('Vider le cache du système ?')) {
        // Implémentation future - appel AJAX vers route de nettoyage de cache
        alert('Cache vidé avec succès !');
    }
}
</script>
@endpush
