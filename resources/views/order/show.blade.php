{{-- Author: Emmanuel Cortes --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $viewData['title'] }}</h1>

    <p><strong>Order:</strong> #{{ $viewData['order']->getId() }}</p>
    <p><strong>Date:</strong> {{ $viewData['order']->getDate() }}</p>
    <p><strong>Status:</strong> {{ $viewData['order']->getStatus() }}</p>
    <p><strong>Payment method:</strong> {{ $viewData['order']->getPaymentMethod() }}</p>
    <p><strong>Total:</strong> ${{ $viewData['order']->getTotal() }}</p>

    <h2>Items</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($viewData['order']->getItems() as $item)
            <tr>
                <td>{{ $item->getProduct()->getName() }}</td>
                <td>
                    <img src="{{ asset('storage/' . $item->getProduct()->getImage()) }}" alt="{{ $item->getProduct()->getName() }}" width="80">
                </td>
                <td>${{ $item->getPrice() }}</td>
                <td>{{ $item->getQuantity() }}</td>
                <td>${{ $item->calculateSubTotal() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('order.index') }}" class="btn btn-secondary">Back to history</a>
</div>
@endsection
