<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Author: Your Name
 */
class PartnerProductService
{
    /**
     * Get products from the partner team API.
     */
    public function getAvailableProducts(): array
    {
        $url = config('services.partner_products.url');

        if (!$url) {
            return [];
        }

        $response = Http::timeout(5)->acceptJson()->get($url);

        if (!$response->successful()) {
            return [];
        }

        return $response->json('data') ?? [];
    }
}
