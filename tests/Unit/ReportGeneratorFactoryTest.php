<?php

// Author: Alyson Henao

namespace Tests\Unit;

use App\Services\Reports\ExcelReportGenerator;
use App\Services\Reports\PdfReportGenerator;
use App\Services\Reports\ReportGeneratorFactory;
use InvalidArgumentException;
use Tests\TestCase;

class ReportGeneratorFactoryTest extends TestCase
{
    public function test_factory_returns_pdf_report_generator(): void
    {
        $factory = new ReportGeneratorFactory([
            new PdfReportGenerator(),
            new ExcelReportGenerator(),
        ]);

        $generator = $factory->make('pdf');

        $this->assertInstanceOf(PdfReportGenerator::class, $generator);
    }

    public function test_factory_returns_excel_report_generator(): void
    {
        $factory = new ReportGeneratorFactory([
            new PdfReportGenerator(),
            new ExcelReportGenerator(),
        ]);

        $generator = $factory->make('excel');

        $this->assertInstanceOf(ExcelReportGenerator::class, $generator);
    }

    public function test_factory_throws_exception_for_invalid_format(): void
    {
        $factory = new ReportGeneratorFactory([
            new PdfReportGenerator(),
            new ExcelReportGenerator(),
        ]);

        $this->expectException(InvalidArgumentException::class);

        $factory->make('word');
    }
}