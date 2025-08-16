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
            'description' => $product->description,
            'image' => $product->image ? asset('images/products/' . $product->image) : asset('images/logo.jpg'),
            'brand' => [
                '@type' => 'Brand',
                'name' => $product->brand ? $product->brand->name : 'Noorea'
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => route('products.show', $product->slug),
                'priceCurrency' => 'XOF',
                'price' => $product->price,
                'itemCondition' => 'https://schema.org/NewCondition',
                'availability' => $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                'seller' => [
                    '@type' => 'Organization',
                    'name' => 'Noorea'
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
}
