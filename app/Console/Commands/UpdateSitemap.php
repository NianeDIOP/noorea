<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category; 
use App\Models\Brand;
use Carbon\Carbon;

class UpdateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the sitemap.xml file with current URLs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Mise à jour du sitemap...');
        
        // Pages statiques principales
        $pages = [
            [
                'url' => config('app.url'),
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'url' => config('app.url') . '/boutique',
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '0.9'
            ],
            [
                'url' => config('app.url') . '/categories',
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ],
            [
                'url' => config('app.url') . '/marques',
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ],
            [
                'url' => config('app.url') . '/blog',
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ],
            [
                'url' => config('app.url') . '/a-propos',
                'lastmod' => Carbon::now()->format('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ]
        ];

        // Ajouter les produits actifs
        $products = Product::where('status', 'active')->get();
        $this->info('📦 Ajout de ' . $products->count() . ' produits au sitemap');
        
        foreach ($products as $product) {
            $pages[] = [
                'url' => config('app.url') . '/produit/' . $product->slug,
                'lastmod' => $product->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ];
        }

        // Ajouter les catégories
        $categories = Category::all();
        $this->info('📂 Ajout de ' . $categories->count() . ' catégories au sitemap');
        
        foreach ($categories as $category) {
            $pages[] = [
                'url' => config('app.url') . '/categorie/' . $category->slug,
                'lastmod' => $category->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // Ajouter les marques
        $brands = Brand::all();
        $this->info('🏷️ Ajout de ' . $brands->count() . ' marques au sitemap');
        
        foreach ($brands as $brand) {
            $pages[] = [
                'url' => config('app.url') . '/marque/' . $brand->slug,
                'lastmod' => $brand->updated_at->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ];
        }

        // Générer le contenu XML
        $sitemap = view('seo.sitemap', compact('pages'))->render();

        // Sauvegarder dans le fichier public/sitemap.xml
        file_put_contents(public_path('sitemap.xml'), $sitemap);

        $this->info('✅ Sitemap mis à jour avec succès dans public/sitemap.xml');
        $this->info('📊 Total des pages: ' . count($pages));
        $this->info('🌐 URL de base: ' . config('app.url'));
        
        // Ping Google pour informer de la mise à jour
        $this->pingSearchEngines();
        
        return Command::SUCCESS;
    }

    /**
     * Ping les moteurs de recherche pour les informer de la mise à jour du sitemap
     */
    private function pingSearchEngines()
    {
        $this->info('🔔 Notification des moteurs de recherche...');
        
        $sitemapUrl = urlencode(config('app.url') . '/sitemap.xml');
        
        // URLs de ping pour les moteurs de recherche
        $pingUrls = [
            'Google' => "https://www.google.com/ping?sitemap={$sitemapUrl}",
            'Bing' => "https://www.bing.com/ping?sitemap={$sitemapUrl}",
        ];

        foreach ($pingUrls as $engine => $pingUrl) {
            try {
                $response = file_get_contents($pingUrl, false, stream_context_create([
                    'http' => [
                        'timeout' => 30,
                        'user_agent' => 'Noorea Sitemap Updater'
                    ]
                ]));
                
                if ($response !== false) {
                    $this->info("✅ {$engine} notifié avec succès");
                } else {
                    $this->warn("⚠️ Impossible de notifier {$engine}");
                }
            } catch (\Exception $e) {
                $this->warn("⚠️ Erreur lors de la notification de {$engine}: " . $e->getMessage());
            }
        }
    }
}
