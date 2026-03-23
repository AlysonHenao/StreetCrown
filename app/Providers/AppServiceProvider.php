<?php
// Author: Alyson Henao

namespace App\Providers;

use App\Contracts\CartServiceInterface;
use App\Services\CartSessionService;
use Illuminate\Support\ServiceProvider;
use App\Contracts\OrderServiceInterface;
use App\Services\OrderService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CartServiceInterface::class, CartSessionService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }

    public function boot(): void {}
}
