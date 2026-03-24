<?php

// Author: Samuel Moncada Mejía

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->getRole() === User::ROLE_ADMIN) {
            return $next($request);
        }

        return redirect()->route('home.index')
            ->with('error', __('admin.access_denied'));
    }
}
