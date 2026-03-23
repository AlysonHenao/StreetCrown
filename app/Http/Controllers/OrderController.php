<?php
// Author: Alyson Henao

namespace App\Http\Controllers;

use App\Contracts\OrderServiceInterface;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    private OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $paymentMethod = $request->validated('payment_method');
        $user = Auth::user();

        $order = $this->orderService->createFromCart($user, $paymentMethod);

        return redirect()->route('order.show', $order->getId());
    }

    public function index(): View
    {
        $user = Auth::user();

        $viewData = [];
        $viewData['title'] = 'My Orders';
        $viewData['orders'] = Order::with('items.product')
            ->where('user_id', $user->getId())
            ->orderByDesc('id')
            ->get();

        return view('order.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $user = Auth::user();

        $order = Order::with('items.product')->findOrFail($id);

        abort_if($order->getUserId() !== $user->getId(), 403);

        $viewData = [];
        $viewData['title'] = 'Order Detail';
        $viewData['order'] = $order;

        return view('order.show')->with('viewData', $viewData);
    }
}
