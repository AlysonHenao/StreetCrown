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
                    <td>{{ $cartItem->getFormattedPrice() }}</td>
                    <td>
                        <input
                            type="number"
                            class="form-control quantity-input"
                            min="1"
                            max="{{ $cartItem->getProduct()->getStock() }}"
                            value="{{ $cartItem->getQuantity() }}"
                            data-product-id="{{ $cartItem->getProductId() }}"
                            data-csrf="{{ csrf_token() }}"
                            data-route="{{ route('cart.update', $cartItem->getProductId()) }}"
                            data-error-message="{{ __('order.cart_update_error') }}">
                    </td>
                    <td class="subtotal-cell">{{ $cartItem->getFormattedSubTotal() }}</td>
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
    <br>
    <p><strong>{{ __('order.total_items') }}:</strong> <span id="total-quantity">{{ $viewData['totalQuantity'] }}</span></p>
    <p><strong>{{ __('order.total') }}:</strong> <span id="total-amount">
            {{ number_format($viewData['totalAmount'], 0, ',', '.') }} {{ __('product.currency') }}
        </span></p>
    <br>
    <form action="{{ route('cart.clear') }}" method="POST" class="mb-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-warning">{{ __('order.clear_cart') }}</button>
    </form>

    <a href="{{ route('order.checkout') }}" class="btn btn-success">{{ __('order.place_order') }}</a>
    @else
    <p>{{ __('order.cart_empty') }}</p>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');

        quantityInputs.forEach(input => {
            input.addEventListener('input', async function() {
                const quantity = this.value;
                if (quantity < 1) return;

                const route = this.dataset.route;
                const csrfToken = this.dataset.csrf;
                const errorMessage = this.dataset.errorMessage;

                try {
                    const response = await fetch(route, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            quantity
                        })
                    });

                    if (!response.ok) {
                        throw new Error(errorMessage);
                    }

                    const data = await response.json();

                    if (data.success) {
                        const row = this.closest('tr');
                        const subtotalCell = row.querySelector('.subtotal-cell');
                        subtotalCell.textContent = new Intl.NumberFormat('es-CO', {
                            style: 'currency',
                            currency: 'COP',
                            minimumFractionDigits: 0
                        }).format(data.subtotal);

                        document.getElementById('total-quantity').textContent = data.totalQuantity;
                        document.getElementById('total-amount').textContent = new Intl.NumberFormat('es-CO', {
                            style: 'currency',
                            currency: 'COP',
                            minimumFractionDigits: 0
                        }).format(data.totalAmount);
                    }
                } catch (error) {
                    console.error('Cart update error:', error);
                    alert(errorMessage);
                    location.reload();
                }
            });
        });
    });
</script>
@endsection