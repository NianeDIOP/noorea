<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;

class BrandController extends Controller
{
    /**
     * Affichage de toutes les marques
     */
    public function index()
    {
        $brands = Brand::withCount(['products' => function($query) {
            $query->active();
        }])->orderBy('name')->get();
        
        return view('brands.index', compact('brands'));
    }
    
    /**
     * Affichage d'une marque spécifique avec ses produits
     */
    public function show($slug)
    {
        $brand = Brand::where('slug', $slug)
                     ->orWhere('id', $slug)
                     ->firstOrFail();
        
        $products = Product::active()
                          ->where('brand_id', $brand->id)
                          ->with(['category', 'brand'])
                          ->paginate(12);
        
        return view('brands.show', compact('brand', 'products'));
    }
}
