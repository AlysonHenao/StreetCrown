<?php

// Author: Samuel Moncada Mejía

namespace App\Http\Controllers;

use App\Contracts\WishlistServiceInterface;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function __construct(private WishlistServiceInterface $wishlistService) {}

    /**
     * Display user's wishlist.
     */
    public function index(Request $request): View
    {
        $wishlistItems = $this->wishlistService->getWishlist($request->user());
        $wishlistCount = $this->wishlistService->getWishlistCount($request->user());

        $viewData = [
            'wishlistItems' => $wishlistItems,
            'wishlistCount' => $wishlistCount,
        ];

        return view('wishlist.index', $viewData);
    }

    /**
     * Add product to wishlist.
     */
    public function add(Request $request, Product $product): RedirectResponse
    {
        $added = $this->wishlistService->addProduct($request->user(), $product);

        if ($added) {
            return back()->with('success', 'Product added to wishlist');
        }

        return back()->with('info', 'Product already in wishlist');
    }

    /**
     * Remove product from wishlist.
     */
    public function remove(Request $request, Product $product): RedirectResponse
    {
        $this->wishlistService->removeProduct($request->user(), $product);

        return back()->with('success', 'Product removed from wishlist');
    }

    /**
     * Add all wishlist items to cart.
     */
    public function addAllToCart(Request $request): RedirectResponse
    {
        $wishlistItems = $this->wishlistService->getWishlist($request->user());

        if ($wishlistItems->isEmpty()) {
            return back()->with('info', 'Wishlist is empty');
        }

        return redirect()->route('cart.index')->with('success', 'Wishlist items can be added to cart manually');
    }

    /**
     * Clear entire wishlist.
     */
    public function clear(Request $request): RedirectResponse
    {
        $this->wishlistService->clearWishlist($request->user());

        return back()->with('success', 'Wishlist cleared');
    }
}
