<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\kategori;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function artikel() 
    {
        $artikels = artikel::all();
        return view('admin.artikel', compact('artikels'));
    }

    public function create()
    {
        $kategoris = kategori::all();
        return view('admin.tambah.tambah_artikel', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_publikasi' => 'required|date',
            'media_utama' => 'nullable|file|mimes:jpg,png,jpeg,gif|max:2048',
            'trending' => 'required|in:true,false',
            'published' => 'nullable|in:published',
            'draft' => 'nullable|in:draft',
            'archived' => 'nullable|in:archived',
            'highlight' => 'nullable|in:true,false',
            'id_kategori' => 'required|exists:kategoris,id',
            'lokasi' => 'nullable|string|max:255',
        ]);

        // Simpan file media utama
        if ($request->hasFile('media_utama')) {
            $path = $request->file('media_utama')->store('media_utama', 'public');
            $validatedData['media_utama'] = $path;
        }

        // Tentukan status publikasi
        $validatedData['status_publikasi'] = $request->published ?? $request->draft ?? $request->archived;

        // Buat artikel baru
        Artikel::create([
            'judul' => $validatedData['judul'],
            'konten' => $validatedData['konten'],
            'tanggal_publikasi' => $validatedData['tanggal_publikasi'],
            'media_utama' => $validatedData['media_utama'] ?? null,
            'trending' => $validatedData['trending'] === 'true',
            'highlight' => $validatedData['highlight'] === 'true',
            'id_kategori' => $validatedData['id_kategori'],
            'lokasi' => $validatedData['lokasi'],
            'status_publikasi' => $validatedData['status_publikasi'],
        ]);

        return redirect()->back()->with('success', 'Artikel berhasil disimpan!');
    }

}
