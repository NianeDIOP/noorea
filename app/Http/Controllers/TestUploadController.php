<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\SimpleImageUpload;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TestUploadController extends Controller
{
    use SimpleImageUpload;
    
    public function index()
    {
        return view('test-upload');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image_type' => 'required|in:upload,url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|url|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        try {
            $imagePath = $this->handleImageOrUrl($request, 'image', 'image_url', 'image_type');
            
            // Créer une catégorie de test
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $imagePath,
                'is_active' => true,
            ]);

            return redirect()->back()->with('success', 'Catégorie créée avec succès! Image: ' . $imagePath . ' | URL: ' . $category->image_url);
            
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Erreur: ' . $e->getMessage()]);
        }
    }
    
    public function getModelType()
    {
        return 'categories';
    }
}
