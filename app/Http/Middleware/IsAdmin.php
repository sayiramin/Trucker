<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and an admin
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        // Redirect if the user is not an admin
        return redirect()->route('admin.login')->withErrors(['Unauthorized access.']);
    }
}
