<?php

// Author: Samuel Moncada Mejía, Emmanuel Cortes

namespace App\Http\Controllers;

use App\Interfaces\CartServiceInterface;
use App\Interfaces\OrderServiceInterface;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class OrderController extends Controller
{
    private const CART_KEY = 'shopping_cart';

    public function __construct(
        private readonly CartServiceInterface $cartService,
        private readonly OrderServiceInterface $orderService,
    ) {}

    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $viewData = [
            'orders' => Order::with('items.product')
                ->where('user_id', $user->getId())
                ->orderByDesc('id')
                ->get(),
            'title' => __('order.index_title'),
        ];

        return view('orders.index', ['viewData' => $viewData]);
    }

    public function show(Order $order): View|RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($order->getUserId() !== $user->getId()) {
            return redirect()->route('order.index');
        }

        $order->loadMissing('items.product', 'user');

        $viewData = [
            'order' => $order,
            'title' => __('order.show_title'),
        ];

        return view('orders.show', ['viewData' => $viewData]);
    }

    public function checkout(): View|RedirectResponse
    {
        $cart = Session::get(self::CART_KEY, []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', __('order.cart_empty'));
        }

        $cartItems = $this->cartService->buildCartItems();

        $viewData = [
            'title' => __('checkout.title'),
            'cartItems' => $cartItems,
            'totalQuantity' => $cartItems->sum(fn (Item $item) => $item->getQuantity()),
            'totalAmount' => $cartItems->sum(fn (Item $item) => $item->calculateSubTotal()),
            'user' => Auth::user(),
        ];

        return view('checkout.index', ['viewData' => $viewData]);
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $cart = Session::get(self::CART_KEY, []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', __('order.cart_empty'));
        }

        $order = $this->orderService->createFromCart(
            Auth::user(),
            $request->validated('payment_method')
        );

        return redirect()->route('order.show', $order->getId())
            ->with('success', __('order.created_successfully'));
    }
}