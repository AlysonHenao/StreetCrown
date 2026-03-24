{{-- Author: StreetCrown Team --}}

@extends('layouts.app')

@section('title', __('layout.app_title'))
@section('subtitle', __('layout.app_subtitle'))

@section('content')
<div class="text-center py-5">
    <h2 class="mb-3">{{ __('layout.brand') }}</h2>
    <p class="text-muted mb-4">{{ __('layout.welcome_lead') }}</p>

    <div class="d-flex justify-content-center gap-2 flex-wrap">
        <a href="{{ route('home.index') }}" class="btn btn-dark">{{ __('layout.home') }}</a>
        <a href="{{ route('product.index') }}" class="btn btn-outline-dark">{{ __('layout.products') }}</a>
    </div>
</div>
@endsection
