<?php

namespace App\Http\Controllers;

use App\Models\pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function notifikasi()
    {
        return view('admin.notifikasi.notifikasi');
    }

    public function pendaftar()
    {
        $pendaftaran = pendaftaran::where('status', 'pending')->get();
        return view('admin.notifikasi.pendaftar', compact('pendaftaran'));
    }

    public function approve(Request $request, $id)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        // Cari user berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Ubah role user menjadi 'contributor'
        $user->role = 'contributor';
        $user->save();

        // Cari data pendaftaran berdasarkan user_id
        $pendaftaran = Pendaftaran::where('id_user', $id)->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Pendaftaran tidak ditemukan.');
        }

        // Ubah status pendaftaran menjadi 'approved'
        $pendaftaran->status = 'approved';
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Pengguna berhasil disetujui sebagai kontributor.');
    }



    public function penyetor()
    {
        return view('admin.notifikasi.penyetor');
    }
}
