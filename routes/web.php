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
    Route::get('/', 'App\Http\Controllers\Admin\AdminController@index')->name('index');

    Route::get('/categories', 'App\Http\Controllers\Admin\CategoryController@index')->name('category.index');
    Route::get('/categories/create', 'App\Http\Controllers\Admin\CategoryController@create')->name('category.create');
    Route::post('/categories', 'App\Http\Controllers\Admin\CategoryController@store')->name('category.store');
    Route::get('/categories/{id}/edit', 'App\Http\Controllers\Admin\CategoryController@edit')->name('category.edit');
    Route::put('/categories/{id}', 'App\Http\Controllers\Admin\CategoryController@update')->name('category.update');
    Route::delete('/categories/{id}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('category.destroy');

    Route::get('/products', 'App\Http\Controllers\Admin\ProductController@index')->name('product.index');
    Route::get('/products/create', 'App\Http\Controllers\Admin\ProductController@create')->name('product.create');
    Route::post('/products', 'App\Http\Controllers\Admin\ProductController@store')->name('product.store');
    Route::get('/products/{id}/edit', 'App\Http\Controllers\Admin\ProductController@edit')->name('product.edit');
    Route::put('/products/{id}', 'App\Http\Controllers\Admin\ProductController@update')->name('product.update');
    Route::delete('/products/{id}', 'App\Http\Controllers\Admin\ProductController@destroy')->name('product.destroy');
});