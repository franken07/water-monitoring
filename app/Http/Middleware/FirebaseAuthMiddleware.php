<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirebaseAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('firebase_logged_in')) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}