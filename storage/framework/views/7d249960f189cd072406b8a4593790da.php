<!DOCTYPE html>
<html>
<head>
    <title>Test Upload Image</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>
    <h1>Test d'upload d'image</h1>
    
    <?php if($errors->any()): ?>
        <div style="color: red;">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <?php if(session('success')): ?>
        <div style="color: green;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    
    <form action="<?php echo e(route('test-upload')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
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
        <?php
            $imagesDir = public_path('images/categories');
            $images = is_dir($imagesDir) ? scandir($imagesDir) : [];
        ?>
        
        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!in_array($image, ['.', '..'])): ?>
                <li>
                    <?php echo e($image); ?> 
                    <img src="<?php echo e(asset('images/categories/' . $image)); ?>" style="max-width: 100px; max-height: 100px;" alt="<?php echo e($image); ?>">
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\noorea\resources\views/test-upload.blade.php ENDPATH**/ ?>