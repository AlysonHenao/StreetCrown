<?php

// Author: Alyson Henao

namespace App\Providers;

use App\Services\Reports\ExcelReportGenerator;
use App\Services\Reports\PdfReportGenerator;
use App\Services\Reports\ReportGeneratorFactory;
use Illuminate\Support\ServiceProvider;

class ReportServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->tag([
            PdfReportGenerator::class,
            ExcelReportGenerator::class,
        ], 'report.generators');

        $this->app->bind(ReportGeneratorFactory::class, function ($app) {
            return new ReportGeneratorFactory($app->tagged('report.generators'));
        });
    }
}