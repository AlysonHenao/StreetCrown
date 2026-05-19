{{-- Author: Alyson Henao --}}

@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="stat-grid">
    <div class="stat-item">
        <div class="stat-value">{{ $viewData['productsCount'] }}</div>
        <div class="stat-label">{{ __('admin.total_products') }}</div>
    </div>
    <div class="stat-item">
        <div class="stat-value">{{ $viewData['categoriesCount'] }}</div>
        <div class="stat-label">{{ __('admin.total_categories') }}</div>
    </div>
    <div class="stat-item">
        <div class="stat-value">{{ $viewData['activeProductsCount'] }}</div>
        <div class="stat-label">{{ __('admin.active_products') }}</div>
    </div>
    <div class="stat-item">
        <div class="stat-value">{{ $viewData['exclusiveProductsCount'] }}</div>
        <div class="stat-label">{{ __('admin.exclusive_products') }}</div>
    </div>
</div>

<div class="admin-module-grid">
    <div class="admin-module-item">
        <div class="admin-module-title">{{ __('admin.products_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.products_description') }}</p>
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">{{ __('admin.go_products') }}</a>
    </div>

    <div class="admin-module-item">
        <div class="admin-module-title">{{ __('admin.categories_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.categories_description') }}</p>
        <a href="{{ route('admin.category.index') }}" class="btn btn-primary">{{ __('admin.go_categories') }}</a>
    </div>

    @if(Route::has('admin.order.index'))
    <div class="admin-module-item">
        <div class="admin-module-title">{{ __('admin.orders_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.orders_description') }}</p>
        <a href="{{ route('admin.order.index') }}" class="btn btn-primary">{{ __('admin.go_orders') }}</a>
    </div>
    @endif

    @if(Route::has('admin.report.index'))
    <div class="admin-module-item">
        <div class="admin-module-title">{{ __('admin.reports_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.reports_description') }}</p>
        <a href="{{ route('admin.report.index') }}" class="btn btn-primary">{{ __('admin.go_reports') }}</a>
    </div>
    @endif

    @if(Route::has('admin.user.index'))
    <div class="admin-module-item">
        <div class="admin-module-title">{{ __('admin.users_module') }}</div>
        <p class="admin-module-desc">{{ __('admin.users_description') }}</p>
        <a href="{{ route('admin.user.index') }}" class="btn btn-primary">{{ __('admin.go_users') }}</a>
    </div>
    @endif
</div>
@endsection