<?php

namespace App\Http\Controllers;

use App\Services\StoreMapService;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function __construct(private StoreMapService $storeMapService) {}

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('store.title');
        $viewData['stores'] = $this->storeMapService->getStoreMaps();

        return view('store.index')->with('viewData', $viewData);
    }
}
