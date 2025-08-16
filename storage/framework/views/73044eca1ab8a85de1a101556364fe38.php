<!DOCTYPE html>
<html>
<head>
    <title>Test Upload Image - Noorea</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>
    <h2>Test d'Upload d'Image pour Catégorie</h2>
    
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

    <form action="<?php echo e(route('test.upload')); ?>" method="POST" enctype="multipart/form-data" style="margin: 20px 0;">
        <?php echo csrf_field(); ?>
        
        <div style="margin: 10px 0;">
            <label>Nom de la catégorie:</label><br>
            <input type="text" name="name" value="Test Upload <?php echo e(time()); ?>" required style="width: 300px; padding: 5px;">
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
        <li>PHP Version: <?php echo e(phpversion()); ?></li>
        <li>Upload Max Filesize: <?php echo e(ini_get('upload_max_filesize')); ?></li>
        <li>Post Max Size: <?php echo e(ini_get('post_max_size')); ?></li>
        <li>File Uploads: <?php echo e(ini_get('file_uploads') ? 'Enabled' : 'Disabled'); ?></li>
        <li>GD Extension: <?php echo e(extension_loaded('gd') ? 'Loaded' : 'Not Loaded'); ?></li>
        <li>Storage Path Writable: <?php echo e(is_writable(storage_path('app/public')) ? 'Yes' : 'No'); ?></li>
    </ul>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\noorea\resources\views/test/upload.blade.php ENDPATH**/ ?>