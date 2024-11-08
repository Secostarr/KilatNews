<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
{
    $user = Auth::user();
    
    // Pastikan user sedang login
    if ($user) {
        return view('admin.dashboard', compact('user'));
    } else {
        // Redirect ke halaman login jika user tidak ditemukan
        return redirect()->route('admin.login')->withErrors('Silakan login terlebih dahulu.');
    }
}

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
