<?php

// Author: Alyson Henao

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $exclusiveCategory = Category::where('name', 'Exclusive')->first();
        $normalCategories = Category::where('name', '!=', 'Exclusive')->get();

        if ($exclusiveCategory === null || $normalCategories->isEmpty()) {
            return;
        }

        Product::factory()->count(30)->make()->each(function (Product $product) use ($exclusiveCategory, $normalCategories): void {
            if ($product->getExclusive()) {
                $product->setCategoryId($exclusiveCategory->getId());
            } else {
                $product->setCategoryId($normalCategories->random()->getId());
            }

            $product->save();
        });
    }
}
