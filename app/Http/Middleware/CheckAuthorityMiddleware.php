<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin_AuthorizedIp;

class CheckAuthorityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        // Check if the user's IP address is in the authorized_ips table
        $userIp = $request->ip();
        $ipAuthorized = Admin_AuthorizedIp::where('ip_address', $userIp)->exists();


        // Deny access if the IP is not authorized
        if (!$ipAuthorized) {
            abort(403, 'Access denied: Unauthorized IP address.');
        }

        return $next($request);
    }
}
