<?php

// Author: Alyson Henao

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Caps', 'description' => 'Urban and casual caps'],
            ['name' => 'Exclusive', 'description' => 'Exclusive limited-edition products'],
            ['name' => 'Sports', 'description' => 'Caps for sports and outdoor activities'],
            ['name' => 'Streetwear', 'description' => 'Streetwear-inspired products'],
            ['name' => 'Classic', 'description' => 'Classic and timeless cap styles'],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['name' => $categoryData['name']],
                ['description' => $categoryData['description']]
            );
        }
    }
}
