<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


// Author: Emmanuel Cortés
class PartnerProductService
{
    /**
     * Devuelve los productos (películas) consumidos del equipo aliado.
     */
    public function getAvailableProducts(): array
    {
        $url = config('services.partner_products.url'); // URL ahora apunta a /api/movies

        if (!$url) {
            return [];
        }

        $response = Http::timeout(5)->acceptJson()->get($url);

        if (!$response->successful()) {
            return [];
        }

        // Devuelves directamente el arreglo de películas que ellos envían
        return $response->json() ?? [];
    }
}
