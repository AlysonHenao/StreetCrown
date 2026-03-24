{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">{{ __('order.index_title') }}</h2>

            @if($viewData['orders']->isEmpty())
            <div class="alert alert-info" role="alert">
                {{ __('order.no_orders') }}
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('order.order_id') }}</th>
                            <th>{{ __('order.date') }}</th>
                            <th>{{ __('order.total') }}</th>
                            <th>{{ __('order.status') }}</th>
                            <th>{{ __('order.payment_method') }}</th>
                            <th>{{ __('order.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['orders'] as $order)
                        <tr>
                            <td>#{{ $order->getId() }}</td>
                            <td>{{ $order->getDate() }}</td>
                            <td>{{ number_format($order->getTotal(), 0, ',', '.') }} COP</td>
                            <td>
                                @if($order->getStatus() === 'pending' || $order->getStatus() === 'placed')
                                <span class="badge bg-warning">{{ __('order.status_pending') }}</span>
                                @elseif($order->getStatus() === 'completed' || $order->getStatus() === 'paid')
                                <span class="badge bg-success">{{ __('order.status_completed') }}</span>
                                @elseif($order->getStatus() === 'cancelled')
                                <span class="badge bg-danger">{{ __('order.status_cancelled') }}</span>
                                @endif
                            </td>
                            <td>{{ $order->getPaymentMethod() }}</td>
                            <td>
                                <a href="{{ route('order.show', $order->getId()) }}" class="btn btn-sm btn-primary">
                                    {{ __('order.view') }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection