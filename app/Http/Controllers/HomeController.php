<?php
// Author: Samuel Moncada Mejía

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'StreetCrown';

        return view('home.index', ['viewData' => $viewData]);
    }
}