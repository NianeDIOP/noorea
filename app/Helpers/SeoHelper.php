<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Générer des méta-tags SEO pour les produits
     */
    public static function productMeta($product)
    {
        return [
            'seo_title' => $product->name . ' - ' . ($product->brand ? $product->brand->name : '') . ' | Noorea',
            'seo_description' => self::truncateText($product->description, 160) ?: 'Découvrez ' . $product->name . ' sur Noorea. Cosmétiques et parfums multiculturels premium au Sénégal.',
            'seo_keywords' => implode(', ', [
                $product->name,
                $product->brand ? $product->brand->name : '',
                $product->category ? $product->category->name : '',
                'cosmétiques Sénégal',
                'parfums Dakar',
                'beauté multiculturelle'
            ]),
            'og_title' => $product->name . ' | Noorea',
            'og_description' => self::truncateText($product->description, 300) ?: 'Découvrez ce produit exceptionnel sur Noorea.',
            'og_image' => $product->image ? asset('images/products/' . $product->image) : asset('images/logo.jpg'),
            'canonical_url' => route('products.show', $product->slug)
        ];
    }

    /**
     * Générer des méta-tags SEO pour les catégories
     */
    public static function categoryMeta($category)
    {
        return [
            'seo_title' => $category->name . ' - Cosmétiques et parfums | Noorea',
            'seo_description' => $category->description ? self::truncateText($category->description, 160) : 'Découvrez notre sélection de ' . $category->name . ' sur Noorea. Cosmétiques et parfums multiculturels premium au Sénégal.',
            'seo_keywords' => implode(', ', [
                $category->name,
                'cosmétiques ' . strtolower($category->name),
                'parfums ' . strtolower($category->name),
                'beauté multiculturelle',
                'Sénégal',
                'Dakar'
            ]),
            'og_title' => $category->name . ' | Noorea',
            'og_description' => $category->description ? self::truncateText($category->description, 300) : 'Explorez notre collection de ' . strtolower($category->name) . '.',
            'og_image' => $category->image ? asset('images/categories/' . $category->image) : asset('images/logo.jpg'),
            'canonical_url' => route('categories.show', $category->slug)
        ];
    }

    /**
     * Générer des méta-tags SEO pour les marques
     */
    public static function brandMeta($brand)
    {
        return [
            'seo_title' => $brand->name . ' - Marque de cosmétiques | Noorea',
            'seo_description' => $brand->description ? self::truncateText($brand->description, 160) : 'Découvrez tous les produits de la marque ' . $brand->name . ' sur Noorea. Cosmétiques et parfums multiculturels premium au Sénégal.',
            'seo_keywords' => implode(', ', [
                $brand->name,
                'marque ' . $brand->name,
                'cosmétiques ' . $brand->name,
                'parfums ' . $brand->name,
                'beauté multiculturelle',
                'Sénégal'
            ]),
            'og_title' => $brand->name . ' | Noorea',
            'og_description' => $brand->description ? self::truncateText($brand->description, 300) : 'Tous les produits de la marque ' . $brand->name . '.',
            'og_image' => $brand->logo ? asset('images/brands/' . $brand->logo) : asset('images/logo.jpg'),
            'canonical_url' => route('brands.show', $brand->slug)
        ];
    }

    /**
     * Générer un Schema.org pour les produits
     */
    public static function productSchema($product)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => $product->description ?: $product->short_description,
            'image' => $product->main_image_url ?: asset('images/logo.jpg'),
            'brand' => [
                '@type' => 'Brand',
                'name' => $product->brand ? $product->brand->name : 'Noorea'
            ],
            'category' => $product->category ? $product->category->name : 'Cosmétiques',
            'sku' => $product->sku ?: 'NOOREA-' . $product->id,
            'mpn' => $product->sku ?: 'NOOREA-' . $product->id,
            'offers' => [
                '@type' => 'Offer',
                'url' => route('products.show', $product->slug),
                'priceCurrency' => 'XOF',
                'price' => number_format($product->final_price, 0, '', ''),
                'priceValidUntil' => now()->addMonth()->format('Y-m-d'),
                'itemCondition' => 'https://schema.org/NewCondition',
                'availability' => $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                'seller' => [
                    '@type' => 'Organization',
                    'name' => 'Noorea',
                    'url' => config('app.url')
                ],
                'shippingDetails' => [
                    '@type' => 'OfferShippingDetails',
                    'shippingRate' => [
                        '@type' => 'MonetaryAmount',
                        'value' => '0',
                        'currency' => 'XOF'
                    ],
                    'shippingDestination' => [
                        '@type' => 'DefinedRegion',
                        'addressCountry' => 'SN'
                    ]
                ]
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.5',
                'reviewCount' => '10'
            ],
            'review' => [
                '@type' => 'Review',
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => '4.5',
                    'bestRating' => '5'
                ],
                'author' => [
                    '@type' => 'Person',
                    'name' => 'Client Noorea'
                ]
            ]
        ];
    }

    /**
     * Tronquer le texte pour les descriptions
     */
    private static function truncateText($text, $limit)
    {
        if (!$text) return null;
        
        $text = strip_tags($text);
        if (strlen($text) <= $limit) {
            return $text;
        }
        
        return substr($text, 0, $limit - 3) . '...';
    }

    /**
     * Générer les méta-tags par défaut
     */
    public static function defaultMeta()
    {
        return [
            'seo_title' => 'Noorea - Boutique de cosmétiques et parfums multiculturels premium au Sénégal',
            'seo_description' => 'Découvrez Noorea, votre destination beauté multiculturelle à Dakar. Cosmétiques authentiques, parfums d\'exception et soins naturels issus des traditions du monde entier.',
            'seo_keywords' => 'cosmétiques Sénégal, parfums Dakar, beauté multiculturelle, maquillage africain, soins naturels, Noorea boutique',
            'og_title' => 'Noorea - L\'expérience beauté multiculturelle',
            'og_description' => 'Révélez votre lumière avec Noorea.',
            'og_image' => asset('images/logo.jpg')
        ];
    }

    /**
     * Générer les méta-tags pour la page boutique
     */
    public static function shopMeta()
    {
        return [
            'seo_title' => 'Boutique - Cosmétiques et parfums multiculturels | Noorea',
            'seo_description' => 'Découvrez notre boutique en ligne de cosmétiques et parfums multiculturels. Produits authentiques, qualité premium, livraison gratuite au Sénégal dès 50 000 FCFA.',
            'seo_keywords' => 'boutique cosmétiques Sénégal, acheter parfums Dakar, maquillage en ligne, soins beauté multiculturelle, e-commerce beauté Sénégal',
            'og_title' => 'Boutique Noorea - Cosmétiques multiculturels',
            'og_description' => 'Explorez notre collection exclusive de cosmétiques et parfums multiculturels.',
            'og_image' => asset('images/logo.jpg')
        ];
    }

    /**
     * Générer les méta-tags pour la page blog
     */
    public static function blogMeta()
    {
        return [
            'seo_title' => 'Beauté du Monde - Blog beauté multiculturelle | Noorea',
            'seo_description' => 'Découvrez les secrets de beauté du monde entier. Articles sur les rituels beauté, conseils maquillage et soins naturels inspirés des traditions multiculturelles.',
            'seo_keywords' => 'blog beauté, rituels beauté monde, conseils maquillage, soins naturels traditionnels, beauté multiculturelle',
            'og_title' => 'Blog Beauté du Monde | Noorea',
            'og_description' => 'Explorez les traditions beauté du monde entier.',
            'og_image' => asset('images/logo.jpg')
        ];
    }

    /**
     * Générer des données structurées pour l'organisation
     */
    public static function organizationSchema()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Noorea',
            'description' => 'Boutique de cosmétiques et parfums multiculturels premium au Sénégal',
            'url' => config('app.url'),
            'logo' => asset('images/logo.jpg'),
            'foundingDate' => '2024',
            'founders' => [
                '@type' => 'Person',
                'name' => 'Niane DIOP'
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'SN',
                'addressLocality' => 'Dakar',
                'addressRegion' => 'Dakar'
            ],
            'contactPoint' => [
                [
                    '@type' => 'ContactPoint',
                    'contactType' => 'customer service',
                    'telephone' => '+221781029818',
                    'availableLanguage' => ['French', 'Wolof'],
                    'areaServed' => 'SN'
                ]
            ],
            'sameAs' => [
                'https://www.instagram.com/noorea.beauty',
                'https://www.facebook.com/noorea.beauty'
            ],
            'currenciesAccepted' => 'XOF',
            'paymentAccepted' => ['Cash', 'Credit Card', 'Orange Money', 'Wave', 'Free Money'],
            'priceRange' => '$$-$$$'
        ];
    }

    /**
     * Générer des données structurées pour une page de catégorie
     */
    public static function categorySchema($category)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => $category->name,
            'description' => $category->description ?: 'Collection de produits ' . strtolower($category->name) . ' chez Noorea',
            'url' => route('categories.show', $category->slug),
            'image' => $category->image ? asset('images/categories/' . $category->image) : asset('images/logo.jpg'),
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => 'Noorea',
                'url' => config('app.url')
            ]
        ];
    }

    /**
     * Générer des données structurées pour une page de marque
     */
    public static function brandSchema($brand)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Brand',
            'name' => $brand->name,
            'description' => $brand->description ?: 'Marque ' . $brand->name . ' disponible chez Noorea',
            'url' => route('brands.show', $brand->slug),
            'logo' => $brand->logo ? asset('images/brands/' . $brand->logo) : asset('images/logo.jpg'),
            'sameAs' => $brand->website ? [$brand->website] : []
        ];
    }

    /**
     * Générer le fil d'Ariane structuré
     */
    public static function breadcrumbSchema($items)
    {
        $listItems = [];
        
        foreach ($items as $index => $item) {
            $listItems[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => isset($item['url']) ? $item['url'] : null
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems
        ];
    }
}
