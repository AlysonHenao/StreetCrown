{{-- Author: Emmanuel Cortes, Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $viewData['title'] }}</h1>

    <div class="row">
        <div class="col-md-7">
            <h4 style="font-family: var(--font-display); letter-spacing: 0.04em; text-transform: uppercase; margin-bottom: 1rem;">
                {{ __('order.order_summary') }}
            </h4>
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

        <div class="col-md-5">
            <h4 style="font-family: var(--font-display); letter-spacing: 0.04em; text-transform: uppercase; margin-bottom: 1rem;">
                {{ __('checkout.delivery_info') }}
            </h4>

            <div style="border: 1px solid var(--c-border); border-radius: var(--radius-md); overflow: hidden; margin-bottom: 1.5rem;">
                @foreach([
                    __('profile.name') => $viewData['user']->getName(),
                    __('profile.phone') => $viewData['user']->getPhone(),
                    __('profile.address') => $viewData['user']->getAddress(),
                    __('profile.city') => $viewData['user']->getCity(),
                    __('profile.postal_code') => $viewData['user']->getPostalCode(),
                ] as $label => $value)
                    <div style="display: flex; padding: 0.75rem 1rem; border-bottom: 1px solid var(--c-border); background: var(--c-surface);">
                        <span style="font-size: 0.68rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--c-muted); width: 120px; flex-shrink: 0;">{{ $label }}</span>
                        <span style="font-size: 0.88rem; color: var(--c-text);">{{ $value ?? '—' }}</span>
                    </div>
                @endforeach
            </div>

            <p style="font-size: 0.78rem; color: var(--c-muted);">
                {{ __('checkout.wrong_data') }}
                <a href="{{ route('profile.edit') }}">{{ __('checkout.edit_profile') }}</a>
            </p>

            <form action="{{ route('order.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="payment_method" class="form-label">{{ __('checkout.payment_method') }}</label>
                    <select name="payment_method" id="payment_method"
                            class="form-select @error('payment_method') is-invalid @enderror" required>
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