<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the technician is authenticated
        if (!Auth::guard('admin')->check()) {
            // If not, redirect to the login page
            return redirect()->route('admin.loginAdmin');
        }

        // If authenticated, allow the request to proceed
        return $next($request);
    }
}
