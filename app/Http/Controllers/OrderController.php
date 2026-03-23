<?php
// Author: Samuel Moncada Mejía

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $user = Auth::user();
        $viewData = [
            'orders' => $user->orders,
            'title' => __('order.index_title'),
        ];

        return view('orders.index', ['viewData' => $viewData]);
    }

    public function show(Order $order): View
    {
        $this->authorize('view', $order);

        $viewData = [
            'order' => $order,
            'title' => __('order.show_title'),
        ];

        return view('orders.show', ['viewData' => $viewData]);
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        Order::create($validated);

        return redirect()->route('order.index')
            ->with('success', __('order.created_successfully'));
    }
}
