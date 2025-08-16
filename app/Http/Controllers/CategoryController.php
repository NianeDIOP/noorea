<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Affichage de toutes les catégories
     */
    public function index()
    {
        $categories = Category::withCount(['products' => function($query) {
            $query->active();
        }])->orderBy('name')->get();
        
        return view('categories.index', compact('categories'));
    }
    
    /**
     * Affichage d'une catégorie spécifique avec ses produits
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
                           ->orWhere('id', $slug)
                           ->firstOrFail();
        
        $products = Product::active()
                          ->where('category_id', $category->id)
                          ->with(['category', 'brand'])
                          ->paginate(12);
        
        return view('categories.show', compact('category', 'products'));
    }
}
