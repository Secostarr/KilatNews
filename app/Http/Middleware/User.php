<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Arahkan ke halaman lain jika role tidak sesuai
        if (!Auth::user()->role === 'admin') {
            // Arahkan ke halaman lain jika tidak sesuai role
            return redirect()->route('admin.login')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        } elseif (!Auth::user()->role === 'user' || 'contributor') {
            return redirect()->route('user.login')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
