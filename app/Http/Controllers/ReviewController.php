<?php

// Author: Samuel Moncada Mejía

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function create(int $productId): View
    {
        $product = Product::findOrFail($productId);

        $viewData = [
            'product' => $product,
            'title' => __('review.create_title'),
        ];

        return view('reviews.create', ['viewData' => $viewData]);
    }

    public function store(StoreReviewRequest $request, int $productId): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->getId();
        $validated['product_id'] = $productId;

        Review::create($validated); 

        return redirect()->route('product.show', $productId)
            ->with('success', __('review.created_successfully'));
    }
}