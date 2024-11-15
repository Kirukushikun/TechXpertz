<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TechnicianAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the technician is authenticated
        if (!Auth::guard('technician')->check()) {
            // If not, redirect to the login page
            return redirect()->route('technician.loginTechnician');
        }

        if (Auth::guard('technician')->user()->profile_status == 'deleted'){

            return redirect()->route('technician.accountDisabled', ['status' => 'deleted']);

        } elseif (Auth::guard('technician')->user()->profile_status == 'restricted'){

            return redirect()->route('technician.accountDisabled', ['status' => 'restricted']);

        }

        // If authenticated, allow the request to proceed
        return $next($request);
    }
}
