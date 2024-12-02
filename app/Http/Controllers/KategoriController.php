<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KategoriController extends Controller
{

    public function kategori()
    {
        $kategoris = kategori::all();

        $artikels = artikel::where('status_publikasi', 'published')->get();

        return view('admin.kategori', compact('kategoris', 'artikels'));
    }

    public function create()
    {
        return view('admin.tambah.tambah_kategori');
    }

    public function edit($id_kategori)
    {
        $kategori = kategori::find($id_kategori);
        return view('admin.edit.edit_kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        // Buat slug dari nama_kategori
        $slug = Str::slug($validated['nama_kategori'], '-');    

        // Simpan data ke database
        kategori::create([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => $slug, // Tambahkan slug ke database
            'deskripsi' => $validated['konten'],
            'urutan' => $validated['urutan'] ?? null,
        ]);

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('admin.artikel.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id_kategori)
    {
        $kategori = kategori::find($id_kategori);
        // Validasi data
        $validated = $request->validate([
            'nama_kategori' => 'nullable|string|max:255',
            'konten' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        // Buat slug dari nama_kategori
        $slug = Str::slug($validated['nama_kategori'], '-');    

        // Simpan data ke database
        $kategori->update([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => $slug, // Tambahkan slug ke database
            'deskripsi' => $validated['konten'],
            'urutan' => $validated['urutan'] ?? null,
        ]);

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('admin.artikel.kategori.edit', $id_kategori)->with('success', 'Kategori berhasil di edit!');
    }   

    public function delete($id_kategori)
    {
        $kategori = kategori::find($id_kategori);

        $foto = $kategori->foto;

        if ($kategori->foto) {
            $foto = $kategori->foto;

            if (Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }
        }

        $kategori->delete();

        return redirect()->route('admin.artikel.kategori')->with('success', 'Data Kategori Berhasil Di Hapus');
    }
}