<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RoleMiddleware
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        // Multiple roles can be passed as a pipe-separated string
        $rolesArray = explode('|', $roles);

        if (!Auth::check() || !in_array(Auth::user()->getRole(), $rolesArray, true)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
