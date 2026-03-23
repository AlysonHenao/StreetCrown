<?php
// Author: Alyson Henao

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.dashboard_title');
        $viewData['subtitle'] = __('admin.dashboard_subtitle');
        $viewData['productsCount'] = Product::count();
        $viewData['categoriesCount'] = Category::count();
        $viewData['activeProductsCount'] = Product::where('active', true)->count();
        $viewData['exclusiveProductsCount'] = Product::where('exclusive', true)->count();

        return view('admin.index')->with('viewData', $viewData);
    }
}