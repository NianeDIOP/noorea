<!-- Conteneur de notifications Toast -->
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2">
    <!-- Les toasts seront ajoutés ici dynamiquement -->
</div>

<!-- Modal de confirmation universelle -->
<div id="confirmationModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-0 border-0 w-full max-w-md">
        <div class="relative bg-white rounded-2xl shadow-2xl mx-4">
            <!-- En-tête du modal -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div id="confirmIcon" class="w-10 h-10 rounded-full flex items-center justify-center mr-3 bg-amber-100">
                        <i class="fas fa-exclamation-triangle text-amber-600"></i>
                    </div>
                    <h3 id="confirmTitle" class="text-lg font-semibold text-gray-900">Confirmation requise</h3>
                </div>
                <button type="button" onclick="closeConfirmationModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- Contenu -->
            <div class="p-6">
                <p id="confirmMessage" class="text-gray-700 leading-relaxed">
                    Êtes-vous sûr de vouloir effectuer cette action ?
                </p>
            </div>
            
            <!-- Actions -->
            <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
                <button type="button" onclick="closeConfirmationModal()" 
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>Annuler
                </button>
                <button type="button" onclick="executeConfirmAction()" 
                        id="confirmButton"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-check mr-2"></i>Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour les toasts */
.toast {
    @apply transform transition-all duration-300 ease-in-out;
    @apply bg-white rounded-xl shadow-lg border border-gray-200;
    @apply min-w-80 max-w-96 p-4;
}

.toast.show {
    @apply translate-x-0 opacity-100;
}

.toast.hide {
    @apply translate-x-full opacity-0;
}

.toast-success {
    @apply border-l-4 border-green-500;
}

.toast-error {
    @apply border-l-4 border-red-500;
}

.toast-warning {
    @apply border-l-4 border-amber-500;
}

.toast-info {
    @apply border-l-4 border-blue-500;
}

.toast-icon {
    @apply w-8 h-8 rounded-full flex items-center justify-center text-white mr-3 flex-shrink-0;
}

.toast-icon.success {
    @apply bg-green-500;
}

.toast-icon.error {
    @apply bg-red-500;
}

.toast-icon.warning {
    @apply bg-amber-500;
}

.toast-icon.info {
    @apply bg-blue-500;
}

.toast-content {
    @apply flex-1 min-w-0;
}

.toast-title {
    @apply font-semibold text-gray-900 text-sm mb-1;
}

.toast-message {
    @apply text-gray-600 text-sm leading-relaxed;
}

.toast-close {
    @apply ml-4 text-gray-400 hover:text-gray-600 cursor-pointer transition-colors flex-shrink-0;
}

/* Animation pour les modaux */
.modal-backdrop {
    @apply backdrop-blur-sm;
}

.modal-content {
    @apply transform transition-all duration-300 ease-out;
}

.modal-enter {
    @apply opacity-0 scale-95;
}

.modal-enter-active {
    @apply opacity-100 scale-100;
}

.modal-exit {
    @apply opacity-100 scale-100;
}

.modal-exit-active {
    @apply opacity-0 scale-95;
}
</style>

<script>
// Variables globales
let confirmationCallback = null;
let toastCounter = 0;

/**
 * Système de Toast Notifications
 */
function showToast(message, type = 'info', title = null, duration = 5000) {
    const toastId = `toast-${++toastCounter}`;
    const container = document.getElementById('toast-container');
    
    // Déterminer le titre par défaut
    if (!title) {
        const titles = {
            success: 'Succès',
            error: 'Erreur',
            warning: 'Attention',
            info: 'Information'
        };
        title = titles[type] || 'Notification';
    }
    
    // Déterminer l'icône
    const icons = {
        success: 'fas fa-check',
        error: 'fas fa-times',
        warning: 'fas fa-exclamation-triangle',
        info: 'fas fa-info'
    };
    
    const icon = icons[type] || 'fas fa-bell';
    
    // Créer le toast
    const toast = document.createElement('div');
    toast.id = toastId;
    toast.className = `toast toast-${type} hide`;
    
    toast.innerHTML = `
        <div class="flex items-start">
            <div class="toast-icon ${type}">
                <i class="${icon}"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
            <div class="toast-close" onclick="hideToast('${toastId}')">
                <i class="fas fa-times"></i>
            </div>
        </div>
    `;
    
    container.appendChild(toast);
    
    // Déclencher l'animation d'entrée
    setTimeout(() => {
        toast.classList.remove('hide');
        toast.classList.add('show');
    }, 50);
    
    // Auto-suppression après durée spécifiée
    if (duration > 0) {
        setTimeout(() => {
            hideToast(toastId);
        }, duration);
    }
    
    return toastId;
}

function hideToast(toastId) {
    const toast = document.getElementById(toastId);
    if (toast) {
        toast.classList.remove('show');
        toast.classList.add('hide');
        
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }
}

// Fonctions de convenance
function showSuccessToast(message, title = null, duration = 4000) {
    return showToast(message, 'success', title, duration);
}

function showErrorToast(message, title = null, duration = 6000) {
    return showToast(message, 'error', title, duration);
}

function showWarningToast(message, title = null, duration = 5000) {
    return showToast(message, 'warning', title, duration);
}

function showInfoToast(message, title = null, duration = 4000) {
    return showToast(message, 'info', title, duration);
}

/**
 * Modal de confirmation
 */
