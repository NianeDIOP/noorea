<?php

use Illuminate\Support\Facades\Route;

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
