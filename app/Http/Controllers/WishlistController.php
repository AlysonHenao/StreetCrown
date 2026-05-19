<?php

// Author: Samuel Moncada Mejía

namespace App\Http\Controllers;

use App\Interfaces\WishlistServiceInterface;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function __construct(private readonly WishlistServiceInterface $wishlistService) {}

    public function index(Request $request): View
    {
        $wishlistItems = $this->wishlistService->getWishlist($request->user());
        $wishlistCount = $this->wishlistService->getWishlistCount($request->user());

        $viewData = [
            'title' => __('wishlist.index_title'),
            'wishlistItems' => $wishlistItems,
            'wishlistCount' => $wishlistCount,
        ];

        return view('wishlist.index', ['viewData' => $viewData]);
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $added = $this->wishlistService->addProduct($request->user(), $product);

        if ($added) {
            return back()->with('success', __('wishlist.added_successfully'));
        }

        return back()->with('info', __('wishlist.already_added'));
    }

    public function remove(Request $request, Product $product): RedirectResponse
    {
        $this->wishlistService->removeProduct($request->user(), $product);

        return back()->with('success', __('wishlist.removed_successfully'));
    }

    public function clear(Request $request): RedirectResponse
    {
        $this->wishlistService->clearWishlist($request->user());

        return back()->with('success', __('wishlist.cleared_successfully'));
    }
}