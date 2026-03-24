{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mb-4">{{ __('order.show_title') }} #{{ $viewData['order']->getId() }}</h2>

            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">{{ __('order.order_details') }}</h5>
                </div>
                <div class="card-body text-white">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>{{ __('order.date') }}:</strong> {{ $viewData['order']->getDate() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <strong>{{ __('order.status') }}:</strong>
                                @if($viewData['order']->getStatus() === 'pending' || $viewData['order']->getStatus() === 'placed')
                                <span class="badge bg-warning">{{ __('order.status_pending') }}</span>
                                @elseif($viewData['order']->getStatus() === 'completed' || $viewData['order']->getStatus() === 'paid')
                                <span class="badge bg-success">{{ __('order.status_completed') }}</span>
                                @elseif($viewData['order']->getStatus() === 'cancelled')
                                <span class="badge bg-danger">{{ __('order.status_cancelled') }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>{{ __('order.payment_method') }}:</strong> {{ $viewData['order']->getPaymentMethod() }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{ __('order.total') }}:</strong> <span class="text-success fw-bold">{{ number_format($viewData['order']->getTotal(), 0, ',', '.') }} COP</span></p>
                        </div>
                    </div>
                </div>
            </div>

            @if($viewData['order']->getItems()->isNotEmpty())
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">{{ __('order.items') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>{{ __('order.product') }}</th>
                                    <th>{{ __('order.quantity') }}</th>
                                    <th>{{ __('order.price') }}</th>
                                    <th>{{ __('order.subtotal') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewData['order']->getItems() as $item)
                                <tr>
                                    <td>{{ $item->getProduct()->getName() }}</td>
                                    <td>{{ $item->getQuantity() }}</td>
                                    <td>{{ number_format($item->getPrice(), 0, ',', '.') }} COP</td>
                                    <td>{{ number_format(($item->getPrice() * $item->getQuantity()), 0, ',', '.') }} COP</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">{{ __('order.order_summary') }}</h5>
                </div>
                <div class="card-body text-white">
                    <p><strong>{{ __('order.order_id') }}:</strong> #{{ $viewData['order']->getId() }}</p>
                    <p><strong>{{ __('order.created_at') }}:</strong> {{ $viewData['order']->getCreatedAt() }}</p>
                    <hr />
                    <p class="text-end">
                        <strong>{{ __('order.total') }}:</strong><br />
                        <span class="text-success fs-5 fw-bold">{{ number_format($viewData['order']->getTotal(), 0, ',', '.') }} COP</span>
                    </p>
                </div>
            </div>

            <a href="{{ route('order.index') }}" class="btn btn-secondary w-100 mt-3">
                {{ __('order.back_to_orders') }}
            </a>
        </div>
    </div>
</div>
@endsection