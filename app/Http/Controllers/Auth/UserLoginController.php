<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function login()
    {
        return view('auth.admin_login');
    }

    public function loginUser()
    {
        return view('auth.user_login');
    }

    public function register()
    {
        return view('auth.user_register');
    }

    public function profile()
    {
        return view('profile');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah halaman login sesuai dengan role pengguna
            if ($request->route()->named('user.auth') && $user->role !== 'user' || 'contributor') {
                Auth::logout();
                return redirect()->route('user.login')->withErrors(['login_error' => 'Halaman tidak sesuai untuk role anda.']);
            } elseif ($request->route()->named('admin.auth') && $user->role !== 'admin') {
                Auth::logout();
                return redirect()->route('admin.login')->withErrors(['login_error' => 'Halaman tidak sesuai untuk role anda.']);
            } 

            // Arahkan ke halaman sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login Berhasil');
            } elseif ($user->role === 'user') {
                return redirect()->route('home');
            } elseif ($user->role === 'contributor') {
                return redirect()->route('home');
            }
        }

        return back()->withErrors(['login_error' => 'Username atau password salah'])->onlyInput('username');
    }
}
