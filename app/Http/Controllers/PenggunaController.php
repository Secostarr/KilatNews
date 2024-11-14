<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function pengguna()
    {
        return view('admin.pengguna');     
    }

    public function create()
    {
        return view('admin.tambah.tambah_pengguna');  
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logout Berhasil');
    }

    public function edit()
    {
        $id = Auth::user()->id_user;
        $pengguna = User::find($id);

        if (!$pengguna) {
            return back()->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('edit_pengguna', compact('pengguna'));
    }

    



}