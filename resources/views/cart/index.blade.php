{{-- Author: Emmanuel Cortes --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $viewData['title'] }}</h1>

    @if($viewData['cartItems']->isNotEmpty())
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('order.product') }}</th>
                    <th>{{ __('order.price') }}</th>
                    <th>{{ __('order.quantity') }}</th>
                    <th>{{ __('order.subtotal') }}</th>
                    <th>{{ __('order.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['cartItems'] as $cartItem)
                <tr>
                    <td>{{ $cartItem->getProduct()->getName() }}</td>
                    <td>{{ number_format($cartItem->getPrice(), 0, ',', '.') }} COP</td>
                    <td>
                        <form method="POST" action="{{ route('cart.update', $cartItem->getProductId()) }}" class="d-flex gap-2">
                            @csrf
                            @method('PUT')
                            <input
                                type="number"
                                name="quantity"
                                min="1"
                                max="{{ $cartItem->getProduct()->getStock() }}"
                                value="{{ $cartItem->getQuantity() }}"
                                class="form-control">
                            <button type="submit" class="btn btn-sm btn-primary">{{ __('order.update') }}</button>
                        </form>
                    </td>
                    <td>{{ number_format($cartItem->calculateSubTotal(), 0, ',', '.') }} COP</td>
                    <td>
                        <form method="POST" action="{{ route('cart.remove', $cartItem->getProductId()) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">{{ __('order.remove') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <p><strong>{{ __('order.total_items') }}:</strong> {{ $viewData['totalQuantity'] }}</p>
    <p><strong>{{ __('order.total') }}:</strong> {{ number_format($viewData['totalAmount'], 0, ',', '.') }} COP</p>

    <form action="{{ route('cart.clear') }}" method="POST" class="mb-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-warning">{{ __('order.clear_cart') }}</button>
    </form>

    <form action="{{ route('order.store') }}" method="POST" class="d-flex gap-2 align-items-center">
        @csrf
        <label for="payment_method" class="form-label mb-0">{{ __('order.payment_method') }}</label>
        <select name="payment_method" id="payment_method" class="form-select">
            <option value="cash">{{ __('order.payment_cash') }}</option>
            <option value="card">{{ __('order.payment_card') }}</option>
            <option value="transfer">{{ __('order.payment_transfer') }}</option>
        </select>
        <button type="submit" class="btn btn-success">{{ __('order.place_order') }}</button>
    </form>
    @else
    <p>{{ __('order.cart_empty') }}</p>
    @endif
</div>
@endsection