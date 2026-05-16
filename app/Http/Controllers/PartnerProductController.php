<?php

namespace App\Http\Controllers;

use App\Services\PartnerProductService;
use App\Http\Resources\MovieResource;
use Illuminate\View\View;

//Author: Emmanuel Cortés
class PartnerProductController extends Controller
{
    public function __construct(private readonly PartnerProductService $partnerProductService) {}

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('partner_product.title');

        $movies = $this->partnerProductService->getAvailableProducts();

        // Transformamos cada película a MovieResource para mantener formato consistente
        $viewData['products'] = MovieResource::collection($movies);

        return view('partner_product.index')->with('viewData', $viewData);
    }
}
