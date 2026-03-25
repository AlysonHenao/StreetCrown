{{-- Author: Samuel Moncada Mejía, Emmanuel Cortes, Alyson Henao --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('hero')
<section class="hero-section">
    <div class="container">
        <div class="hero-content" style="justify-content: center; text-align: center;">
            <h1 class="hero-title fade-up-delay-1">
                {!! __('home.hero_title') !!}
            </h1>

            <p class="hero-desc fade-up-delay-2" style="max-width: 540px; margin-left: auto; margin-right: auto;">
                {{ __('home.hero_description') }}
            </p>

            <div class="hero-cta fade-up-delay-3" style="justify-content: center;">
                @auth
                    <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">
                        {{ __('home.hero_view_collection') }}
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        {{ __('home.hero_start') }}
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-dark">
                        {{ __('home.hero_login') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div style="margin-top: 3rem;">
    <div class="section-header">
        <div>
            <div class="section-title">{{ __('home.top_selling_title') }}</div>
            <div class="section-subtitle">{{ __('home.top_selling_subtitle') }}</div>
        </div>
        <a href="{{ route('product.topSelling') }}" class="section-link">{{ __('home.view_all') }}</a>
    </div>

    @if($viewData['topProducts']->isEmpty())
        <div class="alert alert-info">
            {{ __('product.top_selling_empty') }}
        </div>
    @else
        <div class="row g-3">
            @foreach($viewData['topProducts'] as $index => $product)
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            @if($product->getImage())
                                <img src="{{ asset('images/products/' . $product->getImage()) }}" alt="{{ $product->getName() }}">
                            @else
                                <div class="product-img-placeholder">
                                    <span>{{ __('product.no_image') }}</span>
                                </div>
                            @endif

                            <div style="position: absolute; top: 12px; left: 12px; font-family: var(--font-display); font-size: 3rem; color: rgba(201,169,110,0.15); line-height: 1; pointer-events: none;">
                                0{{ $index + 1 }}
                            </div>
                        </div>

                        <div class="product-body">
                            <div class="product-brand">{{ $product->getBrand() }}</div>
                            <div class="product-name">{{ $product->getName() }}</div>

                            <div class="product-footer">
                                <span class="product-price">{{ $product->getFormattedPrice() }}</span>
                                <span style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--c-muted);">
                                    {{ $product->getSoldQuantity() }} {{ __('home.units_sold') }}
                                </span>
                            </div>

                            <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-outline-dark w-100" style="margin-top: 1rem;">
                                {{ __('home.view_detail') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div style="margin-top: 4rem;">
    <div class="section-header">
        <div>
            <div class="section-title">{{ __('home.top_rated_title') }}</div>
            <div class="section-subtitle">{{ __('home.top_rated_subtitle') }}</div>
        </div>
    </div>

    @if($viewData['topRatedProducts']->isEmpty())
        <div class="alert alert-info">
            {{ __('home.top_rated_empty') }}
        </div>
    @else
        <div class="row g-3">
            @foreach($viewData['topRatedProducts'] as $index => $product)
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            @if($product->getImage())
                                <img src="{{ asset('images/products/' . $product->getImage()) }}" alt="{{ $product->getName() }}">
                            @else
                                <div class="product-img-placeholder">
                                    <span>{{ __('product.no_image') }}</span>
                                </div>
                            @endif

                            <div style="position: absolute; top: 12px; left: 12px; font-family: var(--font-display); font-size: 3rem; color: rgba(201,169,110,0.15); line-height: 1; pointer-events: none;">
                                0{{ $index + 1 }}
                            </div>
                        </div>

                        <div class="product-body">
                            <div class="product-brand">{{ $product->getBrand() }}</div>
                            <div class="product-name">{{ $product->getName() }}</div>

                            <div class="product-footer">
                                <span class="product-price">{{ $product->getFormattedPrice() }}</span>
                                <span style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--c-muted);">
                                    {{ __('home.average_rating') }}:
                                    {{ $product->getFormattedAverageRating() }}/5
                                </span>
                            </div>

                            <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-outline-dark w-100" style="margin-top: 1rem;">
                                {{ __('home.view_detail') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection