<?php

namespace App\Http\Controllers;

use App\Http\Middleware\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Logout Berhasil');
    }

    public function edit()
    {
        $admin = Auth::user(); // Ambil data admin yang sedang login
    
        if (!$admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak ditemukan.');
        }
    
        return view('edit_admin', compact('admin')); // Pastikan 'edit_admin' adalah nama file view yang benar
    }
}


