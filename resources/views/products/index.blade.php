{{-- Author: Samuel Moncada Mejía, Alyson Henao --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['title'])

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('product.index') }}" class="row g-3">

            <div class="col-md-5">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="{{ __('product.search_placeholder') }}"
                    value="{{ $viewData['search'] ?? '' }}"
                >
            </div>

            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">{{ __('product.all_categories') }}</option>
                    @foreach($viewData['categories'] ?? [] as $category)
                        <option
                            value="{{ $category->getId() }}"
                            {{ (string)($viewData['selectedCategory'] ?? '') === (string)$category->getId() ? 'selected' : '' }}
                        >
                            {{ $category->getName() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <select name="exclusive" class="form-select">
                    <option value="">{{ __('product.all_products') }}</option>
                    <option value="1" {{ ($viewData['selectedExclusive'] ?? '') === '1' ? 'selected' : '' }}>
                        {{ __('product.exclusive_only') }}
                    </option>
                    <option value="0" {{ ($viewData['selectedExclusive'] ?? '') === '0' ? 'selected' : '' }}>
                        {{ __('product.non_exclusive_only') }}
                    </option>
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('product.search') }}
                </button>
            </div>

            <div class="col-12">
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">
                    {{ __('product.clear_button') }}
                </a>
            </div>

        </form>
    </div>
</div>

@if($viewData['products']->count() > 0)
    <div class="row g-3">
        @foreach($viewData['products'] as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card" style="height: 100%; position: relative;">
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
                    {{-- Wishlist Button --}}
                    @auth
                        <form action="{{ route('wishlist.add', $product->getId()) }}" method="POST" style="position: absolute; top: 0.5rem; right: 0.5rem;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                                ❤
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-light" style="position: absolute; top: 0.5rem; right: 0.5rem; border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            ❤
                        </a>
                    @endauth
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