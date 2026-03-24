<?php

// Author: Samuel Moncada Mejía, Emmanuel Cortes

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
            'title' => __('product.index_title'),
            'products' => $products,
            'showPagination' => true,
            'showSoldQuantity' => false,
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

    public function topSelling(): View
    {
        $viewData = [
            'title' => __('product.top_selling_title'),
            'products' => Product::getTopSellingProducts(3),
            'showPagination' => false,
            'showSoldQuantity' => true,
        ];

        return view('products.index', ['viewData' => $viewData]);
    }
}
