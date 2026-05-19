{{-- Author: Alyson Henao --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ __('report.generated_at') }}: {{ $generatedAt }}</p>

    <table border="1">
        <thead>
            <tr>
                <th>{{ __('order.id') }}</th>
                <th>{{ __('order.user') }}</th>
                <th>{{ __('order.email') }}</th>
                <th>{{ __('order.total') }}</th>
                <th>{{ __('order.status') }}</th>
                <th>{{ __('order.payment_method') }}</th>
                <th>{{ __('report.products_quantity') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->getId() }}</td>
                    <td>{{ $order->getUser()?->getName() ?? '-' }}</td>
                    <td>{{ $order->getUser()?->getEmail() ?? '-' }}</td>
                    <td>{{ $order->getTotal() }}</td>
                    <td>{{ __('order.status_' . $order->getStatus()) }}</td>
                    <td>{{ $order->getPaymentMethod() }}</td>
                    <td>{{ $order->getItems()->sum('quantity') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>