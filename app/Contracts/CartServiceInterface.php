<?php
// Author: Emmanuel Cortes

namespace App\Contracts;

interface CartServiceInterface
{
    public function getCart(): array;

    public function addProduct(int $productId, int $quantity): void;

    public function updateProduct(int $productId, int $quantity): void;

    public function removeProduct(int $productId): void;

    public function clearCart(): void;

    public function getTotalQuantity(): int;

    public function getTotalAmount(): int;
}
