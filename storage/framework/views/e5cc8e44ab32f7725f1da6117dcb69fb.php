<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e($page['url']); ?></loc>
        <lastmod><?php echo e($page['lastmod']); ?></lastmod>
        <changefreq><?php echo e($page['changefreq']); ?></changefreq>
        <priority><?php echo e($page['priority']); ?></priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</urlset>
<?php /**PATH C:\xampp\htdocs\noorea\resources\views/seo/sitemap.blade.php ENDPATH**/ ?>