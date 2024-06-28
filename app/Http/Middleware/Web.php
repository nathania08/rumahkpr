<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Web
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::user()) {
            return redirect()->route('auth.login')->with('error', 'Silahkan login terlebih dahulu');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            Auth::user()->role == "admin" ? redirect()->route('dashboard') : redirect()->route('landing');
        }
        return $next($request);

    }
}
