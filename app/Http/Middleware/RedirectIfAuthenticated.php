<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // If no guards are specified, default to [null]
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Check if the user is authenticated for the specified guard
            if (Auth::guard($guard)->check()) {
                // Redirect to the home page defined in RouteServiceProvider
                return redirect(RouteServiceProvider::HOME);
                return redirect(RouteServiceProvider::COMPANYDASHBOARD);
                return redirect(RouteServiceProvider::JOBDASHBOARD);
            }
        }

        // If the user is not authenticated for any of the specified guards, continue to the next middleware
        return $next($request);
    }
}
