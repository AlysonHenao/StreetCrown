<?php
// Author: Samuel Moncada Mejía

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->where('active', true)
            ->paginate(12);

        $viewData = [
            'title' => 'Products',
            'products' => $products,
        ];

        return view('products.index', ['viewData' => $viewData]);
    }

    public function show(Product $product): View
    {
        $viewData = [
            'title' => $product->getName(),
            'product' => $product,
        ];

        return view('products.show', ['viewData' => $viewData]);
    }
}
