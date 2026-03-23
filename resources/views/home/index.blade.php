{{-- Author: Samuel Moncada Mejía, Emmanuel Cortes --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', __('layout.app_subtitle'))

@section('content')
<div class="text-center py-5">
    <h1 class="display-5 fw-bold mb-3">{{ __('layout.brand') }}</h1>
    <p class="lead text-muted mb-4">{{ __('layout.welcome_lead') }}</p>
    @auth
    <p class="text-muted">{{ __('layout.view_products') }}</p>
    @else
    <a href="{{ route('login') }}" class="btn btn-dark btn-lg px-4 me-2">
        {{ __('layout.login') }}
    </a>
    <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg px-4">
        {{ __('layout.register') }}
    </a>
    @endauth
</div>

<div class="mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">{{ __('product.top_selling_title') }}</h2>
        <a href="{{ route('product.topSelling') }}" class="btn btn-sm btn-outline-dark">
            {{ __('product.view_details') }}
        </a>
    </div>

    @if($viewData['topProducts']->isEmpty())
    <div class="alert alert-info" role="alert">
        {{ __('product.top_selling_empty') }}
    </div>
    @else
    <div class="row g-4">
        @foreach($viewData['topProducts'] as $product)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                @if($product->getImage())
                <img src="{{ asset('images/products/' . $product->getImage()) }}" class="card-img-top" alt="{{ $product->getName() }}">
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center product-image-placeholder-md">
                    <span class="text-muted">{{ __('product.no_image') }}</span>
                </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->getName() }}</h5>
                    <p class="card-text text-muted small mb-1">{{ $product->getBrand() }}</p>
                    <p class="card-text small mb-3">{{ __('product.units_sold') }}: {{ $product->sold_quantity ?? 0 }}</p>
                    <div class="mt-auto">
                        <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-dark w-100">
                            {{ __('product.view_details') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection