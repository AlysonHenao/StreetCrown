<?php

// Author: Samuel Moncada Mejía

namespace App\Contracts;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;

interface WishlistServiceInterface
{
    /**
     * Get all wishlist items for a user.
     */
    public function getWishlist(User $user): Collection;

    /**
     * Add a product to user's wishlist.
     */
    public function addProduct(User $user, Product $product): bool;

    /**
     * Remove a product from user's wishlist.
     */
    public function removeProduct(User $user, Product $product): bool;

    /**
     * Check if a product is in user's wishlist.
     */
    public function isInWishlist(User $user, Product $product): bool;

    /**
     * Get count of items in user's wishlist.
     */
    public function getWishlistCount(User $user): int;

    /**
     * Clear entire wishlist for a user.
     */
    public function clearWishlist(User $user): bool;
}
