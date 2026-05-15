<?php

namespace App\Http\Controllers;

use App\Services\PartnerProductService;
use Illuminate\View\View;

//Author: Emmanuel Cortés
class PartnerProductController extends Controller
{
    public function __construct(
        private readonly PartnerProductService $partnerProductService
    ) {}

    /**
     * Display partner products.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('partner_product.title');
        $viewData['products'] = $this->partnerProductService->getAvailableProducts();

        return view('partner_product.index')->with('viewData', $viewData);
    }
}
