<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function kategori()
    {
        $kategoris = kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.tambah.tambah_kategori');    
    }

    public function store(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'nama_kategori' => 'required|string|max:255',
        'konten' => 'nullable|string',
        'urutan' => 'nullable|integer',
    ]);

    // Simpan data ke database
    kategori::create([
        'nama_kategori' => $validated['nama_kategori'],
        'deskripsi' => $validated['konten'],
        'urutan' => $validated['urutan'] ?? null,
    ]);

    // Redirect ke halaman kategori dengan pesan sukses
    return redirect()->route('admin.artikel.kategori.create')->with('success', 'Kategori berhasil ditambahkan!');
}

}
