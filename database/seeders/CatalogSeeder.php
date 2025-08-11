<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🌱 Création des catégories...');
        $this->createCategories();
        
        $this->command->info('👑 Création des marques...');
        $this->createBrands();
        
        $this->command->info('🛍️ Création des produits...');
        $this->createProducts();
        
        $this->command->info('📦 Création des commandes de test...');
        $this->createOrders();
        
        $this->command->info('✅ Données du catalogue créées avec succès!');
    }

    private function createCategories()
    {
        $categories = [
            [
                'name' => 'Soins du visage',
                'slug' => 'soins-visage',
                'description' => 'Nettoyants, sérums, crèmes et masques pour tous types de peau',
                'image' => 'categories/soins-visage.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Maquillage',
                'slug' => 'maquillage',
                'description' => 'Teint, yeux, lèvres - Une gamme complète pour sublimer votre beauté',
                'image' => 'categories/maquillage.jpg',
                'sort_order' => 2,
            ],
            [
                'name' => 'Parfums',
                'slug' => 'parfums',
                'description' => 'Fragrances exotiques et collections exclusives',
                'image' => 'categories/parfums.jpg',
                'sort_order' => 3,
            ],
            [
                'name' => 'Soins capillaires',
                'slug' => 'soins-capillaires',
                'description' => 'Produits spécialement conçus pour cheveux crépus, frisés et bouclés',
                'image' => 'categories/soins-capillaires.jpg',
                'sort_order' => 4,
            ],
            [
                'name' => 'Bien-être',
                'slug' => 'bien-etre',
                'description' => 'Bougies, huiles de massage et compléments beauté',
                'image' => 'categories/bien-etre.jpg',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }

    private function createBrands()
    {
        $brands = [
            [
                'name' => 'Karité du Sénégal',
                'slug' => 'karite-senegal',
                'description' => 'Marque sénégalaise spécialisée dans les produits à base de karité naturel',
                'logo' => 'brands/karite-senegal.jpg',
                'country' => 'Sénégal',
                'is_featured' => true,
            ],
            [
                'name' => 'Baobab Beauty',
                'slug' => 'baobab-beauty',
                'description' => 'Cosmétiques africains aux extraits de baobab',
                'logo' => 'brands/baobab-beauty.jpg',
                'country' => 'Burkina Faso',
                'is_featured' => true,
            ],
            [
                'name' => 'Fenty Beauty',
                'slug' => 'fenty-beauty',
                'description' => 'Marque inclusive de Rihanna avec une large gamme de teintes',
                'logo' => 'brands/fenty-beauty.jpg',
                'country' => 'États-Unis',
                'is_featured' => true,
            ],
            [
                'name' => 'The Ordinary',
                'slug' => 'the-ordinary',
                'description' => 'Soins de la peau scientifiques et abordables',
                'logo' => 'brands/the-ordinary.jpg',
                'country' => 'Canada',
            ],
            [
                'name' => 'Innisfree',
                'slug' => 'innisfree',
                'description' => 'K-Beauty naturelle de l\'île de Jeju',
                'logo' => 'brands/innisfree.jpg',
                'country' => 'Corée du Sud',
            ],
            [
                'name' => 'Maison Margiela',
                'slug' => 'maison-margiela',
                'description' => 'Parfums de luxe français',
                'logo' => 'brands/maison-margiela.jpg',
                'country' => 'France',
            ],
        ];

        foreach ($brands as $brandData) {
            Brand::create($brandData);
        }
    }

    private function createProducts()
    {
        $products = [
            // Soins du visage
            [
                'name' => 'Crème Hydratante au Karité',
                'short_description' => 'Hydratation intense 24h avec du karité pur du Sénégal',
                'description' => 'Cette crème onctueuse au karité naturel du Sénégal offre une hydratation profonde et durable. Enrichie en vitamines A et E, elle nourrit et protège votre peau tout en lui redonnant souplesse et éclat.',
                'price' => 26200,
                'sale_price' => 23580,
                'sku' => 'NOO-KAR-CRE-001',
                'stock_quantity' => 45,
                'category_id' => 1,
                'brand_id' => 1,
                'is_featured' => true,
                'views' => 1250,
                'images' => ['products/creme-karite-1.jpg', 'products/creme-karite-2.jpg'],
            ],
            [
                'name' => 'Sérum Éclat Vitamine C',
                'short_description' => 'Sérum concentré pour un teint lumineux et uniforme',
                'description' => 'Un sérum puissant à la vitamine C stabilisée qui illumine le teint et réduit les taches pigmentaires. Formulé avec des antioxydants naturels pour protéger la peau des agressions extérieures.',
                'price' => 29500,
                'sku' => 'NOO-VIT-SER-002',
                'stock_quantity' => 32,
                'category_id' => 1,
                'brand_id' => 4,
                'is_featured' => true,
                'views' => 987,
                'images' => ['products/serum-vitc-1.jpg', 'products/serum-vitc-2.jpg'],
            ],
            // Maquillage
            [
                'name' => 'Fond de Teint Inclusif - Teinte Caramel',
                'short_description' => 'Couvrance modulable, fini naturel, 16h de tenue',
                'description' => 'Un fond de teint révolutionnaire disponible en 50 teintes pour célébrer toutes les beautés. Sa formule légère s\'adapte parfaitement à votre carnation pour un teint naturel et éclatant.',
                'price' => 34900,
                'sku' => 'NOO-FEN-FDT-003',
                'stock_quantity' => 28,
                'category_id' => 2,
                'brand_id' => 3,
                'is_featured' => true,
                'views' => 2150,
                'images' => ['products/fdt-fenty-1.jpg', 'products/fdt-fenty-2.jpg'],
            ],
            [
                'name' => 'Rouge à Lèvres Mat - Baobab',
                'short_description' => 'Couleur intense, confort longue durée',
                'description' => 'Un rouge à lèvres mat aux pigments intenses et à la texture crémeuse. Enrichi en huile de baobab pour nourrir vos lèvres tout en offrant une couleur vibrante qui tient toute la journée.',
                'price' => 18700,
                'sku' => 'NOO-BAO-RAL-004',
                'stock_quantity' => 67,
                'category_id' => 2,
                'brand_id' => 2,
                'views' => 756,
                'images' => ['products/ral-baobab-1.jpg'],
            ],
            // Parfums
            [
                'name' => 'Eau de Parfum Fleur de Vanille',
                'short_description' => 'Fragrance gourmande aux notes de vanille de Madagascar',
                'description' => 'Une composition olfactive envoûtante qui mélange la douceur de la vanille de Madagascar aux notes florales d\'ylang-ylang. Un parfum sensuel et réconfortant qui vous accompagne toute la journée.',
                'price' => 49200,
                'sku' => 'NOO-MAR-EDP-005',
                'stock_quantity' => 15,
                'category_id' => 3,
                'brand_id' => 6,
                'is_featured' => true,
                'views' => 634,
                'images' => ['products/edp-vanille-1.jpg', 'products/edp-vanille-2.jpg'],
            ],
            // Soins capillaires
            [
                'name' => 'Huile Capillaire Argan & Karité',
                'short_description' => 'Nutrition intense pour cheveux secs et abîmés',
                'description' => 'Cette huile précieuse combine les bienfaits de l\'argan du Maroc et du karité du Sénégal pour nourrir en profondeur vos cheveux. Idéale pour les cheveux crépus, frisés et bouclés.',
                'price' => 23600,
                'sale_price' => 18950,
                'sku' => 'NOO-KAR-HUI-006',
                'stock_quantity' => 3,
                'category_id' => 4,
                'brand_id' => 1,
                'views' => 892,
                'images' => ['products/huile-cheveux-1.jpg'],
            ],
            // Autres produits
            [
                'name' => 'Masque Hydratant Green Tea',
                'short_description' => 'Masque apaisant au thé vert de Jeju',
                'description' => 'Un masque en tissu gorgé d\'extraits de thé vert bio qui hydrate, apaise et purifie votre peau en 15 minutes. Parfait pour les peaux fatiguées et stressées.',
                'price' => 3500,
                'sku' => 'NOO-INN-MAS-007',
                'stock_quantity' => 120,
                'category_id' => 1,
                'brand_id' => 5,
                'views' => 445,
                'images' => ['products/masque-innisfree-1.jpg'],
            ],
            [
                'name' => 'Bougie Parfumée Cèdre du Sénégal',
                'short_description' => 'Ambiance zen aux notes boisées africaines',
                'description' => 'Une bougie artisanale aux notes chaudes de cèdre du Sénégal et d\'encens. Fabriquée à la main avec de la cire de soja naturelle pour 45h de diffusion parfumée.',
                'price' => 15800,
                'sku' => 'NOO-WEL-BOU-008',
                'stock_quantity' => 25,
                'category_id' => 5,
                'brand_id' => 1,
                'views' => 234,
                'images' => ['products/bougie-cedre-1.jpg'],
            ],
        ];

        foreach ($products as $productData) {
            $productData['slug'] = Str::slug($productData['name']);
            $productData['meta_title'] = $productData['name'] . ' - Noorea';
            $productData['meta_description'] = $productData['short_description'];
            
            Product::create($productData);
        }
    }

    private function createOrders()
    {
        // Créer quelques commandes de test
        $orders = [
            [
                'order_number' => 'NO-2025-000001',
                'user_id' => 2, // Cliente test
                'status' => 'delivered',
                'payment_status' => 'paid',
                'customer_name' => 'Cliente Test',
                'customer_email' => 'cliente@test.com',
                'customer_phone' => '+221 77 987 65 43',
                'shipping_address' => '456 Rue des Clients, Almadies',
                'city' => 'Dakar',
                'subtotal' => 52900,
                'shipping_fee' => 2000,
                'total' => 54900,
                'confirmed_at' => now()->subDays(7),
                'shipped_at' => now()->subDays(5),
                'delivered_at' => now()->subDays(3),
            ],
            [
                'order_number' => 'NO-2025-000002',
                'status' => 'pending',
                'payment_status' => 'pending',
                'customer_name' => 'Aminata Diop',
                'customer_phone' => '+221 76 234 56 78',
                'shipping_address' => '789 Avenue Bourguiba, Plateau',
                'city' => 'Dakar',
                'subtotal' => 29500,
                'shipping_fee' => 0,
                'total' => 29500,
            ],
            [
                'order_number' => 'NO-2025-000003',
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'customer_name' => 'Fatou Sall',
                'customer_phone' => '+221 77 345 67 89',
                'shipping_address' => '12 Rue de la Paix, Medina',
                'city' => 'Dakar',
                'subtotal' => 67300,
                'shipping_fee' => 2500,
                'total' => 69800,
                'confirmed_at' => now()->subDays(2),
            ],
        ];

        foreach ($orders as $orderData) {
            $order = Order::create($orderData);

            // Ajouter des articles à chaque commande
            if ($order->order_number === 'NO-2025-000001') {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => 1,
                    'product_name' => 'Crème Hydratante au Karité',
                    'product_sku' => 'NOO-KAR-CRE-001',
                    'product_price' => 23580,
                    'quantity' => 2,
                    'total' => 47160,
                ]);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => 7,
                    'product_name' => 'Masque Hydratant Green Tea',
                    'product_sku' => 'NOO-INN-MAS-007',
                    'product_price' => 3500,
                    'quantity' => 2,
                    'total' => 7000,
                ]);
            } elseif ($order->order_number === 'NO-2025-000002') {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => 2,
                    'product_name' => 'Sérum Éclat Vitamine C',
                    'product_sku' => 'NOO-VIT-SER-002',
                    'product_price' => 29500,
                    'quantity' => 1,
                    'total' => 29500,
                ]);
            } else {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => 3,
                    'product_name' => 'Fond de Teint Inclusif - Teinte Caramel',
                    'product_sku' => 'NOO-FEN-FDT-003',
                    'product_price' => 34900,
                    'quantity' => 1,
                    'total' => 34900,
                ]);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => 4,
                    'product_name' => 'Rouge à Lèvres Mat - Baobab',
                    'product_sku' => 'NOO-BAO-RAL-004',
                    'product_price' => 18700,
                    'quantity' => 1,
                    'total' => 18700,
                ]);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => 8,
                    'product_name' => 'Bougie Parfumée Cèdre du Sénégal',
                    'product_sku' => 'NOO-WEL-BOU-008',
                    'product_price' => 15800,
                    'quantity' => 1,
                    'total' => 15800,
                ]);
            }
        }
    }
}
