<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Afficher le panier complet
     */
    public function index()
    {
        $cart = $this->getCart();
        $total = $this->getCartTotal();
        $itemCount = $this->getCartItemCount();
        
        return view('cart.index', compact('cart', 'total', 'itemCount'));
    }
    
    /**
     * Ajouter un produit au panier
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1|max:99'
        ]);
        
        $product = Product::with(['category', 'brand'])->findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;
        
        $cart = Session::get('cart', []);
        
        if (isset($cart[$product->id])) {
            // Si le produit existe déjà, augmenter la quantité
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            // Nouveau produit dans le panier
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->final_price,
                'original_price' => $product->price,
                'image' => $product->main_image,
                'brand' => $product->brand->name,
                'quantity' => $quantity,
                'is_on_sale' => $product->is_on_sale
            ];
        }
        
        Session::put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier avec succès !',
            'cart_count' => $this->getCartItemCount(),
            'cart_total' => $this->getCartTotal(),
            'formatted_total' => number_format($this->getCartTotal(), 0, ',', '.') . ' FCFA',
            'product' => $cart[$product->id]
        ]);
    }
    
    /**
     * Mettre à jour la quantité d'un produit
     */
    public function update(Request $request)
    {
        $request->validate([
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99'
        ]);
        
        $productId = $request->productId;
        $cart = Session::get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'cart_count' => $this->getCartItemCount(),
                'cart_total' => $this->getCartTotal(),
                'formatted_total' => number_format($this->getCartTotal(), 0, ',', '.') . ' FCFA',
                'item_total' => number_format($cart[$productId]['price'] * $cart[$productId]['quantity'], 0, ',', '.') . ' FCFA'
            ]);
        }
        
        return response()->json(['success' => false], 404);
    }
    
    /**
     * Supprimer un produit du panier
     */
    public function remove(Request $request)
    {
        $request->validate([
            'productId' => 'required|exists:products,id'
        ]);
        
        $productId = $request->productId;
        $cart = Session::get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Produit supprimé du panier',
                'cart_count' => $this->getCartItemCount(),
                'cart_total' => $this->getCartTotal(),
                'formatted_total' => number_format($this->getCartTotal(), 0, ',', '.') . ' FCFA'
            ]);
        }
        
        return response()->json(['success' => false], 404);
    }
    
    /**
     * Vider le panier
     */
    public function clear()
    {
        Session::forget('cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Panier vidé avec succès'
        ]);
    }
    
    /**
     * Récupérer le contenu du panier (AJAX)
     */
    public function getCartContent()
    {
        $cart = $this->getCart();
        $total = $this->getCartTotal();
        $itemCount = $this->getCartItemCount();
        
        return response()->json([
            'cart' => $cart,
            'total' => $total,
            'count' => $itemCount,
            'formatted_total' => number_format($total, 0, ',', '.') . ' FCFA'
        ]);
    }
    
    /**
     * Méthodes utilitaires privées
     */
    private function getCart()
    {
        return Session::get('cart', []);
    }
    
    private function getCartTotal()
    {
        $cart = $this->getCart();
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return $total;
    }
    
    private function getCartItemCount()
    {
        $cart = $this->getCart();
        $count = 0;
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }
}
