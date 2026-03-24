{{-- Author: Samuel Moncada Mejía, Emmanuel Cortes --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('hero')
<section class="hero-section">
    <div class="container">
        <div class="hero-content" style="justify-content: center; text-align: center;">
            <h1 class="hero-title fade-up-delay-1">Street<br><em>Crown</em></h1>
            <p class="hero-desc fade-up-delay-2" style="max-width: 540px; margin-left: auto; margin-right: auto;">
                Gorras de edición limitada para quienes definen el estilo antes de que exista.
            </p>
            <div class="hero-cta fade-up-delay-3" style="justify-content: center;">
                @auth
                    <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">
                        Ver Colección
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Comenzar
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-dark">
                        Iniciar Sesión
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
            <div class="section-title">Más Vendidos</div>
            <div class="section-subtitle">Top productos por ventas</div>
        </div>
        <a href="{{ route('product.topSelling') }}" class="section-link">Ver todos</a>
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
                            <span class="product-price">{{ number_format($product->getPrice(), 0, ',', '.') }} COP</span>
                            <span style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--c-muted);">
                                {{ $product->sold_quantity ?? 0 }} vendidas
                            </span>
                        </div>
                        <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-outline-dark w-100" style="margin-top: 1rem;">
                            Ver Detalle
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection