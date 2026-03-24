<?php
// Author: Emmanuel Cortes

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartSessionService
{
    private const CART_KEY = 'shopping_cart';

    public function getCart(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    public function addProduct(int $productId, int $quantity): void
    {
        $cart = $this->getCart();
        $product = Product::findOrFail($productId);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'image' => $product->getImage(),
                'quantity' => $quantity,
                'subtotal' => $product->getPrice() * $quantity,
            ];
        }

        $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $cart[$productId]['quantity'];

        Session::put(self::CART_KEY, $cart);
    }

    public function updateProduct(int $productId, int $quantity): void
    {
        $cart = $this->getCart();

        if (!isset($cart[$productId])) {
            return;
        }

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId]['quantity'] = $quantity;
            $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $quantity;
        }

        Session::put(self::CART_KEY, $cart);
    }

    public function removeProduct(int $productId): void
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        Session::put(self::CART_KEY, $cart);
    }

    public function clearCart(): void
    {
        Session::forget(self::CART_KEY);
    }

    public function getTotalQuantity(): int
    {
        $totalQuantity = 0;

        foreach ($this->getCart() as $cartItem) {
            $totalQuantity += $cartItem['quantity'];
        }

        return $totalQuantity;
    }

    public function getTotalAmount(): int
    {
        $totalAmount = 0;

        foreach ($this->getCart() as $cartItem) {
            $totalAmount += $cartItem['subtotal'];
        }

        return $totalAmount;
    }
}
