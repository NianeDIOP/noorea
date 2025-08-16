<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    use HandlesImageUploads;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('brand', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filtres
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured === 'yes');
        }

        if ($request->filled('stock')) {
            if ($request->stock === 'in_stock') {
                $query->where('stock_quantity', '>', 0);
            } elseif ($request->stock === 'out_of_stock') {
                $query->where('stock_quantity', '<=', 0);
            }
        }

        // Tri
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        $query->orderBy($sortBy, $sortOrder);

        $products = $query->paginate(12)->withQueryString();

        // Données pour les filtres
        $categories = Category::active()->orderBy('name')->get();
        $brands = Brand::active()->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();
        $brands = Brand::active()->orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation avec règles d'images
        $imageRules = $this->getImageValidationRules($request, 'image', 'image_url_input', 'image_type', false);
        
        $validated = $request->validate(array_merge([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'sku' => 'required|string|max:100|unique:products,sku',
            'stock_quantity' => 'required|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => ['required', Rule::in(['draft', 'active', 'inactive'])],
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ], $imageRules));

        // Génération du slug
        $validated['slug'] = Str::slug($validated['name']);
        $originalSlug = $validated['slug'];
        $counter = 1;
        
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Gestion de l'image avec le trait
        $images = [];
        try {
            $imagePath = $this->handleImageUpload(
                $request, 
                'image', 
                'image_url_input', 
                'image_type', 
                'products'
            );
            
            if ($imagePath) {
                // Pour les produits, on stocke l'URL complète dans le tableau images
                if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                    $images[] = $imagePath; // URL externe
                } else {
                    $images[] = Storage::disk('public')->url($imagePath); // URL locale
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withErrors(['image' => $e->getMessage()])
                           ->withInput();
        }

        $validated['images'] = $images;

        // Convertir is_featured en boolean
        $validated['is_featured'] = $request->has('is_featured');

        // Supprimer les champs temporaires
        unset($validated['image_type'], $validated['image_url_input']);

        $product = Product::create($validated);

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'orderItems.order']);
        
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->orderBy('name')->get();
        $brands = Brand::active()->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validation avec règles d'images
        $imageRules = $this->getImageValidationRules($request, 'image', 'image_url_input', 'image_type', false, !empty($product->images));
        
        $validated = $request->validate(array_merge([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'sku' => ['required', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($product->id)],
            'stock_quantity' => 'required|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'status' => ['required', Rule::in(['draft', 'active', 'inactive'])],
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ], $imageRules));

        // Mise à jour du slug si le nom a changé
        if ($validated['name'] !== $product->name) {
            $slug = Str::slug($validated['name']);
            $originalSlug = $slug;
            $counter = 1;
            
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            $validated['slug'] = $slug;
        }

        // Gestion des images avec le trait
        $images = $product->images ?? [];
        
        // Si on veut changer l'image
        if ($request->filled('image_type')) {
            try {
                // Pour les produits, on utilise le premier chemin d'image existant comme référence
                $currentImagePath = null;
                if (!empty($images)) {
                    $firstImage = $images[0];
                    if (!filter_var($firstImage, FILTER_VALIDATE_URL)) {
                        // C'est une URL locale, extraire le chemin
                        $currentImagePath = str_replace('/storage/', '', $firstImage);
                    }
                }
                
                $newImagePath = $this->handleImageUpload(
                    $request, 
                    'image', 
                    'image_url_input', 
                    'image_type', 
                    'products',
                    $currentImagePath
                );
                
                if ($newImagePath) {
                    // Supprimer les anciennes images locales si on a une nouvelle image
                    if ($request->hasFile('image') || $request->filled('image_url_input')) {
                        foreach ($images as $image) {
                            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                                $oldPath = str_replace('/storage/', '', $image);
                                $this->deleteImage($oldPath);
                            }
                        }
                    }
                    
                    // Définir la nouvelle image
                    if (filter_var($newImagePath, FILTER_VALIDATE_URL)) {
                        $images = [$newImagePath]; // URL externe
                    } else {
                        $images = [Storage::disk('public')->url($newImagePath)]; // URL locale
                    }
                }
                
            } catch (\Exception $e) {
                return redirect()->back()
                               ->withErrors(['image' => $e->getMessage()])
                               ->withInput();
            }
        }

        $validated['images'] = $images;

        // Convertir is_featured en boolean
        $validated['is_featured'] = $request->has('is_featured');

        // Supprimer les champs temporaires
        unset($validated['image_type'], $validated['image_url_input']);

        $product->update($validated);

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Vérifier s'il y a des commandes associées
        if ($product->orderItems()->exists()) {
            return back()->with('error', 'Impossible de supprimer ce produit car il est associé à des commandes.');
        }

        // Supprimer les images locales
        if ($product->images) {
            foreach ($product->images as $image) {
                if (!filter_var($image, FILTER_VALIDATE_URL)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);

        $status = $product->is_featured ? 'ajouté aux' : 'retiré des';
        
        return back()->with('success', "Produit {$status} produits vedettes.");
    }

    /**
     * Update status
     */
    public function updateStatus(Request $request, Product $product)
    {
        $request->validate([
            'status' => ['required', Rule::in(['draft', 'active', 'inactive'])]
        ]);

        $product->update(['status' => $request->status]);

        return back()->with('success', 'Statut du produit mis à jour.');
    }
}
