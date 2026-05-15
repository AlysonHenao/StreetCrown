@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>{{ $viewData['title'] }}</h1>

    @if(count($viewData['products']) === 0)
    <p>{{ __('partner_product.empty') }}</p>
    @else
    <div class="row">
        @foreach($viewData['products'] as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if(!empty($product['image_url']))
                <img
                    src="{{ $product['image_url'] }}"
                    class="card-img-top"
                    alt="{{ $product['name'] }}">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $product['name'] }}</h5>

                    <p class="card-text">
                        {{ $product['formatted_price'] ?? $product['price'] }}
                    </p>

                    <p class="card-text">
                        {{ __('partner_product.stock') }}:
                        {{ $product['stock'] ?? __('partner_product.not_available') }}
                    </p>

                    @if(!empty($product['product_url']))
                    <a
                        href="{{ $product['product_url'] }}"
                        class="btn btn-primary"
                        target="_blank"
                        rel="noopener noreferrer">
                        {{ __('partner_product.view_product') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection