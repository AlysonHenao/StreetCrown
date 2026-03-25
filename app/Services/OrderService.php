<?php

// Author: Emmanuel Cortes

namespace App\Services;

use App\Contracts\CartServiceInterface;
use App\Contracts\OrderServiceInterface;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

        return DB::transaction(function () use ($user, $paymentMethod) {
            $cart = $this->cartService->getCart();

            $order = new Order;
            $order->setUserId($user->getId());
            $order->setPaymentMethod($paymentMethod);
            $order->setDate(date('Y-m-d'));
            $order->setStatus('pending');
            $order->setTotal(0);
            $order->save();

            $total = 0;

            foreach ($cart as $productId => $quantity) {
                $product = Product::find((int) $productId);

                if (! $product || (int) $quantity <= 0) {
                    continue;
                }

                $item = new Item;
                $item->setQuantity((int) $quantity);
                $item->setPrice($product->getPrice());
                $item->setOrderId($order->getId());
                $item->setProductId((int) $productId);
                $item->save();

                $total += $item->calculateSubTotal();
            }

            $order->setTotal($total);
            $order->save();

            $this->cartService->clear();

            return $order;
        });
    }
}
