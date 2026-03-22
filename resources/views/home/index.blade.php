{{-- Author: Samuel Moncada Mejía --}}

@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', __('layout.app_subtitle'))

@section('content')
<div class="text-center py-5">
    <h1 class="display-5 fw-bold mb-3">{{ __('layout.brand') }}</h1>
    <p class="lead text-muted mb-4">{{ __('layout.welcome_lead') }}</p>
    @auth
        <p class="text-muted">Explora nuestra colección.</p>
    @else
        <a href="{{ route('login') }}" class="btn btn-dark btn-lg px-4 me-2">
            {{ __('layout.login') }}
        </a>
        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg px-4">
            {{ __('layout.register') }}
        </a>
    @endauth
</div>
@endsection