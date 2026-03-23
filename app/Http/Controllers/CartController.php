<?php
// Author: Emmanuel Cortes

namespace App\Http\Controllers;

use App\Contracts\CartServiceInterface;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\RemoveFromCartRequest;
use App\Http\Requests\UpdateCartItemRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    private CartServiceInterface $cartService;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Shopping Cart';
        $viewData['cartItems'] = $this->cartService->getCart();
        $viewData['totalQuantity'] = $this->cartService->getTotalQuantity();
        $viewData['totalAmount'] = $this->cartService->getTotalAmount();

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(AddToCartRequest $request): RedirectResponse
    {
        $productId = (int) $request->validated('product_id');
        $quantity = (int) ($request->validated('quantity') ?? 1);

        $this->cartService->addProduct($productId, $quantity);

        return redirect()->route('cart.index');
    }

    public function update(UpdateCartItemRequest $request, int $productId): RedirectResponse
    {
        $quantity = (int) $request->validated('quantity');

        $this->cartService->updateProduct($productId, $quantity);

        return redirect()->route('cart.index');
    }

    public function remove(RemoveFromCartRequest $request, int $productId): RedirectResponse
    {
        $this->cartService->removeProduct($productId);

        return redirect()->route('cart.index');
    }

    public function clear(): RedirectResponse
    {
        $this->cartService->clearCart();

        return redirect()->route('cart.index');
    }
}
