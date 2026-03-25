<?php

// Author: Samuel Moncada Mejía, Alyson Henao

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('layout.app_title');
        $viewData['topProducts'] = collect();
        $viewData['topRatedProducts'] = collect();

        if (Schema::hasTable('products') && Schema::hasTable('items') && Schema::hasTable('orders')) {
            $viewData['topProducts'] = Product::getTopSellingProducts(3);
        }

        if (Schema::hasTable('products') && Schema::hasTable('reviews')) {
            $viewData['topRatedProducts'] = Product::getTopRatedProducts(3);
        }

        return view('home.index', ['viewData' => $viewData]);
    }
}
