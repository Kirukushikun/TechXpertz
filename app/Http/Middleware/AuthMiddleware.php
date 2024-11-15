<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated with the default guard
        if (!Auth::check()) {
            // If not, redirect to the customer login page
            return redirect()->route('customer.loginCustomer');
        }

        $user = Auth::user();

        // Check if the profile status is 'deleted' or 'restricted'
        if ($user->profile_status == 'deleted') {
            return redirect()->route('customer.accountDisabled', ['status' => 'deleted']);
        } elseif ($user->profile_status == 'restricted') {
            return redirect()->route('customer.accountDisabled', ['status' => 'restricted']);
        }

        // If authenticated and profile is active, allow the request to proceed
        return $next($request);
    }
}