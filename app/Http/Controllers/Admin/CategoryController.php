<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::with(['parent', 'subcategories'])
            ->withCount(['products' => function ($query) {
                $query->where('status', 'active');
            }]);

        // Recherche par nom
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('slug', 'LIKE', "%{$search}%");
            });
        }

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('is_active', $request->get('status') === 'active');
        }

        // Filtre par type (parent/sous-catégorie)
        if ($request->filled('type')) {
            if ($request->get('type') === 'parent') {
                $query->whereNull('parent_id');
            } elseif ($request->get('type') === 'subcategory') {
                $query->whereNotNull('parent_id');
            }
        }

        $categories = $query->orderBy('sort_order')
                          ->orderBy('name')
                          ->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')
                                  ->where('is_active', true)
                                  ->orderBy('name')
                                  ->get();

        return view('admin.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|url|max:255',
            'image_type' => 'required|in:upload,url',
            'parent_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Validation personnalisée pour l'image
        $validator->after(function ($validator) use ($request) {
            if ($request->image_type === 'upload' && !$request->hasFile('image')) {
                $validator->errors()->add('image', 'Veuillez sélectionner une image à télécharger.');
            } elseif ($request->image_type === 'url' && !$request->filled('image_url')) {
                $validator->errors()->add('image_url', 'Veuillez saisir une URL d\'image valide.');
            }
        });

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
            while (Category::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Gérer l'image selon le type choisi
        if ($request->image_type === 'upload' && $request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('categories', 'public');
            $data['image'] = $path;
        } elseif ($request->image_type === 'url' && $request->filled('image_url')) {
            $data['image'] = $request->image_url;
        }

        // Nettoyer les champs non nécessaires
        unset($data['image_type'], $data['image_url']);

        // Définir l'ordre de tri par défaut
        if (!isset($data['sort_order'])) {
            $maxOrder = Category::where('parent_id', $data['parent_id'] ?? null)->max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        // Définir is_active par défaut à true si non défini
        $data['is_active'] = $request->has('is_active') ? true : false;

        $category = Category::create($data);

        return redirect()->route('admin.categories.index')
                       ->with('success', "La catégorie \"{$category->name}\" a été créée avec succès.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load(['parent', 'subcategories.products', 'products' => function ($query) {
            $query->where('status', 'active')->take(6);
        }]);

        $stats = [
            'total_products' => $category->products()->where('status', 'active')->count(),
            'subcategories_count' => $category->subcategories()->count(),
            'total_value' => $category->products()->where('status', 'active')->sum('price'),
            'avg_price' => $category->products()->where('status', 'active')->avg('price') ?? 0,
        ];

        return view('admin.categories.show', compact('category', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
                                  ->where('is_active', true)
                                  ->where('id', '!=', $category->id)
                                  ->orderBy('name')
                                  ->get();

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Debug: Log les données reçues
        \Log::info('Category Update Request Data:', [
            'files' => $request->files->keys(),
            'has_image' => $request->hasFile('image'),
            'image_type' => $request->input('image_type'),
            'image_url' => $request->input('image_url'),
            'all_data' => $request->all()
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|url|max:255',
            'image_type' => 'required|in:upload,url',
            'parent_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Validation personnalisée pour empêcher la catégorie d'être son propre parent
        $validator->after(function ($validator) use ($request, $category) {
            if ($request->parent_id == $category->id) {
                $validator->errors()->add('parent_id', 'Une catégorie ne peut pas être son propre parent.');
            }
            
            // Validation pour l'image selon le type - plus flexible
            if ($request->image_type === 'upload') {
                // Pour upload: soit on a un nouveau fichier, soit la catégorie a déjà une image
                if (!$request->hasFile('image') && !$category->image) {
                    $validator->errors()->add('image', 'Veuillez sélectionner une image ou utiliser une URL.');
                }
            } elseif ($request->image_type === 'url') {
                if (!$request->filled('image_url')) {
                    $validator->errors()->add('image_url', 'Veuillez saisir une URL d\'image valide.');
                }
            }
        });

        if ($validator->fails()) {
            \Log::error('Category Update Validation Failed:', [
                'errors' => $validator->errors()->toArray(),
                'input' => $request->all()
            ]);
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $validator->validated();
        
        // Générer le slug si modifié et non fourni
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
            
            // Vérifier l'unicité du slug généré (exclure la catégorie actuelle)
            $originalSlug = $data['slug'];
            $count = 1;
            while (Category::where('slug', $data['slug'])->where('id', '!=', $category->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Gérer l'image selon le type choisi
        if ($request->image_type === 'upload' && $request->hasFile('image')) {
            \Log::info('Processing image upload for category', [
                'category_id' => $category->id,
                'file_name' => $request->file('image')->getClientOriginalName(),
                'file_size' => $request->file('image')->getSize(),
                'mime_type' => $request->file('image')->getMimeType()
            ]);
            
            // Supprimer l'ancienne image si elle existe et n'est pas une URL
            if ($category->image && !filter_var($category->image, FILTER_VALIDATE_URL)) {
                $deleted = Storage::disk('public')->delete($category->image);
                \Log::info('Deleted old image:', ['path' => $category->image, 'success' => $deleted]);
            }
            
            try {
                $image = $request->file('image');
                $path = $image->store('categories', 'public');
                $data['image'] = $path;
                
                \Log::info('Image uploaded successfully:', [
                    'path' => $path,
                    'full_path' => Storage::disk('public')->path($path),
                    'url' => Storage::disk('public')->url($path)
                ]);
                
            } catch (\Exception $e) {
                \Log::error('Image upload failed:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return redirect()->back()
                               ->withErrors(['image' => 'Erreur lors de l\'upload de l\'image: ' . $e->getMessage()])
                               ->withInput();
            }
        } elseif ($request->image_type === 'url' && $request->filled('image_url')) {
            // Supprimer l'ancienne image locale si elle existe et qu'on passe à une URL
            if ($category->image && !filter_var($category->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($category->image);
            }
            
            $data['image'] = $request->image_url;
        }

        // Nettoyer les champs non nécessaires
        unset($data['image_type'], $data['image_url']);

        // Gérer is_active
        $data['is_active'] = $request->has('is_active') ? true : false;

        $category->update($data);

        \Log::info('Category updated successfully:', [
            'category_id' => $category->id,
            'updated_data' => $data
        ]);

        return redirect()->route('admin.categories.index')
                       ->with('success', "La catégorie \"{$category->name}\" a été mise à jour avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Vérifier s'il y a des sous-catégories
            if ($category->subcategories()->count() > 0) {
                return redirect()->route('admin.categories.index')
                               ->with('error', 'Impossible de supprimer cette catégorie car elle contient des sous-catégories.');
            }

            // Vérifier s'il y a des produits associés
            if ($category->products()->count() > 0) {
                return redirect()->route('admin.categories.index')
                               ->with('error', 'Impossible de supprimer cette catégorie car elle contient des produits.');
            }

            $categoryName = $category->name;

            // Supprimer l'image si elle existe et n'est pas une URL
            if ($category->image && !filter_var($category->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($category->image);
            }

            $category->delete();

            return redirect()->route('admin.categories.index')
                           ->with('success', "La catégorie \"{$categoryName}\" a été supprimée avec succès.");

        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')
                           ->with('error', 'Une erreur est survenue lors de la suppression de la catégorie.');
        }
    }

    /**
     * Toggle the status of the specified category.
     */
    public function toggleStatus(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->save();

        $status = $category->is_active ? 'activée' : 'désactivée';
        
        return redirect()->back()
                       ->with('success', "La catégorie \"{$category->name}\" a été {$status} avec succès.");
    }
}
