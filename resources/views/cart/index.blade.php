{{-- Author: Emmanuel Cortes --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $viewData['title'] }}</h1>

    @if(count($viewData['cartItems']) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('order.product') }}</th>
                <th>{{ __('order.image') }}</th>
                <th>{{ __('order.price') }}</th>
                <th>{{ __('order.quantity') }}</th>
                <th>{{ __('order.subtotal') }}</th>
                <th>{{ __('order.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($viewData['cartItems'] as $cartItem)
            <tr>
                <td>{{ $cartItem['name'] }}</td>
                <td>
                    <img src="{{ asset('storage/' . $cartItem['image']) }}" alt="{{ $cartItem['name'] }}" width="80">
                </td>
                <td>${{ $cartItem['price'] }}</td>
                <td>
                    <form action="{{ route('cart.update', $cartItem['product_id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $cartItem['quantity'] }}" min="1">
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('order.update') }}</button>
                    </form>
                </td>
                <td>${{ $cartItem['subtotal'] }}</td>
                <td>
                    <form action="{{ route('cart.remove', $cartItem['product_id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">{{ __('order.remove') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>{{ __('order.total_items') }}:</strong> {{ $viewData['totalQuantity'] }}</p>
    <p><strong>{{ __('order.total') }}:</strong> ${{ $viewData['totalAmount'] }}</p>

    <form action="{{ route('cart.clear') }}" method="POST" class="mb-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-warning">{{ __('order.clear_cart') }}</button>
    </form>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="payment_method" class="form-label">{{ __('order.payment_method') }}</label>
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="cash">{{ __('order.payment_cash') }}</option>
                <option value="card">{{ __('order.payment_card') }}</option>
                <option value="transfer">{{ __('order.payment_transfer') }}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">{{ __('order.place_order') }}</button>
    </form>
    @else
    <p>{{ __('order.cart_empty') }}</p>
    @endif
</div>
@endsection