<?php // Author: Samuel Moncada Mejía

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $user = $request->user();

        if ($user === null || $user->getRole() !== 'admin') {
            return redirect()->route('home.index')
                ->with('error', __('auth.unauthorized'));
        }

        return $next($request);
    }
}
