<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::query()->with(['orders' => function($query) {
            $query->selectRaw('user_id, count(*) as total_orders, sum(total) as total_spent')
                  ->groupBy('user_id');
        }]);

        // Filtres
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } else {
                $query->where('is_active', false);
            }
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $users = $query->latest()->paginate(20);

        // Statistiques
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'inactive_users' => User::where('is_active', false)->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'new_users' => User::whereMonth('created_at', now()->month)->count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])->sum('total'),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['user', 'admin'])],
            'is_active' => 'boolean',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'is_active' => $request->boolean('is_active', true),
                'email_verified_at' => now(), // Auto-vérifier pour les admins
            ];

            // Gestion de l'avatar
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $userData['avatar'] = $avatarPath;
            }

            $user = User::create($userData);

            DB::commit();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Utilisateur créé avec succès.');

        } catch (\Exception $e) {
            DB::rollback();
            
            // Log l'erreur pour le debugging
            \Log::error('Erreur création utilisateur: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la création de l\'utilisateur: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $user->load(['orders.items.product']);
        
        $stats = [
            'total_orders' => $user->orders()->count(),
            'completed_orders' => $user->orders()->whereIn('status', ['delivered'])->count(),
            'total_spent' => $user->orders()->whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])->sum('total'),
            'average_order' => $user->orders()->whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])->avg('total'),
            'last_order' => $user->orders()->latest()->first()?->created_at,
        ];

        $recentOrders = $user->orders()
            ->with('items.product')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.users.show', compact('user', 'stats', 'recentOrders'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ['required', Rule::in(['user', 'admin'])],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'role' => $validated['role'],
            ];

            // Mise à jour du mot de passe si fourni
            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            // Gestion de l'avatar
            if ($request->hasFile('avatar')) {
                // Supprimer l'ancien avatar
                if ($user->avatar && \Storage::exists('public/' . $user->avatar)) {
                    \Storage::delete('public/' . $user->avatar);
                }
                
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $userData['avatar'] = $avatarPath;
            }

            $user->update($userData);

            DB::commit();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Utilisateur modifié avec succès.');

        } catch (\Exception $e) {
            DB::rollback();
            
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la modification de l\'utilisateur.');
        }
    }

    /**
     * Remove the specified user from storage
     */
    public function destroy(User $user)
    {
        try {
            // Vérifier que l'utilisateur n'est pas le dernier admin
            if ($user->role === 'admin' && User::where('role', 'admin')->where('is_active', true)->count() <= 1) {
                return back()->with('error', 'Impossible de supprimer le dernier administrateur.');
            }

            // Vérifier que l'utilisateur ne supprime pas son propre compte
            if ($user->id === auth()->id()) {
                return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
            }

            // Supprimer l'avatar si il existe
            if ($user->avatar && \Storage::exists('public/' . $user->avatar)) {
                \Storage::delete('public/' . $user->avatar);
            }

            $user->delete();

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Utilisateur supprimé avec succès.');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression de l\'utilisateur.');
        }
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus(User $user)
    {
        try {
            if (!$user->is_active) {
                $user->update(['is_active' => true]);
                $message = 'Utilisateur activé avec succès.';
            } else {
                // Vérifications avant désactivation
                if ($user->role === 'admin' && User::where('role', 'admin')->where('is_active', true)->count() <= 1) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Impossible de désactiver le dernier administrateur.'
                    ]);
                }

                if ($user->id === auth()->id()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Vous ne pouvez pas désactiver votre propre compte.'
                    ]);
                }

                $user->update(['is_active' => false]);
                $message = 'Utilisateur désactivé avec succès.';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $user->is_active ? 'active' : 'inactive'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la modification du statut.'
            ]);
        }
    }

    /**
     * Toggle user role (user/admin)
     */
    public function toggleRole(User $user)
    {
        try {
            // Vérifications pour la modification de rôle
            if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Impossible de retirer les privilèges du dernier administrateur.'
                ]);
            }

            if ($user->id === auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous ne pouvez pas modifier votre propre rôle.'
                ]);
            }

            $newRole = $user->role === 'admin' ? 'user' : 'admin';
            $user->update(['role' => $newRole]);

            return response()->json([
                'success' => true,
                'message' => "Rôle mis à jour vers : " . ($newRole === 'admin' ? 'Administrateur' : 'Utilisateur'),
                'role' => $newRole
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la modification du rôle.'
            ]);
        }
    }
}
