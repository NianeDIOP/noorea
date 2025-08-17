<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'country',
        'website',
        'is_active',
        'is_featured',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Relations
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessors
    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo) {
            return null;
        }

        // Si c'est déjà une URL complète, la retourner telle quelle
        if (filter_var($this->logo, FILTER_VALIDATE_URL)) {
            return $this->logo;
        }

        // Si le chemin commence par 'images/', c'est le nouveau système
        if (str_starts_with($this->logo, 'images/')) {
            return asset($this->logo);
        }
        
        // Ancien système - essayer les deux possibilités
        if (file_exists(public_path($this->logo))) {
            return asset($this->logo);
        } elseif (file_exists(public_path('storage/' . $this->logo))) {
            return asset('storage/' . $this->logo);
        }
        
        // Par défaut, retourner avec asset
        return asset($this->logo);
    }

    public function getIsLocalAttribute(): bool
    {
        return in_array(strtolower($this->country), ['sénégal', 'senegal', 'sn']);
    }

    public function getProductsCountAttribute(): int
    {
        return $this->products()->active()->count();
    }
}
