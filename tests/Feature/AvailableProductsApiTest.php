<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AvailableProductsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_available_products_api_returns_json(): void
    {
        // Crear categoría y producto de prueba
        $category = Category::factory()->create(['name' => 'Caps']);
        $product = Product::factory()->create([
            'name' => 'Test Cap',
            'stock' => 10,
            'category_id' => $category->id,
        ]);

        // Llamar a la API
        $response = $this->getJson('/api/products/available');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name',
                    'price',
                    'formatted_price',
                    'stock',
                    'image_url',
                    'product_url',
                    'category' => [
                        'id',
                        'name',
                    ],
                ],
            ],
        ]);

        // Validar que el producto de prueba esté en el JSON
        $this->assertEquals('Test Cap', $response->json('data.0.name'));
    }
}
