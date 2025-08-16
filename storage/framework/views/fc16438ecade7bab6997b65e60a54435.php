<!DOCTYPE html>
<html>
<head>
    <title>Test Update Image - Noorea</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>
    <h2>Test de Mise à Jour d'Image - Catégorie: <?php echo e($category->name); ?></h2>
    
    <?php if(session('success')): ?>
        <div style="color: green; padding: 10px; border: 1px solid green; margin: 10px 0;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    
    <?php if($errors->any()): ?>
        <div style="color: red; padding: 10px; border: 1px solid red; margin: 10px 0;">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div style="margin: 20px 0;">
        <h3>Image actuelle:</h3>
        <?php if($category->image): ?>
            <?php if(filter_var($category->image, FILTER_VALIDATE_URL)): ?>
                <img src="<?php echo e($category->image); ?>" alt="<?php echo e($category->name); ?>" style="width: 200px; height: auto; border: 1px solid #ddd;">
                <p>Type: URL externe</p>
            <?php else: ?>
                <img src="<?php echo e(Storage::disk('public')->url($category->image)); ?>" alt="<?php echo e($category->name); ?>" style="width: 200px; height: auto; border: 1px solid #ddd;">
                <p>Type: Fichier local</p>
                <p>Chemin: <?php echo e($category->image); ?></p>
                <p>URL complète: <?php echo e(Storage::disk('public')->url($category->image)); ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p>Aucune image</p>
        <?php endif; ?>
    </div>

    <form action="<?php echo e(route('test.update', $category)); ?>" method="POST" enctype="multipart/form-data" style="margin: 20px 0;">
        <?php echo csrf_field(); ?>
        
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
        <a href="/noorea/public/admin/categories/<?php echo e($category->id); ?>/edit" style="color: blue;">Interface Admin Normale</a><br>
        <a href="/noorea/public/admin/categories" style="color: blue;">Liste des Catégories Admin</a><br>
        <a href="/noorea/public/test-upload" style="color: blue;">Test Création Catégorie</a>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\noorea\resources\views/test/update.blade.php ENDPATH**/ ?>