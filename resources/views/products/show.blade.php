{{-- Author: Samuel Moncada Mejía, Emmanuel Cortes --}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            @if($viewData['product']->getImage())
            <img src="{{ asset('images/products/' . $viewData['product']->getImage()) }}" class="img-fluid rounded" alt="{{ $viewData['product']->getName() }}">
            @else
            <div class="bg-light d-flex align-items-center justify-content-center rounded product-image-placeholder-lg">
                <span class="text-muted">{{ __('product.no_image') }}</span>
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <h2 class="mb-2">{{ $viewData['product']->getName() }}</h2>
            <p class="text-muted mb-3">{{ __('product.brand') }}: {{ $viewData['product']->getBrand() }}</p>

            <div class="mb-3">
                <h4 class="mb-2">${{ number_format($viewData['product']->getPrice() / 100, 2) }}</h4>
                @if($viewData['product']->getStock() > 0)
                <span class="badge bg-success me-2">{{ __('product.in_stock') }}</span>
                <small class="text-muted">{{ __('product.stock') }}: {{ $viewData['product']->getStock() }}</small>
                @else
                <span class="badge bg-danger">{{ __('product.out_of_stock') }}</span>
                @endif
            </div>

            <div class="mb-4">
                <h5>{{ __('product.description') }}</h5>
                <p>{{ $viewData['product']->getDescription() }}</p>
            </div>

            <div class="mb-4">
                <p><strong>{{ __('product.color') }}:</strong> {{ $viewData['product']->getColor() }}</p>
                <p><strong>{{ __('product.size') }}:</strong> {{ $viewData['product']->getSize() }}</p>
            </div>

            @if($viewData['product']->getStock() > 0)
            <form action="{{ route('cart.add') }}" method="POST" class="mb-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">
                <label class="form-label" for="quantity">{{ __('product.quantity') }}</label>
                <input
                    id="quantity"
                    type="number"
                    name="quantity"
                    value="1"
                    min="1"
                    max="{{ $viewData['product']->getStock() }}"
                    class="form-control mb-2">
                <button type="submit" class="btn btn-dark btn-lg w-100">
                    {{ __('product.add_to_cart') }}
                </button>
            </form>
            @else
            <button class="btn btn-dark btn-lg w-100 mb-3" disabled>
                {{ __('product.out_of_stock') }}
            </button>
            @endif

            @auth
            <a href="{{ route('review.create', $viewData['product']->getId()) }}" class="btn btn-outline-dark btn-lg w-100">
                {{ __('product.write_review') }}
            </a>
            @else
            <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg w-100">
                {{ __('product.login_to_review') }}
            </a>
            @endauth
        </div>
    </div>

    @if($viewData['product']->getReviews()->count() > 0)
    <div class="row mt-5">
        <div class="col-md-12">
            <h4 class="mb-4">{{ __('product.reviews') }} ({{ $viewData['product']->getReviews()->count() }})</h4>

            @foreach($viewData['product']->getReviews() as $review)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title">{{ $review->getUser()->getName() }}</h6>
                            <p class="card-text text-muted small">{{ $review->getCreatedAt() }}</p>
                        </div>
                        <div class="text-warning">
                            @for($i = 0; $i < $review->getRating(); $i++)
                                ★
                                @endfor
                        </div>
                    </div>
                    @if($review->getComment())
                    <p class="card-text">{{ $review->getComment() }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection