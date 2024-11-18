<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_publikasi' => 'required|date',
            'media_utama' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'trending' => 'required|in:true,false',
            'status_publikasi' => 'required|in:published,draft,archived',
            'highlight' => 'required|in:true,false',
            'id_kategori' => 'required',
            'lokasi' => 'nullable|string|max:255',
        ]);

        // Generate slug dari judul
        $slug = Str::slug($request->judul);

        // Simpan file media utama
        if ($request->hasFile('media_utama')) {
            $uniqueFile = uniqid() . '_' . $request->file('media_utama')->getClientOriginalName();
            $request->file('media_utama')->storeAs('media_utama', $uniqueFile, 'public');
            $foto = 'media_utama/' . $uniqueFile;
        }

        // Simpan data artikel
        Artikel::create([
            'judul' => $request->judul,
            'slug' => $slug, // Tambahkan slug
            'konten' => $request->konten,
            'tanggal_publikasi' => $request->tanggal_publikasi,
            'id_user' => Auth::user()->id_user,
            'media_utama' => $foto,
            'trending' => $request->trending === 'true',
            'status_publikasi' => $request->status_publikasi,
            'highlight' => $request->highlight === 'true',
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('admin.artikel.berita')->with('success', 'Artikel berhasil ditambahkan.');
    }
}
