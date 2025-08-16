<!-- Modal de succès -->
<div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 {{ isset($showSuccessModal) ? '' : 'hidden' }}">
    <div class="relative top-20 mx-auto p-0 border w-96 shadow-lg rounded-xl bg-white">
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-t-xl px-6 py-4">
            <div class="flex items-center text-white">
                <div class="w-8 h-8 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                    <i class="fas fa-check text-lg"></i>
                </div>
                <h3 class="text-lg font-semibold">Succès</h3>
            </div>
        </div>
        
        <!-- Contenu -->
        <div class="p-6">
            <div class="mb-6">
                <p class="text-gray-700 text-center" id="successMessage">
                    {{ session('success') ?? 'Opération réalisée avec succès !' }}
                </p>
            </div>
            
            <!-- Actions -->
            <div class="flex justify-center">
                <button type="button" onclick="closeSuccessModal()" 
                        class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-check mr-2"></i>Continuer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'erreur -->
<div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 {{ isset($showErrorModal) ? '' : 'hidden' }}">
    <div class="relative top-20 mx-auto p-0 border w-96 shadow-lg rounded-xl bg-white">
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-t-xl px-6 py-4">
            <div class="flex items-center text-white">
                <div class="w-8 h-8 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                    <i class="fas fa-exclamation-triangle text-lg"></i>
                </div>
                <h3 class="text-lg font-semibold">Erreur</h3>
            </div>
        </div>
        
        <!-- Contenu -->
        <div class="p-6">
            <div class="mb-6">
                <p class="text-gray-700 text-center" id="errorMessage">
                    @if ($errors->any())
                        {{ $errors->first() }}
                    @else
                        Une erreur est survenue lors de l'opération.
                    @endif
                </p>
                
                @if ($errors->count() > 1)
                <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            
            <!-- Actions -->
            <div class="flex justify-center">
                <button type="button" onclick="closeErrorModal()" 
                        class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>Fermer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'information -->
<div id="infoModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-0 border w-96 shadow-lg rounded-xl bg-white">
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-t-xl px-6 py-4">
            <div class="flex items-center text-white">
                <div class="w-8 h-8 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                    <i class="fas fa-info text-lg"></i>
                </div>
                <h3 class="text-lg font-semibold">Information</h3>
            </div>
        </div>
        
        <!-- Contenu -->
        <div class="p-6">
            <div class="mb-6">
                <p class="text-gray-700 text-center" id="infoMessage">
                    Message d'information
                </p>
            </div>
            
            <!-- Actions -->
            <div class="flex justify-center">
                <button type="button" onclick="closeInfoModal()" 
                        class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-check mr-2"></i>Compris
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-0 border w-96 shadow-lg rounded-xl bg-white">
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-t-xl px-6 py-4">
            <div class="flex items-center text-white">
                <div class="w-8 h-8 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-3">
                    <i class="fas fa-question text-lg"></i>
                </div>
                <h3 class="text-lg font-semibold">Confirmation</h3>
            </div>
        </div>
        
        <!-- Contenu -->
        <div class="p-6">
            <div class="mb-6">
                <p class="text-gray-700 text-center" id="confirmMessage">
                    Êtes-vous sûr de vouloir effectuer cette action ?
                </p>
            </div>
            
            <!-- Actions -->
            <div class="flex justify-center space-x-3">
                <button type="button" onclick="closeConfirmModal()" 
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>Annuler
                </button>
                <button type="button" onclick="confirmAction()" 
                        class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-check mr-2"></i>Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales pour les modaux
let confirmCallback = null;

// Fonctions pour le modal de succès
function showSuccessModal(message = null) {
    if (message) {
        document.getElementById('successMessage').textContent = message;
    }
    document.getElementById('successModal').classList.remove('hidden');
}

function closeSuccessModal() {
    document.getElementById('successModal').classList.add('hidden');
}

// Fonctions pour le modal d'erreur
function showErrorModal(message = null) {
    if (message) {
        document.getElementById('errorMessage').textContent = message;
    }
    document.getElementById('errorModal').classList.remove('hidden');
}

function closeErrorModal() {
    document.getElementById('errorModal').classList.add('hidden');
}

// Fonctions pour le modal d'information
function showInfoModal(message) {
    document.getElementById('infoMessage').textContent = message;
    document.getElementById('infoModal').classList.remove('hidden');
}

function closeInfoModal() {
    document.getElementById('infoModal').classList.add('hidden');
}

// Fonctions pour le modal de confirmation
function showConfirmModal(message, callback) {
    document.getElementById('confirmMessage').textContent = message;
    confirmCallback = callback;
    document.getElementById('confirmModal').classList.remove('hidden');
}

function closeConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
    confirmCallback = null;
}

function confirmAction() {
    if (confirmCallback && typeof confirmCallback === 'function') {
        confirmCallback();
    }
    closeConfirmModal();
}

// Fermer les modaux en cliquant en dehors
document.addEventListener('click', function(e) {
    const modals = ['successModal', 'errorModal', 'infoModal', 'confirmModal'];
    modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal && e.target === modal) {
            if (modalId === 'successModal') closeSuccessModal();
            if (modalId === 'errorModal') closeErrorModal();
            if (modalId === 'infoModal') closeInfoModal();
            if (modalId === 'confirmModal') closeConfirmModal();
        }
    });
});

// Fermer les modaux avec la touche Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (!document.getElementById('successModal').classList.contains('hidden')) {
            closeSuccessModal();
        }
        if (!document.getElementById('errorModal').classList.contains('hidden')) {
            closeErrorModal();
        }
        if (!document.getElementById('infoModal').classList.contains('hidden')) {
            closeInfoModal();
        }
        if (!document.getElementById('confirmModal').classList.contains('hidden')) {
            closeConfirmModal();
        }
    }
});

// Auto-afficher les modaux basés sur les sessions Laravel
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        showSuccessModal('{{ session('success') }}');
    @endif

    @if(session('error'))
        showErrorModal('{{ session('error') }}');
    @endif

    @if(session('info'))
        showInfoModal('{{ session('info') }}');
    @endif

    @if($errors->any())
        showErrorModal();
    @endif
});

// Fonctions utilitaires pour interactions courantes
function confirmDelete(form, itemName = 'cet élément') {
    showConfirmModal(
        `Êtes-vous sûr de vouloir supprimer ${itemName} ? Cette action est irréversible.`,
        function() {
            form.submit();
        }
    );
}

function confirmToggleStatus(form, action = 'cette action') {
    showConfirmModal(
        `Êtes-vous sûr de vouloir effectuer ${action} ?`,
        function() {
            form.submit();
        }
    );
}

function confirmBulkAction(form, action, count) {
    showConfirmModal(
        `Êtes-vous sûr de vouloir ${action} ${count} élément(s) sélectionné(s) ?`,
        function() {
            form.submit();
        }
    );
}
</script>
