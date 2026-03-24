{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ __('product.index_title') }}</h2>

    @if($viewData['products']->count() > 0)
    <div class="row g-4">
        @foreach($viewData['products'] as $product)
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
                    <p class="card-text text-muted small">{{ $product->getBrand() }}</p>
                    <p class="card-text small">{{ Str::limit($product->getDescription(), 100) }}</p>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="h5 mb-0">{{ number_format($product->getPrice(), 0, ',', '.') }} COP</span>
                            @if($product->getStock() > 0)
                            <span class="badge bg-success">{{ __('product.in_stock') }}</span>
                            @else
                            <span class="badge bg-danger">{{ __('product.out_of_stock') }}</span>
                            @endif
                        </div>
                        @if(!empty($viewData['showSoldQuantity']))
                        <p class="text-muted small mb-3">
                            {{ __('product.units_sold') }}: {{ $product->sold_quantity }}
                        </p>
                        @endif
                        <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-dark w-100">
                            {{ __('product.view_details') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if(!empty($viewData['showPagination']))
    <div class="mt-5">
        {{ $viewData['products']->links() }}
    </div>
    @endif
    @else
    <div class="alert alert-info text-center py-5">
        <p>{{ __('product.no_products') }}</p>
    </div>
    @endif
</div>
@endsection