{{-- Author: Emmanuel Cortes --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $viewData['title'] }}</h1>

    @if($viewData['orders']->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order</th>
                <th>Date</th>
                <th>Status</th>
                <th>Payment method</th>
                <th>Total</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($viewData['orders'] as $order)
            <tr>
                <td>#{{ $order->getId() }}</td>
                <td>{{ $order->getDate() }}</td>
                <td>{{ $order->getStatus() }}</td>
                <td>{{ $order->getPaymentMethod() }}</td>
                <td>${{ $order->getTotal() }}</td>
                <td>
                    <a href="{{ route('order.show', $order->getId()) }}" class="btn btn-sm btn-primary">
                        View detail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You do not have orders yet.</p>
    @endif
</div>
@endsection