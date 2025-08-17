<!DOCTYPE html>
<html>
<head>
    <title>Test Upload Image</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test d'upload d'image</h1>
    
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="/test-upload" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Type d'image:</label>
            <select name="image_type" required>
                <option value="upload">Upload fichier</option>
                <option value="url">URL externe</option>
            </select>
        </div>
        
        <div>
            <label>Fichier image:</label>
            <input type="file" name="image" accept="image/*">
        </div>
        
        <div>
            <label>URL image:</label>
            <input type="url" name="image_url" placeholder="https://...">
        </div>
        
        <div>
            <label>Nom de la catégorie:</label>
            <input type="text" name="name" required>
        </div>
        
        <button type="submit">Créer catégorie test</button>
    </form>
    
    <h2>Images dans public/images/categories/:</h2>
    <ul>
        @php
            $imagesDir = public_path('images/categories');
            $images = is_dir($imagesDir) ? scandir($imagesDir) : [];
        @endphp
        
        @foreach ($images as $image)
            @if (!in_array($image, ['.', '..']))
                <li>
                    {{ $image }} 
                    <img src="{{ asset('images/categories/' . $image) }}" style="max-width: 100px; max-height: 100px;" alt="{{ $image }}">
                </li>
            @endif
        @endforeach
    </ul>
</body>
</html>
