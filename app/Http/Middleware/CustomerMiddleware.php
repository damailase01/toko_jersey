<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user adalah customer
        if (auth()->check() && auth()->user()->role === 'customer') {
            return $next($request);
        }

        // Redirect jika bukan customer
        return redirect('/')->with('error', 'Akses ditolak. Anda bukan customer.');
    }
}
