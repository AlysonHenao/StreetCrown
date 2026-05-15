<?php

// Author: Emmanuel Cortés

namespace Tests\Unit;

use App\Services\StoreMapService;
use Tests\TestCase;

class StoreMapServiceTest extends TestCase
{
    public function test_store_maps_are_generated(): void
    {
        // Configurar una API Key de prueba
        config(['services.google_maps.embed_api_key' => 'fake-key']);

        $service = new StoreMapService();

        $maps = $service->getStoreMaps();

        $this->assertIsArray($maps);
        $this->assertNotEmpty($maps);

        foreach ($maps as $store) {
            $this->assertArrayHasKey('name', $store);
            $this->assertArrayHasKey('address', $store);
            $this->assertArrayHasKey('map_url', $store);
            $this->assertStringContainsString('https://www.google.com/maps/embed/v1/place', $store['map_url']);
        }
    }
}
