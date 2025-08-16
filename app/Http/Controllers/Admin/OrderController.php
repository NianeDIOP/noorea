<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product'])
            ->orderBy('created_at', 'desc');

        // Filtres
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->paginate(20);

        // Statistiques pour le dashboard
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::pending()->count(),
            'confirmed_orders' => Order::confirmed()->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'delivered_orders' => Order::where('status', 'delivered')->count(),
            'total_revenue' => Order::whereIn('status', ['confirmed', 'processing', 'shipped', 'delivered'])->sum('total'),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Show the form for creating a new order (manual)
     */
    public function create()
    {
        // Récupérer les produits actifs pour la sélection
        $products = \App\Models\Product::where('status', 'active')
            ->where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'price' => $product->price,
                    'final_price' => $product->final_price,
                    'formatted_price' => number_format($product->final_price, 0, ',', ' ') . ' FCFA',
                    'stock_quantity' => $product->stock_quantity,
                    'images' => $product->images ? array_map(function($image) {
                        return \Storage::url($image);
                    }, $product->images) : ['/images/placeholder.png']
                ];
            });

        return view('admin.orders.create', compact('products'));
    }

    /**
     * Store a manually created order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'shipping_fee' => 'required|numeric|min:0',
            'payment_status' => ['required', Rule::in(['pending', 'partial', 'paid'])],
            'notes' => 'nullable|string',
        ]);

        \DB::beginTransaction();
        
        try {
            // Créer la commande
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'shipping_address' => $validated['shipping_address'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'shipping_fee' => $validated['shipping_fee'],
                'payment_status' => $validated['payment_status'],
                'status' => 'confirmed', // Commande manuelle directement confirmée
                'confirmed_at' => now(),
                'subtotal' => 0, // Calculé après
                'total' => 0, // Calculé après
                'notes' => $validated['notes'],
                'payment_method' => 'manual',
            ]);

            $subtotal = 0;

            // Ajouter les articles
            foreach ($validated['products'] as $productData) {
                $product = \App\Models\Product::findOrFail($productData['id']);
                $quantity = $productData['quantity'];
                $price = $product->final_price; // Prix avec réduction si applicable
                $itemTotal = $price * $quantity;
                
                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'product_price' => $price,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                    'product_snapshot' => [
                        'name' => $product->name,
                        'price' => $price,
                        'image' => $product->images[0] ?? null,
                    ],
                ]);

                $subtotal += $itemTotal;

                // Décrémenter le stock
                if ($product->track_stock ?? true) {
                    $product->decrement('stock_quantity', $quantity);
                }
            }

            // Mettre à jour les totaux
            $total = $subtotal + $validated['shipping_fee'];
            $order->update([
                'subtotal' => $subtotal,
                'total' => $total,
            ]);

            \DB::commit();

            return redirect()
                ->route('admin.orders.show', $order)
                ->with('success', 'Commande manuelle créée avec succès.');

        } catch (\Exception $e) {
            \DB::rollback();
            return back()
                ->withErrors(['error' => 'Erreur lors de la création de la commande.'])
                ->withInput();
        }
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order
     */
    public function edit(Order $order)
    {
        $order->load(['user', 'items.product']);
        
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])],
            'payment_status' => ['required', Rule::in(['pending', 'partial', 'paid', 'refunded'])],
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'shipping_fee' => 'required|numeric|min:0',
            'tracking_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        // Mise à jour des dates selon le statut
        if ($request->status === 'confirmed' && $order->status !== 'confirmed') {
            $validated['confirmed_at'] = now();
        }

        if ($request->status === 'shipped' && $order->status !== 'shipped') {
            $validated['shipped_at'] = now();
        }

        if ($request->status === 'delivered' && $order->status !== 'delivered') {
            $validated['delivered_at'] = now();
        }

        // Recalcul du total avec les frais de livraison
        $validated['total'] = $order->subtotal + $validated['shipping_fee'];

        $order->update($validated);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Commande mise à jour avec succès.');
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', Rule::in(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])]
        ]);

        $updateData = ['status' => $request->status];

        // Mise à jour des dates selon le statut
        if ($request->status === 'confirmed' && $order->status !== 'confirmed') {
            $updateData['confirmed_at'] = now();
        }

        if ($request->status === 'shipped' && $order->status !== 'shipped') {
            $updateData['shipped_at'] = now();
        }

        if ($request->status === 'delivered' && $order->status !== 'delivered') {
            $updateData['delivered_at'] = now();
        }

        $order->update($updateData);

        return back()->with('success', 'Statut de la commande mis à jour.');
    }

    /**
     * Add note to order
     */
    public function addNote(Request $request, Order $order)
    {
        $request->validate([
            'note' => 'required|string|max:1000'
        ]);

        $currentNotes = $order->notes ? $order->notes . "\n\n" : '';
        $newNote = "[" . now()->format('d/m/Y H:i') . "] " . $request->note;
        
        $order->update([
            'notes' => $currentNotes . $newNote
        ]);

        return back()->with('success', 'Note ajoutée à la commande.');
    }

    /**
     * Generate invoice for order
     */
    public function invoice(Order $order)
    {
        $order->load(['user', 'items.product']);
        
        return view('admin.orders.invoice', compact('order'));
    }

    /**
     * Remove the specified order
     */
    public function destroy(Order $order)
    {
        // Empêcher la suppression des commandes confirmées
        if (in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered'])) {
            return back()->withErrors(['error' => 'Impossible de supprimer une commande confirmée ou en cours de traitement.']);
        }

        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
}
