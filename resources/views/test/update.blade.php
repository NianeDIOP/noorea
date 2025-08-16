<!DOCTYPE html>
<html>
<head>
    <title>Test Update Image - Noorea</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Test de Mise à Jour d'Image - Catégorie: {{ $category->name }}</h2>
    
    @if(session('success'))
        <div style="color: green; padding: 10px; border: 1px solid green; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div style="color: red; padding: 10px; border: 1px solid red; margin: 10px 0;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="margin: 20px 0;">
        <h3>Image actuelle:</h3>
        @if($category->image)
            @if(filter_var($category->image, FILTER_VALIDATE_URL))
                <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width: 200px; height: auto; border: 1px solid #ddd;">
                <p>Type: URL externe</p>
            @else
                <img src="{{ Storage::disk('public')->url($category->image) }}" alt="{{ $category->name }}" style="width: 200px; height: auto; border: 1px solid #ddd;">
                <p>Type: Fichier local</p>
                <p>Chemin: {{ $category->image }}</p>
                <p>URL complète: {{ Storage::disk('public')->url($category->image) }}</p>
            @endif
        @else
            <p>Aucune image</p>
        @endif
    </div>

    <form action="{{ route('test.update', $category) }}" method="POST" enctype="multipart/form-data" style="margin: 20px 0;">
        @csrf
        
        <div style="margin: 10px 0;">
            <label>Nouvelle Image:</label><br>
            <input type="file" name="image" accept="image/*" required style="padding: 5px;">
        </div>
        
        <div style="margin: 20px 0;">
            <button type="submit" style="padding: 10px 20px; background: blue; color: white; border: none;">
                Mettre à jour l'image
            </button>
        </div>
    </form>
    
    <div style="margin: 20px 0; padding: 10px; background: #f0f0f0;">
        <h3>Liens utiles:</h3>
        <a href="/noorea/public/admin/categories/{{ $category->id }}/edit" style="color: blue;">Interface Admin Normale</a><br>
        <a href="/noorea/public/admin/categories" style="color: blue;">Liste des Catégories Admin</a><br>
        <a href="/noorea/public/test-upload" style="color: blue;">Test Création Catégorie</a>
    </div>
</body>
</html>
