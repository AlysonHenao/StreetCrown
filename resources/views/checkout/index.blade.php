{{-- Author: Emmanuel Cortes, Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $viewData['title'] }}</h1>

    <div class="row">
        <div class="col-md-6">
            <h4>{{ __('order.order_summary') }}</h4>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('order.product') }}</th>
                            <th>{{ __('order.quantity') }}</th>
                            <th>{{ __('order.price') }}</th>
                            <th>{{ __('order.subtotal') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['cartItems'] as $cartItem)
                        <tr>
                            <td>{{ $cartItem->getProduct()->getName() }}</td>
                            <td>{{ $cartItem->getQuantity() }}</td>
                            <td>{{ $cartItem->getFormattedPrice() }}</td>
                            <td>{{ $cartItem->getFormattedSubTotal() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="alert alert-info">
                <p><strong>{{ __('order.total_items') }}:</strong> {{ $viewData['totalQuantity'] }}</p>
                <p><strong>{{ __('order.total') }}:</strong> {{ number_format($viewData['totalAmount'], 0, ',', '.') }} {{ __('product.currency') }}</p>
            </div>
        </div>

        <div class="col-md-6">
            <h4>{{ __('checkout.personal_details') }}</h4>

            <form action="{{ route('order.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('checkout.name') }}</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $viewData['user']->getName()) }}"
                        required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('checkout.email') }}</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $viewData['user']->getEmail()) }}"
                        required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('checkout.phone') }}</label>
                    <input
                        type="tel"
                        name="phone"
                        id="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $viewData['user']->getPhone()) }}"
                        required>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('checkout.address') }}</label>
                    <input
                        type="text"
                        name="address"
                        id="address"
                        class="form-control @error('address') is-invalid @enderror"
                        value="{{ old('address', $viewData['user']->getAddress()) }}"
                        required>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">{{ __('checkout.city') }}</label>
                    <input
                        type="text"
                        name="city"
                        id="city"
                        class="form-control @error('city') is-invalid @enderror"
                        value="{{ old('city', $viewData['user']->getCity()) }}"
                        required>
                    @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="postal_code" class="form-label">{{ __('checkout.postal_code') }}</label>
                    <input
                        type="text"
                        name="postal_code"
                        id="postal_code"
                        class="form-control @error('postal_code') is-invalid @enderror"
                        value="{{ old('postal_code', $viewData['user']->getPostalCode()) }}"
                        required>
                    @error('postal_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="payment_method" class="form-label">{{ __('checkout.payment_method') }}</label>
                    <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                        <option value="">{{ __('checkout.select_payment_method') }}</option>
                        <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>{{ __('order.payment_cash') }}</option>
                        <option value="card" {{ old('payment_method') === 'card' ? 'selected' : '' }}>{{ __('order.payment_card') }}</option>
                        <option value="transfer" {{ old('payment_method') === 'transfer' ? 'selected' : '' }}>{{ __('order.payment_transfer') }}</option>
                    </select>
                    @error('payment_method')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('cart.index') }}" class="btn btn-secondary">{{ __('checkout.back_to_cart') }}</a>
                    <button type="submit" class="btn btn-success">{{ __('checkout.confirm_order') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection