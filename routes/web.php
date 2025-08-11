<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Inclure les routes admin
require __DIR__.'/admin.php';

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Pages produits
Route::get('/boutique', function () {
    return view('products.index');
})->name('products');

Route::get('/produit/{id}', function ($id) {
    return view('products.show');
})->name('products.show');

Route::get('/categories', function () {
    return view('categories.index');
})->name('categories');

Route::get('/marques', function () {
    return view('brands.index');
})->name('brands');

// Pages compte utilisateur
Route::get('/compte', function () {
    return view('account.index');
})->name('account');

Route::get('/wishlist', function () {
    return view('account.wishlist');
})->name('wishlist');

Route::get('/panier', function () {
    return view('cart.index');
})->name('cart');

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
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    
    Route::get('/mot-de-passe-oublie', function () {
        return view('auth.forgot-password');
    })->name('password.request');
});

// Routes protégées utilisateurs
Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
