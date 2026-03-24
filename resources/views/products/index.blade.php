{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'])

@section('content')
@if($viewData['products']->count() > 0)
    <div class="row g-3">
        @foreach($viewData['products'] as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card" style="height: 100%;">
                <div class="product-img-wrap">
                    @if($product->getImage())
                        <img src="{{ asset('images/products/' . $product->getImage()) }}" alt="{{ $product->getName() }}">
                    @else
                        <div class="product-img-placeholder">
                            <span>{{ __('product.no_image') }}</span>
                        </div>
                    @endif
                    @if($product->getExclusive())
                        <span class="badge-exclusive">Exclusivo</span>
                    @endif
                </div>
                <div class="product-body">
                    <div class="product-brand">{{ $product->getBrand() }}</div>
                    <div class="product-name">{{ $product->getName() }}</div>
                    <div class="product-footer">
                        <span class="product-price">{{ number_format($product->getPrice(), 0, ',', '.') }} COP</span>
                        @if($product->getStock() > 0)
                            <span class="stock-badge in-stock">{{ __('product.in_stock') }}</span>
                        @else
                            <span class="stock-badge out-stock">{{ __('product.out_of_stock') }}</span>
                        @endif
                    </div>
                    @if(!empty($viewData['showSoldQuantity']))
                        <p style="font-size: 0.7rem; color: var(--c-muted); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 0.5rem;">
                            {{ $product->sold_quantity }} {{ __('product.units_sold') }}
                        </p>
                    @endif
                    <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-outline-dark w-100" style="margin-top: 0.875rem;">
                        {{ __('product.view_details') }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if(!empty($viewData['showPagination']))
        <div class="d-flex justify-content-center mt-4">
            {{ $viewData['products']->links() }}
        </div>
    @endif
@else
    <div class="alert alert-info" style="text-align: center; padding: 4rem 2rem;">
        <p style="font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase;">
            {{ __('product.no_products') }}
        </p>
    </div>
@endif
@endsection