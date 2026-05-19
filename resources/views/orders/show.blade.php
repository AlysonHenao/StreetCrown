{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-5 order-show-page">
    <div class="order-hero mb-4">
        <div>
            <p class="order-hero-label mb-2">{{ __('order.order_details') }}</p>
            <h1 class="order-hero-title mb-0">{{ __('order.show_title') }} #{{ $viewData['order']->getId() }}</h1>
        </div>
        <div class="order-hero-chip">
            @if($viewData['order']->getStatus() === 'pending')
            <span class="badge bg-warning text-dark">{{ __('order.status_pending') }}</span>
            @elseif($viewData['order']->getStatus() === 'paid')
            <span class="badge bg-success">{{ __('order.status_paid') }}</span>
            @elseif($viewData['order']->getStatus() === 'shipped')
            <span class="badge bg-primary">{{ __('order.status_shipped') }}</span>
            @elseif($viewData['order']->getStatus() === 'delivered')
            <span class="badge bg-success">{{ __('order.status_delivered') }}</span>
            @elseif($viewData['order']->getStatus() === 'cancelled')
            <span class="badge bg-danger">{{ __('order.status_cancelled') }}</span>
            @endif
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card order-card mb-4">
                <div class="card-header">{{ __('order.order_details') }}</div>
                <div class="card-body">
                    <div class="order-meta-grid">
                        <div class="order-meta-item">
                            <span class="order-meta-label">{{ __('order.date') }}</span>
                            <span class="order-meta-value">{{ $viewData['order']->getDate() }}</span>
                        </div>
                        <div class="order-meta-item">
                            <span class="order-meta-label">{{ __('order.payment_method') }}</span>
                            <span class="order-meta-value">{{ $viewData['order']->getPaymentMethod() }}</span>
                        </div>
                        <div class="order-meta-item">
                            <span class="order-meta-label">{{ __('order.total') }}</span>
                            <span class="order-meta-value text-success">{{ $viewData['order']->getFormattedTotal() }}</span>
                        </div>
                        <div class="order-meta-item">
                            <span class="order-meta-label">{{ __('order.status') }}</span>
                            <span class="order-meta-value">
                                @if($viewData['order']->getStatus() === 'pending')
                                <span class="badge bg-warning text-dark">{{ __('order.status_pending') }}</span>
                                @elseif($viewData['order']->getStatus() === 'paid')
                                <span class="badge bg-success">{{ __('order.status_paid') }}</span>
                                @elseif($viewData['order']->getStatus() === 'shipped')
                                <span class="badge bg-primary">{{ __('order.status_shipped') }}</span>
                                @elseif($viewData['order']->getStatus() === 'delivered')
                                <span class="badge bg-success">{{ __('order.status_delivered') }}</span>
                                @elseif($viewData['order']->getStatus() === 'cancelled')
                                <span class="badge bg-danger">{{ __('order.status_cancelled') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @if($viewData['order']->getItems()->isNotEmpty())
            <div class="card order-card">
                <div class="card-header">{{ __('order.items') }}</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 order-items-table">
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
                                    <td>{{ $item->getFormattedPrice() }}</td>
                                    <td>{{ $item->getFormattedSubTotal() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card order-card mb-4">
                <div class="card-header">{{ __('order.order_summary') }}</div>
                <div class="card-body">
                    <div class="order-summary-line">
                        <span>{{ __('order.order_id') }}</span>
                        <strong>#{{ $viewData['order']->getId() }}</strong>
                    </div>
                    <div class="order-summary-line">
                        <span>{{ __('order.created_at') }}</span>
                        <strong>{{ $viewData['order']->getCreatedAt() }}</strong>
                    </div>
                    <hr />
                    <div class="order-summary-total">
                        <span>{{ __('order.total') }}</span>
                        <strong>{{ $viewData['order']->getFormattedTotal() }}</strong>
                    </div>
                </div>
            </div>

            <div class="card order-card mb-4">
                <div class="card-header">{{ __('order.customer_info') }}</div>
                <div class="card-body">
                    <div class="order-customer-grid">
                        <div>
                            <span class="order-meta-label">{{ __('profile.name') }}</span>
                            <div class="order-customer-value">{{ $viewData['order']->getUser()->getName() }}</div>
                        </div>
                        <div>
                            <span class="order-meta-label">{{ __('profile.email') }}</span>
                            <div class="order-customer-value">{{ $viewData['order']->getUser()->getEmail() }}</div>
                        </div>
                        <div>
                            <span class="order-meta-label">{{ __('profile.phone') }}</span>
                            <div class="order-customer-value">{{ $viewData['order']->getUser()->getPhone() ?? '—' }}</div>
                        </div>
                        <div>
                            <span class="order-meta-label">{{ __('profile.address') }}</span>
                            <div class="order-customer-value">{{ $viewData['order']->getUser()->getAddress() ?? '—' }}</div>
                        </div>
                        <div>
                            <span class="order-meta-label">{{ __('profile.city') }}</span>
                            <div class="order-customer-value">{{ $viewData['order']->getUser()->getCity() ?? '—' }}</div>
                        </div>
                        <div>
                            <span class="order-meta-label">{{ __('profile.postal_code') }}</span>
                            <div class="order-customer-value">{{ $viewData['order']->getUser()->getPostalCode() ?? '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('order.index') }}" class="btn btn-outline-light w-100">
                {{ __('order.back_to_orders') }}
            </a>
        </div>
    </div>
</div>
@endsection