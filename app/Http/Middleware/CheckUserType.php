<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $allowedUserType)
    {
        // Check if the authenticated user's type matches the allowed user type
        if ($request->user() && $request->user()->type === $allowedUserType) {
            return $next($request);
        }

        // Redirect or return an unauthorized response if the user doesn't have the required user type
        return redirect()->route('dashboard')->with('error', 'Access denied.');
    }
}
