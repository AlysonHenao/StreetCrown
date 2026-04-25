<?php

// Author: Emmanuel Cortes

namespace App\Interfaces;

use App\Models\Order;
use App\Models\User;

interface OrderServiceInterface
{
    public function createFromCart(User $user, string $paymentMethod): Order;
}