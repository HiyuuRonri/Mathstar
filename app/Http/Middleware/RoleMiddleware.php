<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles  // Accept multiple roles as arguments
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('login'); // Redirect to login if not authenticated
        }

        // Check if the user has one of the allowed roles
        $user = Auth::user();
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized access'); // Return a 403 error if unauthorized
        }

        return $next($request);
    }
}
