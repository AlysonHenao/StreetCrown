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
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>SubTotal</th>
                <th>Actions</th>
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
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </form>
                </td>
                <td>${{ $cartItem['subtotal'] }}</td>
                <td>
                    <form action="{{ route('cart.remove', $cartItem['product_id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total quantity:</strong> {{ $viewData['totalQuantity'] }}</p>
    <p><strong>Total amount:</strong> ${{ $viewData['totalAmount'] }}</p>

    <form action="{{ route('cart.clear') }}" method="POST" class="mb-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-warning">Clear cart</button>
    </form>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment method</label>
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="cash">Cash</option>
                <option value="card">Card</option>
                <option value="transfer">Transfer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Place order</button>
    </form>
    @else
    <p>Your cart is empty.</p>
    @endif
</div>
@endsection