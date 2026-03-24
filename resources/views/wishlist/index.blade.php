{{-- Author: Samuel Moncada Mejía --}}
@extends('layouts.app')

@section('title', __('wishlist.title'))

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ __('wishlist.title') }}</h1>
        </div>
        <div class="col-md-4 text-end">
            @if($wishlistCount > 0)
            @php
                $confirmMessage = __('wishlist.clear_wishlist');
            @endphp
            <form method="POST" action="{{ route('wishlist.clear') }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('{{ $confirmMessage }}?');">
                    {{ __('wishlist.clear_wishlist') }}
                </button>
            </form>
            @endif
        </div>
    </div>

    @if($wishlistItems->isNotEmpty())
    <div class="row">
        @foreach($wishlistItems as $product)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div style="height: 250px; overflow: hidden; background-color: #f5f5f5;">
                    @if($product->getImage())
                    <img src="{{ asset('images/products/' . $product->getImage()) }}" 
                         class="card-img-top" 
                         alt="{{ $product->getName() }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                        <span class="text-muted">No image</span>
                    </div>
                    @endif
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->getName() }}</h5>
                    <p class="card-text text-muted">{{ $product->getBrand() }} - {{ $product->getSize() }}</p>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $product->getColor() }}</span>
                        @if($product->getExclusive())
                        <span class="badge bg-warning">Exclusive</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <p class="h5 mb-0">
                            <strong>{{ number_format($product->getPrice(), 0, ',', '.') }} COP</strong>
                            @if($product->getDiscount() > 0)
                            <small class="text-muted"><del>{{ number_format($product->getPrice() + $product->getDiscount(), 0, ',', '.') }} COP</del></small>
                            @endif
                        </p>
                    </div>

                    @if($product->getStock() <= 0)
                    <p class="text-danger mb-3"><strong>{{ __('wishlist.out_of_stock') }}</strong></p>
                    @else
                    <p class="text-success mb-3"><strong>{{ __('wishlist.in_stock') }} ({{ $product->getStock() }})</strong></p>
                    @endif

                    <div class="mt-auto d-grid gap-2">
                        @if($product->getStock() > 0)
                        <form method="POST" action="{{ route('cart.add') }}" style="display: inline; width: 100%;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->getId() }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                {{ __('wishlist.add_to_cart') }}
                            </button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-sm w-100" disabled>{{ __('wishlist.out_of_stock') }}</button>
                        @endif
                        
                        <form method="POST" action="{{ route('wishlist.remove', $product->getId()) }}" style="display: inline; width: 100%;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                {{ __('wishlist.remove_from_wishlist') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info text-center py-5">
        <h4>{{ __('wishlist.wishlist_empty') }}</h4>
        <p class="mb-0">{{ __('wishlist.start_adding') }}</p>
        <a href="{{ route('product.index') }}" class="btn btn-primary mt-3">
            {{ __('wishlist.continue_shopping') }}
        </a>
    </div>
    @endif
</div>

<script>
function addToCart(event, productId) {
    event.preventDefault();
    // This would typically use AJAX to add to cart, 
    // or redirect to product page with an add-to-cart action
    alert('Add to cart functionality should be implemented');
}
</script>
@endsection
