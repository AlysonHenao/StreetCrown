<?php
// Author: Samuel Moncada Mejía

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::middleware('guest')->group(function () {
    Route::get('/login',     'App\Http\Controllers\AuthController@showLogin')->name('login');
    Route::post('/login',    'App\Http\Controllers\AuthController@login');

    Route::get('/register',  'App\Http\Controllers\AuthController@showRegister')->name('register');
    Route::post('/register', 'App\Http\Controllers\AuthController@register');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
});