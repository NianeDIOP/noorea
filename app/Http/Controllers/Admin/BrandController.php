<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\SimpleImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    use SimpleImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Brand::withCount(['products' => function ($query) {
            $query->where('status', 'active');
        }]);

        // Recherche par nom
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('country', 'LIKE', "%{$search}%")
                  ->orWhere('slug', 'LIKE', "%{$search}%");
            });
        }

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('is_active', $request->get('status') === 'active');
        }

        // Filtre par marques vedettes
        if ($request->filled('featured')) {
            $query->where('is_featured', $request->get('featured') === 'yes');
        }

        // Filtre par pays
        if ($request->filled('country')) {
            $query->where('country', 'LIKE', "%{$request->get('country')}%");
        }

        $brands = $query->orderBy('name')
                       ->paginate(15);

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation avec règles d'images
        $imageRules = $this->getSimpleImageValidationRules($request, 'logo', 'logo_url', 'logo_type', false);
        
        $validator = Validator::make($request->all(), array_merge([
            'name' => 'required|string|max:255|unique:brands,name',
            'slug' => 'nullable|string|max:255|unique:brands,slug',
            'description' => 'nullable|string|max:1000',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ], $imageRules));

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $validator->validated();
        
        // Générer le slug si non fourni
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
            
            // Vérifier l'unicité du slug généré
            $originalSlug = $data['slug'];
            $count = 1;
            while (Brand::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Gérer le logo avec le trait
        try {
            $data['logo'] = $this->handleImageOrUrl(
                $request, 
                'logo', 
                'logo_url', 
                'logo_type'
            );
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withErrors(['logo' => $e->getMessage()])
                           ->withInput();
        }

        // Gérer les checkboxes
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['is_featured'] = $request->has('is_featured') ? true : false;

        // Nettoyer les champs non nécessaires
        unset($data['logo_type'], $data['logo_url']);

        $brand = Brand::create($data);

        return redirect()->route('admin.brands.index')
                       ->with('success', "La marque \"{$brand->name}\" a été créée avec succès.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        $brand->load(['products' => function ($query) {
            $query->where('status', 'active')->take(8);
        }]);

        $stats = [
            'total_products' => $brand->products()->where('status', 'active')->count(),
            'total_value' => $brand->products()->where('status', 'active')->sum('price'),
            'avg_price' => $brand->products()->where('status', 'active')->avg('price') ?? 0,
            'featured_products' => $brand->products()->where('status', 'active')->where('is_featured', true)->count(),
        ];

        return view('admin.brands.show', compact('brand', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        // Validation avec règles d'images
        $imageRules = $this->getSimpleImageValidationRules($request, 'logo', 'logo_url', 'logo_type', false, $brand->logo);
        
        $validator = Validator::make($request->all(), array_merge([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'slug' => 'nullable|string|max:255|unique:brands,slug,' . $brand->id,
            'description' => 'nullable|string|max:1000',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ], $imageRules));

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $validator->validated();
        
        // Générer le slug si modifié et non fourni
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
            
            // Vérifier l'unicité du slug généré (exclure la marque actuelle)
            $originalSlug = $data['slug'];
            $count = 1;
            while (Brand::where('slug', $data['slug'])->where('id', '!=', $brand->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Gérer le logo avec le trait
        try {
            $data['logo'] = $this->handleImageOrUrl(
                $request, 
                'logo', 
                'logo_url', 
                'logo_type',
                $brand->logo
            );
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withErrors(['logo' => $e->getMessage()])
                           ->withInput();
        }

        // Gérer les checkboxes
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['is_featured'] = $request->has('is_featured') ? true : false;

        // Nettoyer les champs non nécessaires
        unset($data['logo_type'], $data['logo_url']);

        $brand->update($data);

        return redirect()->route('admin.brands.index')
                       ->with('success', "La marque \"{$brand->name}\" a été mise à jour avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            // Vérifier s'il y a des produits associés
            if ($brand->products()->count() > 0) {
                return redirect()->route('admin.brands.index')
                               ->with('error', "Impossible de supprimer cette marque car elle contient {$brand->products()->count()} produit(s).");
            }

            $brandName = $brand->name;

            // Supprimer le logo si il existe et n'est pas une URL
            if ($brand->logo && !filter_var($brand->logo, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($brand->logo);
            }

            $brand->delete();

            return redirect()->route('admin.brands.index')
                           ->with('success', "La marque \"{$brandName}\" a été supprimée avec succès.");

        } catch (\Exception $e) {
            return redirect()->route('admin.brands.index')
                           ->with('error', 'Une erreur est survenue lors de la suppression de la marque.');
        }
    }

    /**
     * Toggle the status of the specified brand.
     */
    public function toggleStatus(Brand $brand)
    {
        $brand->is_active = !$brand->is_active;
        $brand->save();

        $status = $brand->is_active ? 'activée' : 'désactivée';
        
        return redirect()->back()
                       ->with('success', "La marque \"{$brand->name}\" a été {$status} avec succès.");
    }

    /**
     * Toggle the featured status of the specified brand.
     */
    public function toggleFeatured(Brand $brand)
    {
        $brand->is_featured = !$brand->is_featured;
        $brand->save();

        $status = $brand->is_featured ? 'mise en avant' : 'retirée de la mise en avant';
        
        return redirect()->back()
                       ->with('success', "La marque \"{$brand->name}\" a été {$status} avec succès.");
    }
}
