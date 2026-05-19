<?php

// Author: Emmanuel Cortes

namespace App\Services;

use App\Interfaces\CartServiceInterface;
use App\Interfaces\OrderServiceInterface;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class OrderService implements OrderServiceInterface
{
    public function __construct(private readonly CartServiceInterface $cartService) {}

    public function createFromCart(User $user, string $paymentMethod): Order
    {
        $cart = $this->cartService->getCart();

        if (count($cart) === 0) {
            throw ValidationException::withMessages([
                'cart' => __('order.cart_empty'),
            ]);
        }

        $order = new Order;
        $order->setUserId($user->getId());
        $order->setPaymentMethod($paymentMethod);
        $order->setDate(date('Y-m-d'));
        $order->setStatus('pending');
        $order->setTotal(0);
        $order->save();

        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::where('active', true)->find((int) $productId);

            if (! $product || (int) $quantity <= 0) {
                continue;
            }

            $item = new Item;
            $item->setOrderId($order->getId());
            $item->setProductId($product->getId());
            $item->setQuantity((int) $quantity);
            $item->setPrice($product->getPrice());
            $item->save();

            $newStock = max(0, $product->getStock() - (int) $quantity);
            $product->setStock($newStock);
            $product->save();

            $total += $item->calculateSubTotal();
        }

        $order->setTotal($total);
        $order->save();

        $this->cartService->clear();

        return $order;
    }
}