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

    public function register(Request $request)
    {
        // Validasi data registrasi termasuk username
        $request->validate([
            'nama' => 'required|max:50',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:70|unique:users',
            'password' => 'required|min:8',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_user', $uniqueFile, 'public');
            $foto = 'foto_user/' . $uniqueFile;
        }

        // Buat pengguna baru dengan role default "user"
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Role default adalah "user"
            'foto' => $foto,
        ]);

        // Redirect atau response setelah registrasi berhasil
        return redirect()->route('user.login')->with('success', 'Registrasi berhasil! Silakan login kembali.');
    }
}
