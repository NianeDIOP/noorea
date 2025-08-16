

<?php $__env->startSection('content'); ?>
    <div class="content-section">
        <h2 class="section-title">
            <i class="fas fa-user-edit"></i>
            Mon Profil Personnel
        </h2>

        <!-- Informations générales -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Photo de profil -->
            <div class="lg:col-span-1">
                <div class="text-center">
                    <div class="w-32 h-32 mx-auto bg-gradient-to-r from-noorea-gold to-yellow-400 rounded-full flex items-center justify-center mb-4 shadow-lg">
                        <i class="fas fa-user text-white text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900"><?php echo e(Auth::user()->name); ?></h3>
                    <p class="text-gray-600"><?php echo e(Auth::user()->email); ?></p>
                    <div class="mt-4 flex items-center justify-center text-sm text-gray-500">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Membre depuis <?php echo e(Auth::user()->created_at->format('M Y')); ?>

                    </div>
                </div>
            </div>

            <!-- Statistiques du compte -->
            <div class="lg:col-span-2">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-blue-600"><?php echo e($stats['total_orders'] ?? 0); ?></div>
                        <div class="text-sm text-blue-600 font-medium">Commandes</div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-green-600"><?php echo e(number_format($stats['total_spent'] ?? 0, 0, ',', ' ')); ?></div>
                        <div class="text-sm text-green-600 font-medium">FCFA dépensés</div>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-red-600"><?php echo e($stats['wishlist_items'] ?? 0); ?></div>
                        <div class="text-sm text-red-600 font-medium">Favoris</div>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['addresses_count'] ?? 0); ?></div>
                        <div class="text-sm text-yellow-600 font-medium">Adresses</div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?php echo e(session('success')); ?>

                </div>
            </div>
        <?php endif; ?>

        <!-- Formulaire de modification -->
        <form method="POST" action="<?php echo e(route('account.profile.update')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-noorea-gold"></i>
                        Nom complet *
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="<?php echo e(old('name', Auth::user()->name)); ?>" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-transparent transition-all">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-noorea-gold"></i>
                        Adresse email *
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="<?php echo e(old('email', Auth::user()->email)); ?>" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-transparent transition-all">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone mr-2 text-noorea-gold"></i>
                        Numéro de téléphone
                    </label>
                    <input type="tel" 
                           name="phone" 
                           id="phone" 
                           value="<?php echo e(old('phone', Auth::user()->phone)); ?>"
                           placeholder="+221 XX XXX XX XX"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-transparent transition-all">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Date de naissance -->
                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar mr-2 text-noorea-gold"></i>
                        Date de naissance
                    </label>
                    <input type="date" 
                           name="birth_date" 
                           id="birth_date" 
                           value="<?php echo e(old('birth_date', Auth::user()->birth_date)); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-transparent transition-all">
                    <?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Ville -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-noorea-gold"></i>
                        Ville
                    </label>
                    <input type="text" 
                           name="city" 
                           id="city" 
                           value="<?php echo e(old('city', Auth::user()->city)); ?>"
                           placeholder="Dakar, Thiès, Saint-Louis..."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-transparent transition-all">
                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Pays -->
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-flag mr-2 text-noorea-gold"></i>
                        Pays
                    </label>
                    <select name="country" 
                            id="country"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-noorea-gold focus:border-transparent transition-all">
                        <option value="">Sélectionnez un pays</option>
                        <option value="Sénégal" <?php echo e(old('country', Auth::user()->country) === 'Sénégal' ? 'selected' : ''); ?>>Sénégal</option>
                        <option value="Mali" <?php echo e(old('country', Auth::user()->country) === 'Mali' ? 'selected' : ''); ?>>Mali</option>
                        <option value="Burkina Faso" <?php echo e(old('country', Auth::user()->country) === 'Burkina Faso' ? 'selected' : ''); ?>>Burkina Faso</option>
                        <option value="Côte d'Ivoire" <?php echo e(old('country', Auth::user()->country) === "Côte d'Ivoire" ? 'selected' : ''); ?>>Côte d'Ivoire</option>
                        <option value="Ghana" <?php echo e(old('country', Auth::user()->country) === 'Ghana' ? 'selected' : ''); ?>>Ghana</option>
                        <option value="Autre" <?php echo e(old('country', Auth::user()->country) === 'Autre' ? 'selected' : ''); ?>>Autre</option>
                    </select>
                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Genre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    <i class="fas fa-venus-mars mr-2 text-noorea-gold"></i>
                    Genre
                </label>
                <div class="flex space-x-6">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="female" class="text-noorea-gold focus:ring-noorea-gold" <?php echo e(old('gender', Auth::user()->gender) === 'female' ? 'checked' : ''); ?>>
                        <span class="ml-2">Femme</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="male" class="text-noorea-gold focus:ring-noorea-gold" <?php echo e(old('gender', Auth::user()->gender) === 'male' ? 'checked' : ''); ?>>
                        <span class="ml-2">Homme</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="other" class="text-noorea-gold focus:ring-noorea-gold" <?php echo e(old('gender', Auth::user()->gender) === 'other' ? 'checked' : ''); ?>>
                        <span class="ml-2">Autre</span>
                    </label>
                </div>
                <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Préférences marketing -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-bell mr-2 text-noorea-gold"></i>
                    Préférences de communication
                </h3>
                <div class="space-y-3">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="newsletter" value="1" class="text-noorea-gold focus:ring-noorea-gold" <?php echo e(old('newsletter', Auth::user()->newsletter) ? 'checked' : ''); ?>>
                        <span class="ml-2">Recevoir la newsletter avec les nouveautés et offres spéciales</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="sms_notifications" value="1" class="text-noorea-gold focus:ring-noorea-gold" <?php echo e(old('sms_notifications', Auth::user()->sms_notifications) ? 'checked' : ''); ?>>
                        <span class="ml-2">Recevoir des notifications SMS pour le suivi des commandes</span>
                    </label>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="<?php echo e(route('account.dashboard')); ?>" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour au tableau de bord
                </a>
                
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
    
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Photo de profil -->
        <div class="lg:col-span-1">
            <div class="bg-gray-50 rounded-lg p-6 text-center">
                <div class="w-24 h-24 bg-noorea-gold rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-3xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2"><?php echo e(Auth::user()->name); ?></h3>
                <p class="text-gray-600 mb-4"><?php echo e(Auth::user()->email); ?></p>
                <button class="text-noorea-gold hover:text-yellow-600 text-sm">
                    <i class="fas fa-camera mr-1"></i>
                    Changer la photo
                </button>
            </div>
        </div>

        <!-- Informations personnelles -->
        <div class="lg:col-span-2">
            <form method="POST" action="<?php echo e(route('account.profile.update')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="space-y-6">
                    <!-- Informations de base -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Informations personnelles</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nom complet <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="<?php echo e(old('name', Auth::user()->name)); ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="<?php echo e(old('email', Auth::user()->email)); ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                    Téléphone
                                </label>
                                <input type="tel" name="phone" id="phone" value="<?php echo e(old('phone', Auth::user()->phone)); ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                                    Ville
                                </label>
                                <input type="text" name="city" id="city" value="<?php echo e(old('city', Auth::user()->city)); ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Adresse -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Adresse</h4>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                                Adresse complète
                            </label>
                            <textarea name="address" id="address" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-noorea-gold focus:border-transparent"><?php echo e(old('address', Auth::user()->address)); ?></textarea>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Les champs marqués d'un * sont obligatoires
                        </div>
                        <div class="space-x-3">
                            <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                Annuler
                            </button>
                            <button type="submit" class="px-4 py-2 bg-noorea-gold text-white rounded-lg hover:bg-yellow-600">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistiques du compte -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shopping-bag text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Commandes</p>
                    <p class="text-xl font-bold text-gray-900">0</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-heart text-pink-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Favoris</p>
                    <p class="text-xl font-bold text-gray-900">0</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-star text-yellow-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Points</p>
                    <p class="text-xl font-bold text-gray-900">0</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('account.layouts.client', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\noorea\resources\views/account/profile.blade.php ENDPATH**/ ?>