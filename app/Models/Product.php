<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sale_price',
        'sku',
        'stock_quantity',
        'images',
        'status',
        'is_featured',
        'views',
        'weight',
        'dimensions',
        'category_id',
        'brand_id',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'is_featured' => 'boolean',
        'views' => 'integer',
    ];

    // Relations
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessors
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ') . ' FCFA';
    }

    public function getMainImageAttribute(): ?string
    {
        return $this->images ? $this->images[0] ?? null : null;
    }

    public function getMainImageUrlAttribute(): ?string
    {
        $mainImage = $this->main_image;
        if (!$mainImage) {
            return null;
        }
        
        // Si c'est déjà une URL complète, la retourner telle quelle
        if (filter_var($mainImage, FILTER_VALIDATE_URL)) {
            return $mainImage;
        }
        
        // Si le chemin commence par 'images/', c'est le nouveau système
        if (str_starts_with($mainImage, 'images/')) {
            return asset($mainImage);
        }
        
        // Ancien système - essayer les deux possibilités
        if (file_exists(public_path($mainImage))) {
            return asset($mainImage);
        } elseif (file_exists(public_path('storage/' . $mainImage))) {
            return asset('storage/' . $mainImage);
        }
        
        // Par défaut, retourner avec asset
        return asset($mainImage);
    }

    public function getImagesUrlsAttribute(): array
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }
        
        return array_map(function($image) {
            // Si c'est déjà une URL complète, la retourner telle quelle
            if (filter_var($image, FILTER_VALIDATE_URL)) {
                return $image;
            }
            
            // Si le chemin commence par 'images/', c'est le nouveau système
            if (str_starts_with($image, 'images/')) {
                return asset($image);
            }
            
            // Ancien système - essayer les deux possibilités
            if (file_exists(public_path($image))) {
                return asset($image);
            } elseif (file_exists(public_path('storage/' . $image))) {
                return asset('storage/' . $image);
            }
            
            // Par défaut, retourner avec asset
            return asset($image);
        }, $this->images);
    }

    public function getIsOnSaleAttribute(): bool
    {
        return $this->sale_price && $this->sale_price < $this->price;
    }

    public function getFinalPriceAttribute(): float
    {
        return $this->is_on_sale ? $this->sale_price : $this->price;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views');
    }
}
