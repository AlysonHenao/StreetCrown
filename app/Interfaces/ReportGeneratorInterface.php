<?php

// Author: Alyson Henao

namespace App\Interfaces;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

interface ReportGeneratorInterface
{
    public function supports(string $format): bool;

    public function generate(Collection $orders): Response;
}