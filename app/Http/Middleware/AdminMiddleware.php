<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika user tidak memiliki role admin, tampilkan pesan error atau redirect
        abort(403, 'Unauthorized'); // Bisa juga pakai redirect: return redirect('/home');
    }
}

