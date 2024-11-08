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

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
           
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login Berhasil');
            } elseif ($user->role == 'user') {
                return redirect()->route('home');
            } elseif ($user->role == 'contributor') {
                return redirect()->route('home');
            }
        }
        
        return back()->withErrors(['login_error' => 'Username atau password salah'])->onlyInput('username');
    }
}
