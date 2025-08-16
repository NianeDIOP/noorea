<!DOCTYPE html>
<html>
<head>
    <title>Test Upload Image - Noorea</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Test d'Upload d'Image pour Catégorie</h2>
    
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

    <form action="{{ route('test.upload') }}" method="POST" enctype="multipart/form-data" style="margin: 20px 0;">
        @csrf
        
        <div style="margin: 10px 0;">
            <label>Nom de la catégorie:</label><br>
            <input type="text" name="name" value="Test Upload {{ time() }}" required style="width: 300px; padding: 5px;">
        </div>
        
        <div style="margin: 10px 0;">
            <label>Image:</label><br>
            <input type="file" name="image" accept="image/*" required style="padding: 5px;">
        </div>
        
        <div style="margin: 20px 0;">
            <button type="submit" style="padding: 10px 20px; background: blue; color: white; border: none;">
                Tester Upload
            </button>
        </div>
    </form>
    
    <h3>Informations système:</h3>
    <ul>
        <li>PHP Version: {{ phpversion() }}</li>
        <li>Upload Max Filesize: {{ ini_get('upload_max_filesize') }}</li>
        <li>Post Max Size: {{ ini_get('post_max_size') }}</li>
        <li>File Uploads: {{ ini_get('file_uploads') ? 'Enabled' : 'Disabled' }}</li>
        <li>GD Extension: {{ extension_loaded('gd') ? 'Loaded' : 'Not Loaded' }}</li>
        <li>Storage Path Writable: {{ is_writable(storage_path('app/public')) ? 'Yes' : 'No' }}</li>
    </ul>
</body>
</html>
