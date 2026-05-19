<?php

// Author: Alyson Henao

namespace App\Services\Reports;

use App\Interfaces\ReportGeneratorInterface;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ExcelReportGenerator implements ReportGeneratorInterface
{
    public function supports(string $format): bool
    {
        return $format === 'excel';
    }

    public function generate(Collection $orders): Response
    {
        $content = view('admin.report.sales_excel', [
            'title' => __('report.sales_report_title'),
            'orders' => $orders,
            'generatedAt' => now()->format('d/m/Y H:i'),
        ])->render();

        return response("\xEF\xBB\xBF" . $content, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="streetcrown-sales-report.xls"',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}