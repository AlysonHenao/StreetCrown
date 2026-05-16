{{-- Author: Emmanuel Cortés --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>{{ $viewData['title'] }}</h1>

    @if(count($viewData['products']) === 0)
    <p>{{ __('partner_product.empty') }}</p>
    @else
    <div class="row">
        @foreach($viewData['products'] as $movie)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if(!empty($movie['file_name']))
                <img
                    src="{{ asset('storage/movies/'.$movie['file_name']) }}"
                    class="card-img-top"
                    alt="{{ $movie['title'] }}">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $movie['title'] }}</h5>
                    <p class="card-text">
                        <strong>{{ __('partner_product.director') }}:</strong> {{ $movie['director'] }}
                    </p>
                    <p class="card-text">
                        <strong>{{ __('partner_product.genre') }}:</strong> {{ $movie['genre'] }}
                    </p>
                    <p class="card-text">
                        <strong>{{ __('partner_product.views') }}:</strong> {{ $movie['views'] }}
                    </p>
                    <p class="card-text">
                        <strong>{{ __('partner_product.classification') }}:</strong> {{ $movie['classification'] }}
                    </p>
                    <p class="card-text">
                        <strong>{{ __('partner_product.description') }}:</strong> {{ $movie['description'] }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection