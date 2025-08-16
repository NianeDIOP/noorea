<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;

class SeoController extends Controller
{
    /**
     * Générer le sitemap XML
     */
    public function sitemap()
    {
        $pages = [
            [
                'url' => route('home'),
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'url' => route('products'),
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '0.9'
            ],
            [
                'url' => route('categories'),
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ],
            [
                'url' => route('brands'),
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ],
            [
                'url' => route('about'),
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'url' => route('contact'),
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ]
        ];

        // Ajouter les produits
        $products = Product::where('is_active', true)->get();
        foreach ($products as $product) {
            $pages[] = [
                'url' => route('products.show', $product->slug),
                'lastmod' => $product->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ];
        }

        // Ajouter les catégories
        $categories = Category::where('is_active', true)->get();
        foreach ($categories as $category) {
            $pages[] = [
                'url' => route('categories.show', $category->slug),
                'lastmod' => $category->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // Ajouter les marques
        $brands = Brand::where('is_active', true)->get();
        foreach ($brands as $brand) {
            $pages[] = [
                'url' => route('brands.show', $brand->slug),
                'lastmod' => $brand->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        $sitemap = view('seo.sitemap', compact('pages'));

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Générer le robots.txt
     */
    public function robots()
    {
        $robots = view('seo.robots');

        return response($robots, 200)
            ->header('Content-Type', 'text/plain');
    }
}
