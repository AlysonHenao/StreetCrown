<?php

// Author: Samuel Moncada Mejía

namespace App\Services;

use App\Contracts\WishlistServiceInterface;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Collection;

class WishlistService implements WishlistServiceInterface
{
    /**
     * Get all wishlist items for a user.
     */
    public function getWishlist(User $user): Collection
    {
        return $user->wishlist()->with('product')->get()->pluck('product');
    }

    /**
     * Add a product to user's wishlist.
     */
    public function addProduct(User $user, Product $product): bool
    {
        if ($this->isInWishlist($user, $product)) {
            return false;
        }

        return Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]) !== null;
    }

    /**
     * Remove a product from user's wishlist.
     */
    public function removeProduct(User $user, Product $product): bool
    {
        return Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->delete() > 0;
    }

    /**
     * Check if a product is in user's wishlist.
     */
    public function isInWishlist(User $user, Product $product): bool
    {
        return Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->exists();
    }

    /**
     * Get count of items in user's wishlist.
     */
    public function getWishlistCount(User $user): int
    {
        return Wishlist::where('user_id', $user->id)->count();
    }

    /**
     * Clear entire wishlist for a user.
     */
    public function clearWishlist(User $user): bool
    {
        return Wishlist::where('user_id', $user->id)->delete() > 0;
    }
}
