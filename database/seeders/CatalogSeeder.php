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
                'description' => 'Nettoyants, sérums, crèmes et masques pour tous types de peau africaine',
                'image' => '/images/categories/soins-visage.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Maquillage',
                'slug' => 'maquillage',
                'description' => 'Teint, yeux, lèvres - Une gamme complète pour sublimer la beauté africaine',
                'image' => '/images/categories/maquillage.jpg',
                'sort_order' => 2,
            ],
            [
                'name' => 'Parfums',
                'slug' => 'parfums',
                'description' => 'Fragrances exotiques et collections exclusives inspirées d\'Afrique',
                'image' => '/images/categories/parfums.jpg',
                'sort_order' => 3,
            ],
            [
                'name' => 'Soins capillaires',
                'slug' => 'soins-capillaires',
                'description' => 'Produits spécialement conçus pour cheveux crépus, frisés et bouclés',
                'image' => '/images/categories/soins-capillaires.jpg',
                'sort_order' => 4,
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
                'description' => 'Marque sénégalaise spécialisée dans les soins naturels au karité pur du Sénégal',
                'logo' => 'https://images.unsplash.com/photo-1556228578-dd6fb11379dd?w=300&h=300&fit=crop&auto=format&bg=ffffff&pad=40',
                'country' => 'Sénégal',
                'website' => 'https://karite-senegal.com',
                'is_featured' => true,
            ],
            [
                'name' => 'Fenty Beauty',
                'slug' => 'fenty-beauty',
                'description' => 'Marque inclusive de Rihanna avec une large gamme de teintes pour toutes les carnations',
                'logo' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=300&h=300&fit=crop&auto=format&bg=ffffff&pad=40',
                'country' => 'États-Unis',
                'website' => 'https://fentybeauty.com',
                'is_featured' => true,
            ],
            [
                'name' => 'Maison Margiela',
                'slug' => 'maison-margiela',
                'description' => 'Parfums de luxe français aux fragrances uniques et sophistiquées',
                'logo' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=300&h=300&fit=crop&auto=format&bg=ffffff&pad=40',
                'country' => 'France',
                'website' => 'https://maisonmargiela.com',
                'is_featured' => true,
            ],
            [
                'name' => 'SheaMoisture',
                'slug' => 'shea-moisture',
                'description' => 'Soins capillaires naturels pour cheveux texturés avec des ingrédients africains',
                'logo' => 'https://images.unsplash.com/photo-1596704017254-9759879b0456?w=300&h=300&fit=crop&auto=format&bg=ffffff&pad=40',
                'country' => 'États-Unis',
                'website' => 'https://sheamoisture.com',
                'is_featured' => true,
            ],
        ];

        foreach ($brands as $brandData) {
            Brand::create($brandData);
        }
    }

    private function createProducts()
    {
        $products = [
            // Soins du visage - Karité du Sénégal
            [
                'name' => 'Crème Hydratante au Karité Pur',
                'short_description' => 'Hydratation intense 24h avec du karité pur du Sénégal',
                'description' => 'Cette crème onctueuse au karité naturel du Sénégal offre une hydratation profonde et durable. Enrichie en vitamines A et E, elle nourrit et protège votre peau tout en lui redonnant souplesse et éclat naturel.',
                'price' => 26200,
                'sale_price' => 23580,
                'sku' => 'NOO-KAR-CRE-001',
                'stock_quantity' => 45,
                'status' => 'active',
                'category_id' => 1, // Soins du visage
                'brand_id' => 1,    // Karité du Sénégal
                'is_featured' => true,
                'views' => 1250,
                'images' => [
                    'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=600&h=600&fit=crop&auto=format&bg=F7EAD5',
                    'https://images.unsplash.com/photo-1616401784845-180882ba9ba8?w=600&h=600&fit=crop&auto=format&bg=F7EAD5'
                ],
            ],
            [
                'name' => 'Sérum Réparateur Karité & Baobab',
                'short_description' => 'Sérum anti-âge aux actifs naturels africains',
                'description' => 'Un sérum concentré qui combine les vertus réparatrices du karité et les propriétés anti-oxydantes du baobab. Idéal pour régénérer la peau mature et prévenir les signes de l\'âge.',
                'price' => 32500,
                'sku' => 'NOO-KAR-SER-002',
                'stock_quantity' => 28,
                'status' => 'active',
                'category_id' => 1, // Soins du visage
                'brand_id' => 1,    // Karité du Sénégal
                'is_featured' => false,
                'views' => 687,
                'images' => ['https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=600&h=600&fit=crop&auto=format&bg=F7EAD5'],
            ],

            // Maquillage - Fenty Beauty
            [
                'name' => 'Fond de Teint Pro Filt\'r - Teinte 330',
                'short_description' => 'Couvrance modulable, fini mat naturel, 24h de tenue',
                'description' => 'Le fond de teint iconique de Fenty Beauty dans une teinte parfaite pour les carnations caramel. Sa formule longue tenue offre une couvrance modulable du naturel à l\'opaque, avec un fini mat sublime.',
                'price' => 39900,
                'sku' => 'NOO-FEN-FDT-003',
                'stock_quantity' => 35,
                'status' => 'active',
                'category_id' => 2, // Maquillage
                'brand_id' => 2,    // Fenty Beauty
                'is_featured' => true,
                'views' => 2150,
                'images' => [
                    'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=600&h=600&fit=crop&auto=format&bg=F7EAD5',
                    'https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=600&h=600&fit=crop&auto=format&bg=F7EAD5'
                ],
            ],
            [
                'name' => 'Rouge à Lèvres Stunna Lip Paint - Uncensored',
                'short_description' => 'Rouge liquide longue tenue, couleur intense',
                'description' => 'Un rouge à lèvres liquide ultra-pigmenté qui offre une couleur vibrante et une tenue exceptionnelle. Sa formule confortable ne dessèche pas les lèvres et résiste aux repas.',
                'price' => 24900,
                'sku' => 'NOO-FEN-RAL-004',
                'stock_quantity' => 52,
                'status' => 'active',
                'category_id' => 2, // Maquillage
                'brand_id' => 2,    // Fenty Beauty
                'is_featured' => false,
                'views' => 1456,
                'images' => ['https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&h=600&fit=crop&auto=format&bg=F7EAD5'],
            ],

            // Parfums - Maison Margiela
            [
                'name' => 'REPLICA Beach Walk',
                'short_description' => 'Eau de Toilette aux notes solaires et marines',
                'description' => 'Une fragrance qui évoque une promenade sur la plage au coucher du soleil. Notes de bergamote, ylang-ylang, noix de coco, et musc blanc pour une évasion olfactive unique.',
                'price' => 89500,
                'sale_price' => 76000,
                'sku' => 'NOO-MAR-EDP-005',
                'stock_quantity' => 18,
                'status' => 'active',
                'category_id' => 3, // Parfums
                'brand_id' => 3,    // Maison Margiela
                'is_featured' => true,
                'views' => 934,
                'images' => [
                    'https://images.unsplash.com/photo-1541643600914-78b084683601?w=600&h=600&fit=crop&auto=format&bg=F7EAD5',
                    'https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?w=600&h=600&fit=crop&auto=format&bg=F7EAD5'
                ],
            ],
            [
                'name' => 'REPLICA Lazy Sunday Morning',
                'short_description' => 'Fragrance cocooning aux notes poudrées',
                'description' => 'L\'essence d\'un dimanche matin paisible capturée dans un flacon. Un mélange délicat de musc blanc, iris, et aldéhydes qui évoque la douceur des draps propres et le calme du dimanche.',
                'price' => 89500,
                'sku' => 'NOO-MAR-EDP-006',
                'stock_quantity' => 22,
                'status' => 'active',
                'category_id' => 3, // Parfums
                'brand_id' => 3,    // Maison Margiela
                'is_featured' => false,
                'views' => 678,
                'images' => ['https://images.unsplash.com/photo-1615634260167-c8cdede054de?w=600&h=600&fit=crop&auto=format&bg=F7EAD5'],
            ],

            // Soins capillaires - SheaMoisture
            [
                'name' => 'Masque Réparateur Karité & Manuka',
                'short_description' => 'Masque intense pour cheveux très secs et abîmés',
                'description' => 'Un masque nourrissant qui répare et fortifie les cheveux crépus, bouclés et frisés. Enrichi en beurre de karité brut et miel de Manuka pour une hydratation profonde et durable.',
                'price' => 18500,
                'sku' => 'NOO-SHE-MAS-007',
                'stock_quantity' => 67,
                'status' => 'active',
                'category_id' => 4, // Soins capillaires
                'brand_id' => 4,    // SheaMoisture
                'is_featured' => true,
                'views' => 1123,
                'images' => ['https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=600&h=600&fit=crop&auto=format&bg=F7EAD5'],
            ],
            [
                'name' => 'Huile Capillaire Coco & Hibiscus',
                'short_description' => 'Huile légère pour brillance et protection',
                'description' => 'Une huile capillaire légère qui nourrit sans alourdir. L\'huile de coco et l\'extrait d\'hibiscus apportent brillance, souplesse et protection contre les agressions extérieures.',
                'price' => 21800,
                'sku' => 'NOO-SHE-HUI-008',
                'stock_quantity' => 41,
                'status' => 'active',
                'category_id' => 4, // Soins capillaires
                'brand_id' => 4,    // SheaMoisture
                'is_featured' => false,
                'views' => 789,
                'images' => ['https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=600&h=600&fit=crop&auto=format&bg=F7EAD5'],
            ],
        ];

        foreach ($products as $productData) {
            $productData['slug'] = Str::slug($productData['name']);
            $productData['meta_title'] = $productData['name'] . ' - Noorea Beauty';
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
