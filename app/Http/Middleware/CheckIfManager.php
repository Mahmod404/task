<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Assuming 'role' field exists in users table and 'manager' is the role
        if (auth()->check() && auth()->user()->role === 'manager') {
            return $next($request);
        }

        // Redirect or return a forbidden response if user is not a manager
        return redirect()->route('home')->with('error', 'Unauthorized access');

    }
}