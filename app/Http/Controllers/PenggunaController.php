<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    // Tampilkan daftar pengguna (jika diperlukan)
    public function pengguna()
    {
        return view('admin.pengguna');     
    }

    // Halaman Tambah Pengguna
    public function create()
    {
        return view('admin.tambah.tambah_pengguna');  
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logout Berhasil');
    }

    // Halaman Edit Profil
    public function edit()
    {
        $id = Auth::user()->id; // Gunakan default 'id' jika primary key di model User adalah 'id'
        $pengguna = User::find($id);

        if (!$pengguna) {
            return redirect()->route('home')->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('edit_pengguna', compact('pengguna'));
    }

    // Update Profil
    public function update(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $pengguna->id,
            'email' => 'required|email|unique:users,email,' . $pengguna->id,
            'bio' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle Foto Profil
        $foto = $pengguna->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }

            // Simpan foto baru
            $foto = $request->file('foto')->store('foto_pengguna', 'public');
        }

        // Update data pengguna
        $pengguna->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'bio' => $request->bio,
            'foto' => $foto,
        ]);

        return redirect()->route('pengguna.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
