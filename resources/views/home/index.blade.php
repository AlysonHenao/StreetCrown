{{-- Author: Samuel Moncada Mejía, Emmanuel Cortes --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', __('layout.app_subtitle'))

@section('content')
@if(!empty($viewData['isCartView']))
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">{{ __('order.cart_title') }}</h2>

        @if($viewData['cartItems']->isEmpty())
        <div class="alert alert-info" role="alert">{{ __('order.cart_empty') }}</div>
        @else
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
                                    min="0"
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

        <div class="mb-3">
            <strong>{{ __('order.total_items') }}:</strong> {{ $viewData['totalQuantity'] }}
            <br>
            <strong>{{ __('order.total') }}:</strong> {{ number_format($viewData['totalAmount'], 0, ',', '.') }} COP
        </div>

        <div class="d-flex flex-column gap-2">
            <form method="POST" action="{{ route('cart.clear') }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">{{ __('order.clear_cart') }}</button>
            </form>

            <form method="POST" action="{{ route('order.store') }}" class="d-flex gap-2 align-items-center">
                @csrf
                <label for="payment_method" class="form-label mb-0">{{ __('order.payment_method') }}</label>
                <select id="payment_method" name="payment_method" class="form-select">
                    <option value="cash">{{ __('order.payment_cash') }}</option>
                    <option value="card">{{ __('order.payment_card') }}</option>
                    <option value="transfer">{{ __('order.payment_transfer') }}</option>
                </select>
                <button type="submit" class="btn btn-success">{{ __('order.place_order') }}</button>
            </form>
        </div>
        @endif
    </div>
</div>
@else
<div class="text-center py-5">
    <h1 class="display-5 fw-bold mb-3">{{ __('layout.brand') }}</h1>
    <p class="lead text-muted mb-4">{{ __('layout.welcome_lead') }}</p>
    @auth
    <p class="text-muted">{{ __('layout.view_products') }}</p>
    @else
    <a href="{{ route('login') }}" class="btn btn-dark btn-lg px-4 me-2">
        {{ __('layout.login') }}
    </a>
    <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg px-4">
        {{ __('layout.register') }}
    </a>
    @endauth
</div>

<div class="mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">{{ __('product.top_selling_title') }}</h2>
        <a href="{{ route('product.topSelling') }}" class="btn btn-sm btn-outline-dark">
            {{ __('product.view_details') }}
        </a>
    </div>

    @if($viewData['topProducts']->isEmpty())
    <div class="alert alert-info" role="alert">
        {{ __('product.top_selling_empty') }}
    </div>
    @else
    <div class="row g-4">
        @foreach($viewData['topProducts'] as $product)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                @if($product->getImage())
                <img src="{{ asset('images/products/' . $product->getImage()) }}" class="card-img-top" alt="{{ $product->getName() }}">
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                    <span class="text-muted">{{ __('product.no_image') }}</span>
                </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->getName() }}</h5>
                    <p class="card-text text-muted small mb-1">{{ $product->getBrand() }}</p>
                    <p class="card-text small mb-3">{{ __('product.units_sold') }}: {{ $product->sold_quantity ?? 0 }}</p>
                    <div class="mt-auto">
                        <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-dark w-100">
                            {{ __('product.view_details') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endif
@endsection