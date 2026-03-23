{{-- Author: Alyson Henao --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="mb-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="h4">{{ __('admin.welcome') }}</h2>
            <p class="mb-0">{{ __('admin.description') }}</p>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h3 class="h6 text-muted">{{ __('admin.total_products') }}</h3>
                <p class="display-6 mb-0">{{ $viewData['productsCount'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h3 class="h6 text-muted">{{ __('admin.total_categories') }}</h3>
                <p class="display-6 mb-0">{{ $viewData['categoriesCount'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h3 class="h6 text-muted">{{ __('admin.active_products') }}</h3>
                <p class="display-6 mb-0">{{ $viewData['activeProductsCount'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h3 class="h6 text-muted">{{ __('admin.exclusive_products') }}</h3>
                <p class="display-6 mb-0">{{ $viewData['exclusiveProductsCount'] }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <h3 class="h5">{{ __('admin.products_module') }}</h3>
                <p class="text-muted flex-grow-1">{{ __('admin.products_description') }}</p>
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                    {{ __('admin.go_products') }}
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <h3 class="h5">{{ __('admin.categories_module') }}</h3>
                <p class="text-muted flex-grow-1">{{ __('admin.categories_description') }}</p>
                <a href="{{ route('admin.category.index') }}" class="btn btn-primary">
                    {{ __('admin.go_categories') }}
                </a>
            </div>
        </div>
    </div>

    @if(Route::has('admin.order.index'))
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h3 class="h5">{{ __('admin.orders_module') }}</h3>
                    <p class="text-muted flex-grow-1">{{ __('admin.orders_description') }}</p>
                    <a href="{{ route('admin.order.index') }}" class="btn btn-primary">
                        {{ __('admin.go_orders') }}
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection