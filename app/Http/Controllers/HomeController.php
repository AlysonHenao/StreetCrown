<?php

// Author: Samuel Moncada Mejía

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'StreetCrown';
        $viewData['topProducts'] = collect();

        if (Schema::hasTable('products') && Schema::hasTable('items') && Schema::hasTable('orders')) {
            $viewData['topProducts'] = Product::getTopSellingProducts(3);
        }

        return view('home.index', ['viewData' => $viewData]);
    }
}
