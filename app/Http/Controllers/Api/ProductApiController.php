<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Author: Your Name
 */
class ProductApiController extends Controller
{
    /**
     * Display available products as JSON.
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::with('category')
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return ProductResource::collection($products);
    }
}
