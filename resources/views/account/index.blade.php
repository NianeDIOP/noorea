@extends('layouts.app')

@section('title', 'Mon Compte - Noorea')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- En-tête -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-noorea-gold rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Mon Compte</h1>
                    <p class="text-gray-600">Gérez votre profil et vos commandes</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Menu latéral -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h2 class="font-semibold text-gray-900 mb-4">Navigation</h2>
                    <nav class="space-y-2">
                        <a href="{{ route('account.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 bg-noorea-gold text-white rounded-lg">
                            <i class="fas fa-user"></i>
                            <span>Profil</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Mes commandes</span>
                        </a>
                        <a href="{{ route('wishlist') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-heart"></i>
                            <span>Ma liste de souhaits</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Adresses</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-cog"></i>
                            <span>Paramètres</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Informations personnelles</h2>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Prénom
                                </label>
                                <input type="text" id="first_name" name="first_name" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-noorea-gold focus:border-noorea-gold"
                                       placeholder="Votre prénom">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nom
                                </label>
                                <input type="text" id="last_name" name="last_name" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-noorea-gold focus:border-noorea-gold"
                                       placeholder="Votre nom">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Adresse email
                            </label>
                            <input type="email" id="email" name="email" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-noorea-gold focus:border-noorea-gold"
                                   placeholder="votre@email.com">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Téléphone
                            </label>
                            <input type="tel" id="phone" name="phone" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-noorea-gold focus:border-noorea-gold"
                                   placeholder="+221 XX XXX XX XX">
                        </div>

                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Date de naissance
                            </label>
                            <input type="date" id="birth_date" name="birth_date" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-noorea-gold focus:border-noorea-gold">
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="button" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                                Annuler
                            </button>
                            <button type="submit" class="px-6 py-2 bg-noorea-gold text-white rounded-lg hover:bg-yellow-500">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Statistiques rapides -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="bg-white rounded-lg shadow-md p-4 text-center">
                        <div class="text-2xl font-bold text-noorea-gold">0</div>
                        <div class="text-sm text-gray-600">Commandes</div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-4 text-center">
                        <div class="text-2xl font-bold text-noorea-gold">0</div>
                        <div class="text-sm text-gray-600">Favoris</div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-4 text-center">
                        <div class="text-2xl font-bold text-noorea-gold">0 FCFA</div>
                        <div class="text-sm text-gray-600">Total dépensé</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
