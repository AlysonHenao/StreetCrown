{{-- Author: Samuel Moncada Mejía --}}
@props(['product', 'isInWishlist' => false])

@auth
    @if($isInWishlist)
        <form method="POST" action="{{ route('wishlist.remove', $product->getId()) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" {{ $attributes->merge(['class' => 'btn btn-danger btn-sm']) }}>
                <i class="bi bi-heart-fill"></i> {{ __('wishlist.remove_from_wishlist') }}
            </button>
        </form>
    @else
        <form method="POST" action="{{ route('wishlist.add', $product->getId()) }}" style="display: inline;">
            @csrf
            <button type="submit" {{ $attributes->merge(['class' => 'btn btn-outline-danger btn-sm']) }}>
                <i class="bi bi-heart"></i> {{ __('wishlist.add_to_wishlist') }}
            </button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}" {{ $attributes->merge(['class' => 'btn btn-outline-secondary btn-sm']) }}>
        <i class="bi bi-heart"></i> {{ __('wishlist.login_to_add') }}
    </a>
@endauth
