<?php

// Author: Emmanuel Cortes

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    private const CART_KEY = 'shopping_cart';

    public function index(): View
    {
        $cartItems = $this->buildCartItems();

        $viewData = [];
        $viewData['title'] = __('order.cart_title');
        $viewData['isCartView'] = true;
        $viewData['cartItems'] = $cartItems;
        $viewData['totalQuantity'] = $cartItems->sum(fn(Item $item) => $item->getQuantity());
        $viewData['totalAmount'] = $cartItems->sum(fn(Item $item) => $item->calculateSubTotal());

        return view('home.index', ['viewData' => $viewData]);
    }

    public function add(Request $request): RedirectResponse
    {
        $productId = (int) $request->input('product_id', 0);
        $requestedQuantity = max(1, (int) $request->input('quantity', 1));

        $product = Product::where('active', true)->findOrFail($productId);

        $cart = $this->getCart();
        $currentQuantity = (int) ($cart[$productId] ?? 0);
        $newQuantity = min($product->getStock(), $currentQuantity + $requestedQuantity);

        if ($newQuantity > 0) {
            $cart[$productId] = $newQuantity;
            Session::put(self::CART_KEY, $cart);
        }

        return redirect()->route('cart.index')->with('success', __('order.cart_added_successfully'));
    }

    public function update(Request $request, int $productId): RedirectResponse
    {
        $quantity = max(0, (int) $request->input('quantity', 1));

        $cart = $this->getCart();

        if (! array_key_exists($productId, $cart)) {
            return redirect()->route('cart.index');
        }

        if ($quantity === 0) {
            unset($cart[$productId]);
        } else {
            $product = Product::where('active', true)->findOrFail($productId);
            $cart[$productId] = min($product->getStock(), $quantity);
        }

        Session::put(self::CART_KEY, $cart);

        return redirect()->route('cart.index')->with('success', __('order.cart_updated_successfully'));
    }

    public function remove(int $productId): RedirectResponse
    {
        $cart = $this->getCart();

        if (array_key_exists($productId, $cart)) {
            unset($cart[$productId]);
            Session::put(self::CART_KEY, $cart);
        }

        return redirect()->route('cart.index')->with('success', __('order.cart_removed_successfully'));
    }

    public function clear(): RedirectResponse
    {
        Session::forget(self::CART_KEY);

        return redirect()->route('cart.index')->with('success', __('order.cart_cleared_successfully'));
    }

    public function getCart(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    private function buildCartItems()
    {
        $cart = $this->getCart();

        if (count($cart) === 0) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($cart))
            ->where('active', true)
            ->get()
            ->keyBy(fn(Product $product) => $product->getId());

        return collect($cart)
            ->filter(fn(int $quantity, int $productId) => $quantity > 0 && isset($products[$productId]))
            ->map(function (int $quantity, int $productId) use ($products) {
                $product = $products[$productId];

                $item = new Item;
                $item->setProductId($product->getId());
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setRelation('product', $product);

                return $item;
            })
            ->values();
    }
}
