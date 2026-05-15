<?php

use Illuminate\Support\Facades\Route;

Route::get(
    '/products/available',
    'App\Http\Controllers\Api\ProductApiController@index'
)->name('api.product.available');
