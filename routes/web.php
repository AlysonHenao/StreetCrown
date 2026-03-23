<?php
// Author: Samuel Moncada Mejía, Alyson Henao

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::middleware('guest')->group(function () {
    Route::get('/login', 'App\Http\Controllers\AuthController@showLogin')->name('login');
    Route::post('/login', 'App\Http\Controllers\AuthController@login');

    Route::get('/register', 'App\Http\Controllers\AuthController@showRegister')->name('register');
    Route::post('/register', 'App\Http\Controllers\AuthController@register');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
});
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/categories', 'App\Http\Controllers\Admin\CategoryController@index')->name('category.index');
    Route::get('/categories/create', 'App\Http\Controllers\Admin\CategoryController@create')->name('category.create');
    Route::post('/categories', 'App\Http\Controllers\Admin\CategoryController@store')->name('category.store');
    Route::get('/categories/{id}/edit', 'App\Http\Controllers\Admin\CategoryController@edit')->name('category.edit');
    Route::put('/categories/{id}', 'App\Http\Controllers\Admin\CategoryController@update')->name('category.update');
    Route::delete('/categories/{id}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('category.destroy');
});

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart/add', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::put('/cart/{productId}', 'App\Http\Controllers\CartController@update')->name('cart.update');
Route::delete('/cart/{productId}', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::delete('/cart', 'App\Http\Controllers\CartController@clear')->name('cart.clear');
Route::post('/orders', 'App\Http\Controllers\OrderController@store')->name('order.store')->middleware('auth');
Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('order.index')->middleware('auth');
Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show')->name('order.show')->middleware('auth');
