<?php
// Author: Alyson Henao

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => ucwords(fake()->words(2, true)),
            'size' => fake()->randomElement(['S', 'M', 'L', 'XL']),
            'brand' => fake()->randomElement(['Goorin Bros', 'New Era', 'Clemont', 'Barbas Hat', 'Amiri']),
            'price' => fake()->numberBetween(50000, 350000),
            'exclusive' => fake()->boolean(20),
            'image' => 'images/products/default-cap.jpg',
            'description' => fake()->sentence(12),
            'color' => fake()->safeColorName(),
            'discount' => fake()->boolean(25)
                ? fake()->numberBetween(5, 30)
                : 0,
            'active' => fake()->boolean(85),
            'stock' => fake()->numberBetween(0, 20),
            'category_id' => null,
        ];
    }
}
