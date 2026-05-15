<?php

namespace App\Services;

class StoreMapService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google_maps.embed_api_key') ?? '';
    }

    /**
     * Devuelve URL embebida de Google Maps para cada punto de venta
     */
    public function getStoreMaps(): array
    {
        $stores = config('stores');
        $maps = [];

        foreach ($stores as $store) {
            $maps[] = [
                'name' => $store['name'],
                'address' => $store['address'],
                'map_url' => 'https://www.google.com/maps/embed/v1/place?key='
                    . urlencode($this->apiKey)
                    . '&q=' . urlencode($store['address']),
            ];
        }

        return $maps;
    }
}
