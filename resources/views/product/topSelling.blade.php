{{-- Author: Emmanuel Cortes --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $viewData['title'] }}</h1>

    @if($viewData['products']->count() > 0)
    <div class="row">
        @foreach($viewData['products'] as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img
                    src="{{ asset('storage/' . $product->getImage()) }}"
                    class="card-img-top"
                    alt="{{ $product->getName() }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->getName() }}</h5>
                    <p class="card-text"><strong>{{ __('product.brand') }}:</strong> {{ $product->getBrand() }}</p>
                    <p class="card-text"><strong>{{ __('product.price') }}:</strong> ${{ $product->getPrice() }}</p>
                    <p class="card-text"><strong>{{ __('product.units_sold') }}:</strong> {{ $product->sold_quantity }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>{{ __('product.top_selling_empty') }}</p>
    @endif
</div>
@endsection