function showConfirmationModal(options) {
    const defaults = {
        title: 'Confirmation requise',
        message: 'Êtes-vous sûr de vouloir effectuer cette action ?',
        confirmText: 'Confirmer',
        cancelText: 'Annuler',
        confirmClass: 'bg-red-600 hover:bg-red-700',
        iconClass: 'fas fa-exclamation-triangle',
        iconBg: 'bg-amber-100',
        iconColor: 'text-amber-600',
        callback: null
    };
    
    const config = { ...defaults, ...options };
    
    // Mettre à jour le contenu du modal
    document.getElementById('confirmTitle').textContent = config.title;
    document.getElementById('confirmMessage').textContent = config.message;
    
    const iconContainer = document.getElementById('confirmIcon');
    iconContainer.className = `w-10 h-10 rounded-full flex items-center justify-center mr-3 ${config.iconBg}`;
    iconContainer.innerHTML = `<i class="${config.iconClass} ${config.iconColor}"></i>`;
    
    const confirmBtn = document.getElementById('confirmButton');
    confirmBtn.textContent = config.confirmText;
    confirmBtn.className = `px-4 py-2 ${config.confirmClass} text-white font-medium rounded-lg transition-colors duration-200`;
    
    // Stocker le callback
    confirmationCallback = config.callback;
    
    // Afficher le modal
    const modal = document.getElementById('confirmationModal');
    modal.classList.remove('hidden');
    
    // Animation d'entrée
    const content = modal.querySelector('.relative');
    content.classList.add('modal-enter');
    setTimeout(() => {
        content.classList.remove('modal-enter');
        content.classList.add('modal-enter-active');
    }, 50);
}

function closeConfirmationModal() {
    const modal = document.getElementById('confirmationModal');
    const content = modal.querySelector('.relative');
    
    content.classList.remove('modal-enter-active');
    content.classList.add('modal-exit-active');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        content.classList.remove('modal-exit-active');
        confirmationCallback = null;
    }, 300);
}

function executeConfirmAction() {
    if (confirmationCallback && typeof confirmationCallback === 'function') {
        confirmationCallback();
    }
    closeConfirmationModal();
}

// Fonctions de convenance pour les confirmations
function confirmDelete(callback, itemName = 'cet élément') {
    showConfirmationModal({
        title: 'Confirmer la suppression',
        message: `Êtes-vous sûr de vouloir supprimer ${itemName} ? Cette action est irréversible.`,
        confirmText: 'Supprimer',
        confirmClass: 'bg-red-600 hover:bg-red-700',
        iconClass: 'fas fa-trash',
        iconBg: 'bg-red-100',
        iconColor: 'text-red-600',
        callback: callback
    });
}

function confirmToggle(callback, action = 'cette action') {
    showConfirmationModal({
        title: 'Confirmer l\'action',
        message: `Êtes-vous sûr de vouloir effectuer ${action} ?`,
        confirmText: 'Continuer',
        confirmClass: 'bg-blue-600 hover:bg-blue-700',
        iconClass: 'fas fa-sync',
        iconBg: 'bg-blue-100',
        iconColor: 'text-blue-600',
        callback: callback
    });
}

/**
 * Intégration avec Laravel
 */
document.addEventListener('DOMContentLoaded', function() {
    // Afficher les messages de session Laravel
    @if(session('success'))
        showSuccessToast(`{{ session('success') }}`);
    @endif

    @if(session('error'))
        showErrorToast(`{{ session('error') }}`);
    @endif

    @if(session('warning'))
        showWarningToast(`{{ session('warning') }}`);
    @endif

    @if(session('info'))
        showInfoToast(`{{ session('info') }}`);
    @endif

    @if($errors->any())
        @if($errors->count() === 1)
            showErrorToast(`{{ $errors->first() }}`, 'Erreur de validation');
        @else
            let errorMessage = 'Plusieurs erreurs ont été détectées:\n';
            @foreach($errors->all() as $error)
                errorMessage += '• {{ $error }}\n';
            @endforeach
            showErrorToast(errorMessage, 'Erreurs de validation', 8000);
        @endif
    @endif
});

// Gestion des clics en dehors du modal
document.addEventListener('click', function(e) {
    const modal = document.getElementById('confirmationModal');
    if (e.target === modal) {
        closeConfirmationModal();
    }
});

// Gestion de la touche Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('confirmationModal');
        if (!modal.classList.contains('hidden')) {
            closeConfirmationModal();
        }
    }
});

// Fonctions utilitaires pour les formulaires
function confirmFormSubmission(formId, message = null) {
    const form = document.getElementById(formId);
    if (!form) return;
    
    const defaultMessage = 'Êtes-vous sûr de vouloir soumettre ce formulaire ?';
    
    showConfirmationModal({
        message: message || defaultMessage,
        callback: function() {
            form.submit();
        }
    });
}

function confirmDeleteForm(formId, itemName = 'cet élément') {
    const form = document.getElementById(formId);
    if (!form) return;
    
    confirmDelete(function() {
        form.submit();
    }, itemName);
}

// Utilitaires pour les actions en lot
function confirmBulkAction(formId, action, selectedCount) {
    const form = document.getElementById(formId);
    if (!form) return;
    
    showConfirmationModal({
        title: 'Confirmer l\'action en lot',
        message: `Êtes-vous sûr de vouloir ${action} ${selectedCount} élément(s) sélectionné(s) ?`,
        callback: function() {
            form.submit();
        }
    });
}
</script>
