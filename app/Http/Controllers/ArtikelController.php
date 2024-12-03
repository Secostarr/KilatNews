<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\kategori;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ArtikelController extends Controller
{
    public function artikel()
    {
        $published = Artikel::where('status_publikasi', 'Published')->get();
        $archived = Artikel::where('status_publikasi', 'Archived')->get();
        $draft = Artikel::where('status_publikasi', 'Draft')->get();
        $artikels = artikel::all();
        return view('admin.artikel', compact('artikels', 'published', 'archived', 'draft'));
    }

    public function create()
    {
        $tags = tag::all();
        $kategoris = kategori::all();
        return view('admin.tambah.tambah_artikel', compact('kategoris', 'tags'));
    }

    public function edit($id_artikel)
    {
        $tags = tag::all();
        $kategoris = kategori::all();
        $artikel = artikel::find($id_artikel);
        return view('admin.edit.edit_artikel', compact('artikel', 'kategoris', 'tags'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_publikasi' => 'required|date',
            'media_utama' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'trending' => 'required|in:true,false',
            'status_publikasi' => 'required|in:published,draft,archived',
            'highlight' => 'required|in:true,false',
            'id_kategori' => 'required',
            'id_tag' => 'required',
            'lokasi' => 'nullable|string|max:255',
        ]);


        // Generate slug dari judul
        $slug = Str::slug($validated['judul'], '-');

        // Cek apakah slug sudah ada di database
        $originalSlug = $slug;
        $counter = 1;
        while (Artikel::where('slug', $slug)->exists()) {
            $slug = "$originalSlug-$counter";
            $counter++;
        }
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
            'id_tag' => $request->id_tag,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('admin.artikel.berita')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function update(Request $request, $id_artikel)
    {
        $artikel = Artikel::find($id_artikel);

        // Validasi input
        $validated = $request->validate([
            'judul' => 'string|max:255',
            'konten' => 'string',
            'tanggal_publikasi' => 'date',
            'media_utama' => 'file|mimes:jpg,jpeg,png|max:2048',
            'trending' => 'in:true,false',
            'status_publikasi' => 'nullable|in:published,draft,archived', // Nullable jika kosong
            'highlight' => 'in:true,false',
            'id_kategori' => 'nullable',
            'id_tag' => 'nullable',
            'lokasi' => 'nullable|string|max:255',
        ]);

        // Generate slug dari judul
        $slug = Str::slug($validated['judul'], '-');
        $originalSlug = $slug;
        $counter = 1;
        while (Artikel::where('slug', $slug)->exists()) {
            $slug = "$originalSlug-$counter";
            $counter++;
        }

        // Proses upload media utama
        $media_utama = $artikel->media_utama;
        if ($request->hasFile('media_utama')) {
            if ($media_utama) {
                Storage::disk('public')->delete($media_utama);
            }
            $uniqueFile = uniqid() . '_' . $request->file('media_utama')->getClientOriginalName();
            $request->file('media_utama')->storeAs('media_utama', $uniqueFile, 'public');
            $media_utama = 'media_utama/' . $uniqueFile;
        }

        // Gunakan nilai sebelumnya jika tidak diubah
        $id_kategori = $request->id_kategori ?? $artikel->id_kategori;
        $id_tag = $request->id_tag ?? $artikel->id_tag;
        $status_publikasi = $request->status_publikasi ?? $artikel->status_publikasi;

        // Simpan data artikel
        $artikel->update([
            'judul' => $request->judul,
            'slug' => $slug,
            'konten' => $request->konten,
            'tanggal_publikasi' => $request->tanggal_publikasi,
            'id_user' => Auth::user()->id_user,
            'media_utama' => $media_utama,
            'trending' => $request->trending === 'true',
            'status_publikasi' => $status_publikasi, // Gunakan nilai sebelumnya jika kosong
            'highlight' => $request->highlight === 'true',
            'id_kategori' => $id_kategori,
            'id_tag' => $id_tag,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('admin.artikel.berita.edit', $id_artikel)->with('success', 'Artikel berhasil diupdate.');
    }



    public function delete($id_artikel)
    {
        $artikel = artikel::find($id_artikel);

        $foto = $artikel->foto;

        if ($artikel->foto) {
            $foto = $artikel->foto;

            if (Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.berita')->with('success', 'Data Artikel Berhasil Di Hapus');
    }

    public function detail($id_artikel)
    {
        $artikel = artikel::find($id_artikel);
        return view('admin.detail_artikel', compact('artikel'));
    }

}
