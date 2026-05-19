<?php

// Author: Alyson Henao

namespace App\Services\Reports;

use App\Interfaces\ReportGeneratorInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class PdfReportGenerator implements ReportGeneratorInterface
{
    public function supports(string $format): bool
    {
        return $format === 'pdf';
    }

    public function generate(Collection $orders): Response
    {
        $viewData = [
            'title' => __('report.sales_report_title'),
            'orders' => $orders,
            'generatedAt' => now()->format('d/m/Y H:i'),
        ];

        return Pdf::loadView('admin.report.sales_pdf', $viewData)
            ->setPaper('a4', 'landscape')
            ->download('streetcrown-sales-report.pdf');
    }
}