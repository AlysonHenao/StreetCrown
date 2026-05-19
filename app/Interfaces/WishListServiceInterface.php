<?php

// Author: Samuel Moncada Mejía

namespace App\Interfaces;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;

interface WishlistServiceInterface
{
    public function getWishlist(User $user): Collection;

    public function addProduct(User $user, Product $product): bool;

    public function removeProduct(User $user, Product $product): bool;

    public function isInWishlist(User $user, Product $product): bool;

    public function getWishlistCount(User $user): int;

    public function clearWishlist(User $user): bool;
}