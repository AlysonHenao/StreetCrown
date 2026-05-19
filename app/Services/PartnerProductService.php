<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

// Author: Emmanuel Cortés

class PartnerProductService
{
    public function getAvailableProducts(): array
    {
        $url = config('services.partner_products.url');

        if (!$url) {
            return [];
        }

        try {
            $response = Http::timeout(5)->acceptJson()->get($url);

            if (!$response->successful()) {
                return [];
            }

            $json = $response->json();

            $items = $json['data'] ?? $json;

            if (!is_array($items)) {
                return [];
            }

            return collect($items)->map(function ($movie) {
                return [
                    'id' => data_get($movie, 'id'),
                    'title' => data_get($movie, 'title', 'Sin título'),
                    'director' => data_get($movie, 'director', 'No disponible'),
                    'genre' => data_get($movie, 'genre', 'No disponible'),

                    'views' => data_get($movie, 'views', data_get($movie, 'quantity_views', 0)),

                    'classification' => data_get($movie, 'classification', 'No disponible'),
                    'description' => data_get($movie, 'description', 'Sin descripción'),
                    'file_name' => data_get($movie, 'file_name'),
                    'image_url' => data_get($movie, 'image_url') ?? data_get($movie, 'file_name'),
                ];
            })->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }
}