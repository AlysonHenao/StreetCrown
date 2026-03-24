{{-- Author: Alyson Henao --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.order.index') }}" class="row g-3">
            <div class="col-md-6">
                <label for="search" class="form-label">{{ __('order.search') }}</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    class="form-control"
                    placeholder="{{ __('order.search_placeholder') }}"
                    value="{{ $viewData['search'] }}"
                >
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label">{{ __('order.filter_status') }}</label>
                <select id="status" name="status" class="form-select">
                    <option value="">{{ __('order.all_statuses') }}</option>
                    @foreach($viewData['statuses'] as $statusKey => $statusLabel)
                        <option value="{{ $statusKey }}" {{ $viewData['status'] === $statusKey ? 'selected' : '' }}>
                            {{ $statusLabel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('order.search') }}
                </button>
            </div>
        </form>
    </div>
</div>

@if($viewData['orders']->isEmpty())
    <div class="alert alert-info">
        {{ __('order.empty_admin') }}
    </div>
@else
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-3">
                    <thead>
                        <tr>
                            <th>{{ __('order.id') }}</th>
                            <th>{{ __('order.user') }}</th>
                            <th>{{ __('order.email') }}</th>
                            <th>{{ __('order.total') }}</th>
                            <th>{{ __('order.status') }}</th>
                            <th>{{ __('order.payment_method') }}</th>
                            <th>{{ __('order.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['orders'] as $order)
                            <tr>
                                <td>{{ $order->getId() }}</td>
                                <td>{{ $order->getUser()->getName() }} </td>
                                <td>{{ $order->getUser()->getEmail() }}</td>
                                <td>${{ number_format($order->getTotal(), 0, ',', '.') }}</td>
                                <td>{{ __('order.status_' . $order->getStatus()) }}</td>
                                <td>{{ $order->getPaymentMethod() }}</td>
                                <td>
                                    <a href="{{ route('admin.order.edit', ['id' => $order->getId()]) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        {{ __('order.edit_button') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $viewData['orders']->links() }}
        </div>
    </div>
@endif
@endsection