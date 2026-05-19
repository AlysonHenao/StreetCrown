<?php

// Author: Alyson Henao

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Reports\ReportGeneratorFactory;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    public function __construct(private readonly ReportGeneratorFactory $reportGeneratorFactory) 
    {
    }

    public function index(): View
    {
        $viewData = [
            'title' => __('report.reports_title'),
            'subtitle' => __('report.reports_subtitle'),
        ];

        return view('admin.report.index')->with('viewData', $viewData);
    }

    public function sales(string $format): Response
    {
        $orders = Order::with(['user', 'items.product'])
            ->whereIn('status', ['paid', 'shipped', 'delivered'])
            ->orderByDesc('id')
            ->get();

        $generator = $this->reportGeneratorFactory->make($format);

        return $generator->generate($orders);
    }
}