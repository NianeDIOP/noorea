<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Helpers\SeoHelper;

class ProductController extends Controller
{
    /**
     * Affichage de la boutique avec filtres
     */
    public function index(Request $request)
    {
        // Récupérer les catégories pour le filtre
        $categories = Category::orderBy('sort_order')->get();
        
        // Récupérer les marques pour le filtre
        $brands = Brand::orderBy('name')->get();
        
        // Récupérer les produits avec leurs relations (sans filtrer par status pour tester)
        $products = Product::with(['category', 'brand'])
                           ->orderBy('created_at', 'desc')
                           ->get();
        
        // Images hero (exactement comme dans HomeController)
        $heroImages = [];
        $heroImagesPath = public_path('images/hero');
        
        // Vérifier si les images existent
        if (file_exists($heroImagesPath . '/hero1.jpg')) {
            $heroImages[] = 'images/hero/hero1.jpg';
        }
        if (file_exists($heroImagesPath . '/hero2.jpg')) {
            $heroImages[] = 'images/hero/hero2.jpg';
        }
        
        // Image par défaut si aucune n'est trouvée
        if (empty($heroImages)) {
            $heroImages = ['images/hero/hero1.jpg'];
        }
        
        return view('products.index', compact('heroImages', 'categories', 'brands', 'products'));
    }
    
    /**
     * Affichage d'un produit spécifique
     */
    public function show($slug)
    {
        // Recherche par slug ou par ID si le slug n'existe pas
        $product = Product::where('slug', $slug)
                         ->orWhere('id', $slug)
                         ->with(['category', 'brand'])
                         ->firstOrFail();
        
        // Produits similaires
        $relatedProducts = Product::where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->limit(4)
                                 ->get();
        
        // Générer les méta-tags SEO
        $seoMeta = SeoHelper::productMeta($product);
        $productSchema = SeoHelper::productSchema($product);
        
        return view('products.show', compact('product', 'relatedProducts', 'seoMeta', 'productSchema'));
    }
    
    /**
     * Incrémenter les vues d'un produit (AJAX)
     */
    public function incrementViews(Product $product)
    {
        $product->incrementViews();
        
        return response()->json(['success' => true, 'views' => $product->views]);
    }
}
