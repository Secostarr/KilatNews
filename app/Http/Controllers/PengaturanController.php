<?php

namespace App\Http\Controllers;

use App\Models\pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function pengaturan()
    {
        $pengaturan = pengaturan::first();
        return view('admin.pengaturan', compact('pengaturan'));
    }

    public function save(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_situs' => 'nullable|string|max:255',
            'kontak_email' => 'nullable|email|max:255',
            'kontak_nomor' => 'nullable|string|max:15',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lokasi' => 'nullable|string|max:500',
            'deskripsi_singkat' => 'nullable|string|max:1000',
        ]);

        // Proses file logo jika ada
        $logoPath = null;
        // Ambil data pengaturan yang ada atau buat baru jika belum ada
        $pengaturan = Pengaturan::firstOrCreate(['id_pengaturan' => 1]);

        // Update hanya data yang dikirimkan
        if ($request->has('nama_situs')) {
            $pengaturan->nama_situs = $request->input('nama_situs');
        }
        if ($request->has('kontak_email')) {
            $pengaturan->kontak_email = $request->input('kontak_email');
        }
        if ($request->has('kontak_nomor')) {
            $pengaturan->kontak_nomor = $request->input('kontak_nomor');
        }
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($pengaturan->logo) {
                Storage::disk('public')->delete($pengaturan->logo);
            }
            // Simpan logo baru
            $logoPath = $request->file('logo')->store('logos', 'public');
            $pengaturan->logo = $logoPath;
        }
        if ($request->has('lokasi')) {
            $pengaturan->lokasi = $request->input('lokasi');
        }
        if ($request->has('deskripsi_singkat')) {
            $pengaturan->deskripsi_singkat = $request->input('deskripsi_singkat');
        }

        // Simpan perubahan
        $pengaturan->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
