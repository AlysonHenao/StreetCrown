<?php

// Author: Emmanuel Cortes

namespace App\Providers;

use App\Contracts\CartServiceInterface;
use App\Contracts\OrderServiceInterface;
use App\Contracts\WishlistServiceInterface;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\WishlistService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(WishlistServiceInterface::class, WishlistService::class);
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
