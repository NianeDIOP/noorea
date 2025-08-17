<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'sort_order',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $attributes = [
        'is_active' => true,
        'sort_order' => 0,
    ];

    // Relations
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeWithProductsCount($query)
    {
        return $query->withCount('products');
    }

    // Accessors
    public function getProductsCountAttribute(): int
    {
        return $this->products()->active()->count();
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }
        
        // Si c'est déjà une URL complète, la retourner telle quelle
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        
        // Si le chemin commence par 'images/', c'est le nouveau système
        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }
        
        // Ancien système - essayer les deux possibilités
        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        } elseif (file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        
        // Par défaut, retourner avec asset
        return asset($this->image);
    }
}
