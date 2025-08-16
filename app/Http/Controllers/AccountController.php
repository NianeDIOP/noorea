<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Order;

class AccountController extends Controller
{
    /**
     * Afficher le tableau de bord du compte
     */
    public function index()
    {
        $user = Auth::user();
        
        // Récupérer les commandes récentes
        $recent_orders = Order::where('user_id', $user->id)
                           ->orderBy('created_at', 'desc')
                           ->take(5)
                           ->get();
        
        // Calculer les statistiques
        $stats = [
            'total_orders' => Order::where('user_id', $user->id)->count(),
            'completed_orders' => Order::where('user_id', $user->id)->where('status', 'completed')->count(),
            'total_spent' => Order::where('user_id', $user->id)->where('status', 'completed')->sum('total'),
            'wishlist_items' => 0, // À implémenter avec le système de wishlist
            'loyalty_points' => 850 // Points fictifs pour l'instant
        ];
        
        return view('account.dashboard', compact('user', 'recent_orders', 'stats'));
    }

    /**
     * Afficher le profil utilisateur
     */
    public function profile()
    {
        return view('account.profile');
    }

    /**
     * Mettre à jour le profil
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
        ]);

        Auth::user()->update($request->only('name', 'email', 'phone', 'city', 'address'));

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Afficher les commandes
     */
    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
                      ->with('orderItems.product')
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);
        
        // Statistiques pour la page des commandes
        $stats = [
            'total_orders' => Order::where('user_id', $user->id)->count(),
            'completed_orders' => Order::where('user_id', $user->id)->where('status', 'completed')->count(),
            'pending_orders' => Order::where('user_id', $user->id)->where('status', 'pending')->count(),
            'total_spent' => Order::where('user_id', $user->id)->where('status', 'completed')->sum('total'),
        ];
        
        return view('account.orders', compact('orders', 'stats'));
    }

    /**
     * Afficher une commande spécifique
     */
    public function showOrder($id)
    {
        $order = Order::where('user_id', Auth::id())
                     ->where('id', $id)
                     ->with('items.product')
                     ->firstOrFail();
        
        return view('account.order-detail', compact('order'));
    }

    /**
     * Afficher la wishlist
     */
    public function wishlist()
    {
        return view('account.wishlist');
    }

    /**
     * Afficher les paramètres de sécurité
     */
    public function security()
    {
        return view('account.security');
    }

    /**
     * Changer le mot de passe
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Mot de passe modifié avec succès.');
    }

    /**
     * Afficher les adresses
     */
    public function addresses()
    {
        return view('account.addresses');
    }
}
