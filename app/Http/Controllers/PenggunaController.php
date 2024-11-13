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

    public function update(Request $request )
    {
        $id_pengguna = Auth::user()->id_pengguna;
        $pengguna = User::find($id_pengguna);

        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:pengguna,username,' . $id_pengguna. ',id_pengguna',
            'password' => 'nullable|min:6',
            'email' => 'required|email|unique:pengguna,email,' . $pengguna->id_pengguna .',id_pengguna',
        ]);

        $pengguna->update([
            'username' => $request->username,
            'password' => $request->filled('password') ? Hash::make($request->password) : $pengguna->password,
            'nama_pengguna' => $request->nama_admin,
            // 'foto' => $foto,

        ]);

        return redirect()->back()->with('success', 'Data anda berhasil di update');
    
    }
}