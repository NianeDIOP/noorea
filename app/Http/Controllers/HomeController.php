<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les 4 catégories principales
        $categories = Category::orderBy('sort_order')->take(4)->get();
        
        // Récupérer toutes les marques
        $brands = Brand::orderBy('name')->get();
        
        // Préparer les descriptions limitées des marques
        $brands->each(function ($brand) {
            $brand->short_description = Str::limit($brand->description, 80);
        });
        
        // Récupérer les 8 produits tendance (produits featured + les plus vus)
        $featuredProducts = Product::where('is_featured', true)
            ->where('status', 'active')
            ->orderBy('views', 'desc')
            ->take(4)
            ->get();
            
        $trendingProducts = Product::where('status', 'active')
            ->orderBy('views', 'desc')
            ->take(8)
            ->get();

        // Récupérer seulement les images hero1 et hero2
        $heroImages = [];
        $heroImagesPath = public_path('images/hero');
        
        // Vérifier spécifiquement hero1.jpg et hero2.jpg
        if (file_exists($heroImagesPath . '/hero1.jpg')) {
            $heroImages[] = 'images/hero/hero1.jpg';
        }
        if (file_exists($heroImagesPath . '/hero2.jpg')) {
            $heroImages[] = 'images/hero/hero2.jpg';
        }
        
        // S'assurer qu'il y a au moins une image
        if (empty($heroImages)) {
            $heroImages = ['images/hero/hero1.jpg'];
        }

        return view('welcome', compact('categories', 'brands', 'featuredProducts', 'trendingProducts', 'heroImages'));
    }
}
