<?php

// Author: Samuel Moncada Mejía, Alyson Henao, Emmanuel Cortes

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/top-selling', 'App\Http\Controllers\ProductController@topSelling')->name('product.topSelling');
Route::get('/products/{product}', 'App\Http\Controllers\ProductController@show')->name('product.show');

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::put('/cart/{product}', 'App\Http\Controllers\CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::delete('/cart', 'App\Http\Controllers\CartController@clear')->name('cart.clear');

Route::middleware('guest')->group(function () {
    Route::get('/login', 'App\Http\Controllers\AuthController@showLogin')->name('login');
    Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');

    Route::get('/register', 'App\Http\Controllers\AuthController@showRegister')->name('register');
    Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('auth.register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

    Route::get('/profile', 'App\Http\Controllers\ProfileController@show')->name('profile.show');
    Route::get('/profile/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'App\Http\Controllers\ProfileController@update')->name('profile.update');

    Route::get('/products/{productId}/reviews/create', 'App\Http\Controllers\ReviewController@create')->name('review.create');
    Route::post('/products/{productId}/reviews', 'App\Http\Controllers\ReviewController@store')->name('review.store');

    Route::get('/wishlist', 'App\Http\Controllers\WishlistController@index')->name('wishlist.index');
    Route::post('/wishlist/{product}', 'App\Http\Controllers\WishlistController@add')->name('wishlist.add');
    Route::delete('/wishlist/{product}', 'App\Http\Controllers\WishlistController@remove')->name('wishlist.remove');
    Route::delete('/wishlist', 'App\Http\Controllers\WishlistController@clear')->name('wishlist.clear');

    Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('order.index');
    Route::get('/orders/checkout', 'App\Http\Controllers\OrderController@checkout')->name('order.checkout');
    Route::get('/orders/{order}', 'App\Http\Controllers\OrderController@show')->name('order.show');
    Route::post('/orders', 'App\Http\Controllers\OrderController@store')->name('order.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'App\Http\Controllers\Admin\AdminController@index')->name('index');

    Route::get('/categories', 'App\Http\Controllers\Admin\CategoryController@index')->name('category.index');
    Route::get('/categories/create', 'App\Http\Controllers\Admin\CategoryController@create')->name('category.create');
    Route::post('/categories', 'App\Http\Controllers\Admin\CategoryController@store')->name('category.store');
    Route::get('/categories/{category}/edit', 'App\Http\Controllers\Admin\CategoryController@edit')->name('category.edit');
    Route::put('/categories/{category}', 'App\Http\Controllers\Admin\CategoryController@update')->name('category.update');
    Route::delete('/categories/{category}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('category.destroy');

    Route::get('/products', 'App\Http\Controllers\Admin\ProductController@index')->name('product.index');
    Route::get('/products/create', 'App\Http\Controllers\Admin\ProductController@create')->name('product.create');
    Route::post('/products', 'App\Http\Controllers\Admin\ProductController@store')->name('product.store');
    Route::get('/products/{product}/edit', 'App\Http\Controllers\Admin\ProductController@edit')->name('product.edit');
    Route::put('/products/{product}', 'App\Http\Controllers\Admin\ProductController@update')->name('product.update');
    Route::delete('/products/{product}', 'App\Http\Controllers\Admin\ProductController@destroy')->name('product.destroy');

    Route::get('/users', 'App\Http\Controllers\Admin\UserController@index')->name('user.index');
    Route::get('/users/{user}/edit', 'App\Http\Controllers\Admin\UserController@edit')->name('user.edit');
    Route::put('/users/{user}', 'App\Http\Controllers\Admin\UserController@update')->name('user.update');

    Route::get('/orders', 'App\Http\Controllers\Admin\OrderController@index')->name('order.index');
    Route::get('/orders/{order}/edit', 'App\Http\Controllers\Admin\OrderController@edit')->name('order.edit');
    Route::put('/orders/{order}', 'App\Http\Controllers\Admin\OrderController@update')->name('order.update');

    Route::get('/reports', 'App\Http\Controllers\Admin\ReportController@index')->name('report.index');
    Route::get('/reports/sales/{format}', 'App\Http\Controllers\Admin\ReportController@sales')
        ->whereIn('format', ['pdf', 'excel'])
        ->name('report.sales');
});