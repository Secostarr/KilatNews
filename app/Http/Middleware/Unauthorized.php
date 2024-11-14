<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Unauthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        if (Auth::user()->role === 'admin') {
            // Arahkan ke halaman lain jika tidak sesuai role
            return redirect()->route('admin.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        } elseif (Auth::user()->role === 'user' || 'contributor') {
            return redirect()->route('home')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
