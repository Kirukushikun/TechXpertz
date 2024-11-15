<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin_AuthorizedIp;

use Illuminate\Support\Facades\Request as RequestFacade;

class AdminAuthMiddleware
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

        // Check if the admin is authenticated
        if (!Auth::guard('admin')->check()) {
            // If not, redirect to the login page
            return redirect()->route('admin.loginAdmin');
        }

        // If authenticated, allow the request to proceed
        return $next($request);
    }
}
