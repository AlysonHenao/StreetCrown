<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $exclusive = Category::where('name', 'Exclusive')->first();

        $normalCategories = Category::where('name', '!=', 'Exclusive')->get();

        
        Product::factory()->count(30)->make()->each(function ($product) use ($exclusive, $normalCategories) {

            if ($product->getExclusive()) {
                $product->category_id = $exclusive->getId();
            } else {
                $product->category_id = $normalCategories->random()->getId();
            }

            $product->save();
        });
    }
}