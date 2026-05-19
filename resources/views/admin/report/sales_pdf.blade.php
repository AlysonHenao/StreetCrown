{{-- Author: Alyson Henao --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .meta {
            margin-bottom: 18px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f1f1f1;
            font-weight: bold;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>

    <p class="meta">
        {{ __('report.generated_at') }}: {{ $generatedAt }}
    </p>

    <table>
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
                    <td>{{ $order->getFormattedTotal() }}</td>
                    <td>{{ __('order.status_' . $order->getStatus()) }}</td>
                    <td>{{ $order->getPaymentMethod() }}</td>
                    <td>{{ $order->getItems()->sum('quantity') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>