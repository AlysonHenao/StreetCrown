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
    public function getWishlist(User $user): Collection
    {
        return $user->wishlist()->with('product')->get()->pluck('product');
    }

    public function addProduct(User $user, Product $product): bool
    {
        if ($this->isInWishlist($user, $product)) {
            return false;
        }

        return Wishlist::create([
            'user_id' => $user->getId(),
            'product_id' => $product->getId(),
        ]) !== null;
    }

    public function removeProduct(User $user, Product $product): bool
    {
        return Wishlist::where('user_id', $user->getId())
            ->where('product_id', $product->getId())
            ->delete() > 0;
    }

    public function isInWishlist(User $user, Product $product): bool
    {
        return Wishlist::where('user_id', $user->getId())
            ->where('product_id', $product->getId())
            ->exists();
    }

    public function getWishlistCount(User $user): int
    {
        return Wishlist::where('user_id', $user->getId())->count();
    }

    public function clearWishlist(User $user): bool
    {
        return Wishlist::where('user_id', $user->getId())->delete() > 0;
    }
}
