<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa jika pengguna sudah login dan memiliki role 'customer'
        if (Auth::check() && Auth::user()->role == 'customer') {
            return $next($request);  // Jika benar, lanjutkan request
        }

        // Jika pengguna tidak memiliki role customer, alihkan ke halaman login atau home
        return redirect()->route('login');  // Ganti dengan route yang sesuai
    }
}
