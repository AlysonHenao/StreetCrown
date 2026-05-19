<?php

// Author: Alyson Henao

namespace App\Services\Reports;

use App\Interfaces\ReportGeneratorInterface;
use InvalidArgumentException;

class ReportGeneratorFactory
{
    public function __construct(private readonly iterable $generators)
    {
    }

    public function make(string $format): ReportGeneratorInterface
    {
        foreach ($this->generators as $generator) {
            if ($generator->supports($format)) {
                return $generator;
            }
        }

        throw new InvalidArgumentException(__('report.invalid_format'));
    }
}