<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in
        if (!session()->has('user')) {
            // If not logged in, redirect to the login page
            return redirect('/login')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
