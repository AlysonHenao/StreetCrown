<?php

// Author: Emmanuel Cortes

namespace App\Http\Controllers;

use App\Contracts\CartServiceInterface;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\RemoveFromCartRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private readonly CartServiceInterface $cartService) {}

    public function index(): View
    {
        $cartItems = $this->cartService->buildCartItems();

        $viewData = [];
        $viewData['title'] = __('order.cart_title');
        $viewData['cartItems'] = $cartItems;
        $viewData['totalQuantity'] = $cartItems->sum(fn(Item $item) => $item->getQuantity());
        $viewData['totalAmount'] = $cartItems->sum(fn(Item $item) => $item->calculateSubTotal());

        return view('cart.index', ['viewData' => $viewData]);
    }

    public function add(AddToCartRequest $request): RedirectResponse
    {
        $productId = (int) $request->validated('product_id', 0);
        $requestedQuantity = (int) $request->validated('quantity', 1);

        $product = Product::where('active', true)->findOrFail($productId);
        $this->cartService->addProduct($product, $requestedQuantity);

        return redirect()->route('cart.index')->with('success', __('order.cart_added_successfully'));
    }

    public function update(UpdateCartItemRequest $request, int $productId): RedirectResponse|JsonResponse
    {
        $product = Product::where('active', true)->findOrFail($productId);
        $quantity = (int) $request->validated('quantity');
        $this->cartService->updateProductQuantity($product, $quantity);

        if ($request->expectsJson()) {
            $cartItems = $this->cartService->buildCartItems();
            $cartItem = $cartItems->firstWhere('product_id', $productId);

            return response()->json([
                'success' => true,
                'price' => $cartItem->getPrice(),
                'quantity' => $cartItem->getQuantity(),
                'subtotal' => $cartItem->calculateSubTotal(),
                'totalQuantity' => $cartItems->sum(fn(Item $item) => $item->getQuantity()),
                'totalAmount' => $cartItems->sum(fn(Item $item) => $item->calculateSubTotal()),
            ]);
        }

        return redirect()->route('cart.index')->with('success', __('order.cart_updated_successfully'));
    }

    public function remove(RemoveFromCartRequest $request, int $productId): RedirectResponse
    {
        $this->cartService->removeProduct($productId);

        return redirect()->route('cart.index')->with('success', __('order.cart_removed_successfully'));
    }

    public function clear(): RedirectResponse
    {
        $this->cartService->clear();

        return redirect()->route('cart.index')->with('success', __('order.cart_cleared_successfully'));
    }
}
