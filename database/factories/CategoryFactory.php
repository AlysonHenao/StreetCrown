<?php
// Author: Alyson Henao

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = [
            ['name' => 'Caps', 'description' => 'Urban and casual caps'],
            ['name' => 'Exclusive', 'description' => 'Exclusive limited-edition products'],
            ['name' => 'Sports', 'description' => 'Caps for sports and outdoor activities'],
            ['name' => 'Streetwear', 'description' => 'Streetwear-inspired products'],
            ['name' => 'Classic', 'description' => 'Classic and timeless cap styles'],
        ];

        return fake()->unique()->randomElement($categories);
    }
}
