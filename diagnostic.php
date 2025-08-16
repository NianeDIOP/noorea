<?php
/**
 * Script de diagnostic pour noorea.sn
 * À placer dans public/diagnostic.php et visiter via https://noorea.sn/diagnostic.php
 */

// Sécurité : retirer ce script après utilisation
if ($_SERVER['HTTP_HOST'] !== 'noorea.sn' && $_SERVER['HTTP_HOST'] !== 'www.noorea.sn') {
    die('Accès non autorisé');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic Storage - Noorea</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .ok { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .warning { color: orange; font-weight: bold; }
        .section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>🔧 Diagnostic Storage - noorea.sn</h1>
    
    <div class="section">
        <h2>1. Vérifications des dossiers</h2>
        <?php
        $paths = [
            'storage/app/public' => '../storage/app/public',
            'storage/app/public/categories' => '../storage/app/public/categories', 
            'public/storage' => './storage',
            'bootstrap/cache' => '../bootstrap/cache'
        ];
        
        foreach ($paths as $name => $path) {
            $exists = is_dir($path);
            $writable = $exists ? is_writable($path) : false;
            $isLink = is_link($path);
            
            echo "<p><strong>$name:</strong> ";
            if ($exists) {
                echo '<span class="ok">✅ Existe</span>';
                if ($writable) {
                    echo ' | <span class="ok">✅ Écriture OK</span>';
                } else {
                    echo ' | <span class="error">❌ Pas d\'écriture</span>';
                }
                if ($isLink) {
                    echo ' | <span class="ok">🔗 Lien symbolique</span>';
                }
                $perms = substr(sprintf('%o', fileperms($path)), -4);
                echo " | Permissions: $perms";
            } else {
                echo '<span class="error">❌ N\'existe pas</span>';
            }
            echo "</p>";
        }
        ?>
    </div>

    <div class="section">
        <h2>2. Test d'écriture</h2>
        <?php
        try {
            $testFile = '../storage/app/public/test_diagnostic_' . date('YmdHis') . '.txt';
            $content = 'Test de diagnostic - ' . date('Y-m-d H:i:s') . PHP_EOL;
            $content .= 'Server: ' . $_SERVER['HTTP_HOST'] . PHP_EOL;
            $content .= 'User: ' . get_current_user() . PHP_EOL;
            
            $success = file_put_contents($testFile, $content);
            
            if ($success && file_exists($testFile)) {
                echo '<p class="ok">✅ Test d\'écriture réussi</p>';
                echo "<p>Fichier créé: $testFile</p>";
                echo "<p>Taille: " . filesize($testFile) . " octets</p>";
                
                // Nettoyer
                unlink($testFile);
                echo '<p class="ok">✅ Fichier de test supprimé</p>';
            } else {
                echo '<p class="error">❌ Échec de l\'écriture</p>';
            }
        } catch (Exception $e) {
            echo '<p class="error">❌ Erreur: ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
        ?>
    </div>

    <div class="section">
        <h2>3. Configuration PHP</h2>
        <?php
        $phpSettings = [
            'file_uploads' => ini_get('file_uploads') ? 'Activé' : 'Désactivé',
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
            'max_execution_time' => ini_get('max_execution_time'),
            'memory_limit' => ini_get('memory_limit'),
            'max_file_uploads' => ini_get('max_file_uploads')
        ];
        
        foreach ($phpSettings as $setting => $value) {
            $class = 'ok';
            if ($setting === 'file_uploads' && $value === 'Désactivé') $class = 'error';
            if ($setting === 'upload_max_filesize' && intval($value) < 2) $class = 'warning';
            if ($setting === 'post_max_size' && intval($value) < 8) $class = 'warning';
            
            echo "<p><strong>$setting:</strong> <span class=\"$class\">$value</span></p>";
        }
        ?>
    </div>

    <div class="section">
        <h2>4. Variables d'environnement Laravel</h2>
        <?php
        // Simuler le chargement du .env (si accessible)
        $envFile = '../.env';
        if (file_exists($envFile) && is_readable($envFile)) {
            $envContent = file_get_contents($envFile);
            $envLines = explode("\n", $envContent);
            
            $importantVars = ['APP_ENV', 'APP_DEBUG', 'APP_URL', 'FILESYSTEM_DISK'];
            
            foreach ($importantVars as $var) {
                $found = false;
                foreach ($envLines as $line) {
                    if (strpos($line, $var . '=') === 0) {
                        $value = substr($line, strlen($var) + 1);
                        $class = 'ok';
                        
                        if ($var === 'FILESYSTEM_DISK' && $value !== 'public') {
                            $class = 'error';
                        }
                        if ($var === 'APP_ENV' && $value === 'local') {
                            $class = 'warning';
                        }
                        if ($var === 'APP_DEBUG' && $value === 'true') {
                            $class = 'warning';
                        }
                        
                        echo "<p><strong>$var:</strong> <span class=\"$class\">" . htmlspecialchars($value) . "</span></p>";
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    echo "<p><strong>$var:</strong> <span class=\"error\">Non défini</span></p>";
                }
            }
        } else {
            echo '<p class="error">❌ Fichier .env non accessible</p>';
        }
        ?>
    </div>

    <div class="section">
        <h2>5. Actions recommandées</h2>
        <?php
        $hasErrors = false;
        
        // Vérifier les erreurs critiques
        if (!is_dir('../storage/app/public')) {
            echo '<p class="error">❌ Créer le dossier: <code>mkdir -p storage/app/public</code></p>';
            $hasErrors = true;
        }
        
        if (!is_dir('../storage/app/public/categories')) {
            echo '<p class="error">❌ Créer le dossier: <code>mkdir -p storage/app/public/categories</code></p>';
            $hasErrors = true;
        }
        
        if (!is_link('./storage')) {
            echo '<p class="error">❌ Créer le lien symbolique: <code>php artisan storage:link</code></p>';
            $hasErrors = true;
        }
        
        if (!is_writable('../storage/app/public')) {
            echo '<p class="error">❌ Corriger les permissions: <code>chmod -R 775 storage/</code></p>';
            $hasErrors = true;
        }
        
        if (!$hasErrors) {
            echo '<p class="ok">✅ Configuration correcte !</p>';
            echo '<p><strong>N\'oubliez pas de supprimer ce fichier diagnostic.php après utilisation.</strong></p>';
        } else {
            echo '<h3 class="error">Commandes à exécuter :</h3>';
            echo '<pre>';
            echo 'cd /path/to/noorea' . PHP_EOL;
            echo 'mkdir -p storage/app/public/categories' . PHP_EOL;
            echo 'php artisan storage:link' . PHP_EOL;
            echo 'chmod -R 775 storage/' . PHP_EOL;
            echo 'chmod -R 775 bootstrap/cache/' . PHP_EOL;
            echo 'chown -R www-data:www-data storage/' . PHP_EOL;
            echo 'chown -R www-data:www-data bootstrap/cache/' . PHP_EOL;
            echo 'php artisan config:clear' . PHP_EOL;
            echo 'php artisan cache:clear' . PHP_EOL;
            echo '</pre>';
        }
        ?>
    </div>

    <div class="section">
        <h2>6. Informations système</h2>
        <p><strong>PHP Version:</strong> <?= PHP_VERSION ?></p>
        <p><strong>Server:</strong> <?= $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' ?></p>
        <p><strong>Host:</strong> <?= $_SERVER['HTTP_HOST'] ?></p>
        <p><strong>Document Root:</strong> <?= $_SERVER['DOCUMENT_ROOT'] ?></p>
        <p><strong>Current User:</strong> <?= get_current_user() ?></p>
        <p><strong>Current Directory:</strong> <?= getcwd() ?></p>
        <p><strong>Timestamp:</strong> <?= date('Y-m-d H:i:s T') ?></p>
    </div>

    <script>
        // Auto-refresh toutes les 30 secondes si nécessaire
        setTimeout(() => {
            if (confirm('Actualiser le diagnostic ?')) {
                location.reload();
            }
        }, 30000);
    </script>
</body>
</html>
