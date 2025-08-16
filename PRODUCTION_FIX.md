# Configuration pour résoudre l'upload d'images sur noorea.sn

## 1. Fichier .env pour la production (à créer sur le serveur)

```env
# Application
APP_NAME="Noorea"
APP_ENV=production
APP_KEY=base64:l9zV/PIAO0XKppKh7eqt+rVVgsDT18O/bnFDuXrVHKI=
APP_DEBUG=false
APP_URL=https://noorea.sn

# CRITIQUE: Configuration de stockage
FILESYSTEM_DISK=public

# Base de données (à adapter selon votre serveur)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=votre_db_noorea
DB_USERNAME=votre_username
DB_PASSWORD=votre_password

# Cache et sessions
CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Logs
LOG_CHANNEL=daily
LOG_LEVEL=error
```

## 2. Commandes à exécuter sur le serveur noorea.sn

```bash
# 1. Naviguer vers le dossier du projet
cd /path/to/noorea

# 2. Créer les dossiers nécessaires
mkdir -p storage/app/public/categories
mkdir -p public/storage

# 3. Créer le lien symbolique
php artisan storage:link

# 4. Permissions critiques
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/
sudo chown -R www-data:www-data public/storage/

sudo chmod -R 775 storage/
sudo chmod -R 775 bootstrap/cache/
sudo chmod -R 775 public/storage/

# 5. Vider le cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 6. Optimiser pour la production
php artisan config:cache
php artisan route:cache
```

## 3. Vérification des permissions sur le serveur

Vérifiez que ces dossiers existent et ont les bonnes permissions :

```bash
# Vérifier la structure
ls -la public/storage
ls -la storage/app/public/categories

# Vérifier les permissions
ls -la storage/app/public/
ls -la public/storage/

# Le lien symbolique doit pointer vers storage/app/public
ls -la public/storage
```

## 4. Configuration PHP sur le serveur

Vérifiez dans php.ini :

```ini
upload_max_filesize = 10M
post_max_size = 12M
max_execution_time = 300
memory_limit = 256M
file_uploads = On
```

## 5. Configuration Apache/Nginx

### Apache (.htaccess dans public/) :
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

<FilesMatch "\.(jpg|jpeg|png|gif|webp)$">
    Header set Cache-Control "max-age=2592000, public"
</FilesMatch>
```

### Nginx :
```nginx
location ~* \.(jpg|jpeg|png|gif|webp)$ {
    expires 30d;
    add_header Cache-Control "public, immutable";
}

client_max_body_size 10M;
```

## 6. Test rapide sur le serveur

Créez un fichier `test_storage.php` dans public/ :

```php
<?php
// Test des permissions de stockage
echo "<h2>Test de stockage - noorea.sn</h2>";

// 1. Vérifier les dossiers
$checks = [
    'storage/app/public exists' => is_dir('../storage/app/public'),
    'storage/app/public writable' => is_writable('../storage/app/public'),
    'public/storage exists' => is_dir('storage'),
    'public/storage is link' => is_link('storage'),
    'categories folder exists' => is_dir('../storage/app/public/categories'),
    'categories writable' => is_writable('../storage/app/public/categories'),
];

foreach ($checks as $check => $result) {
    echo "<p><strong>$check:</strong> " . ($result ? '✅ OK' : '❌ ERREUR') . "</p>";
}

// 2. Test d'écriture
try {
    $testFile = '../storage/app/public/test_write.txt';
    file_put_contents($testFile, 'Test d\'écriture: ' . date('Y-m-d H:i:s'));
    
    if (file_exists($testFile)) {
        echo "<p><strong>Test d'écriture:</strong> ✅ OK</p>";
        unlink($testFile);
    } else {
        echo "<p><strong>Test d'écriture:</strong> ❌ ERREUR</p>";
    }
} catch (Exception $e) {
    echo "<p><strong>Test d'écriture:</strong> ❌ ERREUR - " . $e->getMessage() . "</p>";
}

// 3. Permissions détaillées
echo "<h3>Permissions détaillées:</h3>";
$paths = [
    'storage/app/public' => '../storage/app/public',
    'public/storage' => 'storage',
    'categories' => '../storage/app/public/categories'
];

foreach ($paths as $name => $path) {
    if (file_exists($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        echo "<p><strong>$name:</strong> $perms</p>";
    } else {
        echo "<p><strong>$name:</strong> N'EXISTE PAS</p>";
    }
}
?>
```

Puis visitez : https://noorea.sn/test_storage.php

## 7. Une fois que tout fonctionne

Supprimez le fichier de test :
```bash
rm public/test_storage.php
```
