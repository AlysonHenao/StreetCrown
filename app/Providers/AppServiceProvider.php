<?php
// Author: Alyson Henao

namespace App\Providers;

use App\Contracts\CartServiceInterface;
use App\Services\CartSessionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CartServiceInterface::class, CartSessionService::class);
    }

    public function boot(): void {}
}
