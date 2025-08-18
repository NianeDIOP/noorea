<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SeoController;

// Inclure les routes admin
require __DIR__.'/admin.php';

// SEO Routes
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

// Page d'accueil
// Routes principales
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages produits
Route::get('/boutique', [ProductController::class, 'index'])->name('products');
Route::get('/produit/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categorie/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/marques', [BrandController::class, 'index'])->name('brands');
Route::get('/marque/{slug}', [BrandController::class, 'show'])->name('brands.show');

// Page promotions
Route::get('/promotions', function () {
    return redirect()->route('products')->with('filter', 'promotions');
})->name('promotions');

// Routes protégées utilisateurs
Route::middleware('auth')->group(function () {
    // Pages compte utilisateur (protégées)
    Route::get('/compte', [AccountController::class, 'index'])->name('account.dashboard');
    Route::get('/compte/profil', [AccountController::class, 'profile'])->name('account.profile');
    Route::put('/compte/profil', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::get('/compte/commandes', [AccountController::class, 'orders'])->name('account.orders');
    Route::get('/compte/commandes/{order}', [AccountController::class, 'showOrder'])->name('account.orders.show');
    Route::get('/compte/wishlist', [AccountController::class, 'wishlist'])->name('account.wishlist');
    Route::get('/compte/adresses', [AccountController::class, 'addresses'])->name('account.addresses');
    Route::get('/compte/securite', [AccountController::class, 'security'])->name('account.security');
    Route::post('/compte/mot-de-passe', [AccountController::class, 'changePassword'])->name('account.password.change');
    
    // Redirections pour compatibilité avec les anciennes routes
    Route::get('/wishlist', [AccountController::class, 'wishlist'])->name('wishlist');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route pour la compatibilité - redirige vers account.dashboard
Route::get('/account', function() {
    return redirect()->route('account.dashboard');
})->name('account');

Route::get('/panier', [CartController::class, 'index'])->name('cart');

// Routes AJAX pour le panier
Route::post('/panier/ajouter', [CartController::class, 'add'])->name('cart.add');
Route::post('/panier/mettre-a-jour', [CartController::class, 'update'])->name('cart.update');
Route::post('/panier/retirer', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/panier/modifier/{productId}', [CartController::class, 'update'])->name('cart.update.old');
Route::delete('/panier/supprimer/{productId}', [CartController::class, 'remove'])->name('cart.remove.old');
Route::delete('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/panier/contenu', [CartController::class, 'getCartContent'])->name('cart.content');

// Routes API pour les produits
Route::post('/api/products/{product}/increment-views', [ProductController::class, 'incrementViews'])->name('products.increment-views');

// Pages informatives
Route::get('/a-propos', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Blog beauté
Route::get('/beaute-du-monde', function () {
    return view('blog.index');
})->name('blog');

// Recherche
Route::get('/recherche', function () {
    return view('search.results');
})->name('search');

// Route temporaire pour forcer la déconnexion
Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'Vous avez été déconnecté.');
});

// Authentification utilisateurs (publique)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/mot-de-passe-oublie', function () {
        return view('auth.forgot-password');
    })->name('password.request');
});
