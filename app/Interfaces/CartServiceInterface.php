<?php

// Author: Emmanuel Cortes

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartServiceInterface
{
    public function getCart(): array;

    public function addProduct(Product $product, int $requestedQuantity): void;

    public function updateProductQuantity(Product $product, int $quantity): void;

    public function removeProduct(int $productId): void;

    public function clear(): void;

    public function buildCartItems(): Collection;
}