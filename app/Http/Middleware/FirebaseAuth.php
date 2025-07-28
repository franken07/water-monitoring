<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirebaseAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('uid')) {
            return $next($request);
        }
        return redirect('/login');
    }
}