<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     */
    protected $description = 'Generate sitemap.xml file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Génération du sitemap en cours...');

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
            ]
        ];

        // Ajouter les produits actifs
        $products = Product::where('status', 'active')->get();
        $this->info('Ajout de ' . $products->count() . ' produits au sitemap');
        
        foreach ($products as $product) {
            $pages[] = [
                'url' => route('products.show', $product->slug ?: $product->id),
                'lastmod' => $product->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ];
        }

        // Ajouter les catégories
        $categories = Category::all();
        $this->info('Ajout de ' . $categories->count() . ' catégories au sitemap');
        
        foreach ($categories as $category) {
            $pages[] = [
                'url' => route('categories.show', $category->slug ?: $category->id),
                'lastmod' => $category->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // Ajouter les marques
        $brands = Brand::all();
        $this->info('Ajout de ' . $brands->count() . ' marques au sitemap');
        
        foreach ($brands as $brand) {
            $pages[] = [
                'url' => route('brands.show', $brand->slug ?: $brand->id),
                'lastmod' => $brand->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // Générer le contenu XML
        $sitemap = view('seo.sitemap', compact('pages'))->render();

        // Sauvegarder dans le fichier public/sitemap.xml
        file_put_contents(public_path('sitemap.xml'), $sitemap);

        $this->info('Sitemap généré avec succès dans public/sitemap.xml');
        $this->info('Total des pages: ' . count($pages));
        
        return Command::SUCCESS;
    }
}
