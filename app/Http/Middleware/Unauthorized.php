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
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return $next($request);
        }

         $url = $role.'.dashboard';
        // Arahkan ke halaman lain jika tidak sesuai role
         return redirect()->route($url)
             ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
