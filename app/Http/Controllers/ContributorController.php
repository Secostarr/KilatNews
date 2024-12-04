<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\kategori;
use App\Models\tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContributorController extends Controller
{
    public function dashboard()
    {
        $id_contributor = Auth::user()->id_user;

        // Mengambil artikel yang ditambahkan oleh contributor yang login
        $articles = artikel::where('id_user', $id_contributor)
            ->get();

        // Menjumlahkan total likes, comments, dan views
        $totalLikes = $articles->sum('like_count');
        $totalComments = $articles->sum('comment_count');
        $totalViews = $articles->sum('viewer_count');

        // Data pengguna
        $user = User::where('id_user', $id_contributor)->first();

        return view('penyetor.dashboard', compact('user', 'articles', 'totalLikes', 'totalComments', 'totalViews'));
    }

    public function create()
    {
        $tags = tag::all();
        $kategoris = kategori::all();
        return view('penyetor.tambah_artikel', compact('tags', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_publikasi' => 'required|date',
            'media_utama' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'highlight' => 'required|in:true,false',
            'trending' => 'required|in:true,false',
            'id_kategori' => 'required',
            'id_tag' => 'required',
            'lokasi' => 'nullable|string|max:255',
        ]);

        $slug = Str::slug($validated['judul'], '-');
        $originalSlug = $slug;
        $counter = 1;

        while (Artikel::where('slug', $slug)->exists()) {
            $slug = "$originalSlug-$counter";
            $counter++;
        }

        $foto = null;
        if ($request->hasFile('media_utama')) {
            $uniqueFile = uniqid() . '_' . $request->file('media_utama')->getClientOriginalName();
            $request->file('media_utama')->storeAs('media_utama', $uniqueFile, 'public');
            $foto = 'media_utama/' . $uniqueFile;
        }

        Artikel::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'konten' => $request->konten,
            'tanggal_publikasi' => $request->tanggal_publikasi,
            'id_user' => Auth::user()->id_user,
            'media_utama' => $foto,
            'id_kategori' => $request->id_kategori,
            'highlight' => $request->highlight === 'true' ? 1 : 0, // Konversi ke integer
            'trending' => $request->trending === 'true' ? 1 : 0, // Konversi ke integer
            'id_tag' => $request->id_tag,
            'status_publikasi' => 'published',
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('contributor.dashboard')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id_artikel)
    {
        $tags = tag::all();
        $kategoris = kategori::all();
        $artikel = artikel::find($id_artikel);
        return view('penyetor.edit_artikel', compact('artikel', 'kategoris', 'tags'));
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
            'status_publikasi' => 'nullable|in:published,draft,archived',
            'highlight' => 'in:1,0',
            'id_kategori' => 'nullable|exists:kategori_berita,id_kategori',
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
        $id_kategori = $request->input('id_kategori', $artikel->id_kategori);
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
            'status_publikasi' => $status_publikasi,
            'highlight' => $request->highlight == '1',
            'id_kategori' => $id_kategori,
            'id_tag' => $id_tag,
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('contributor.dashboard.edit', $id_artikel)->with('success', 'Artikel berhasil diupdate.');
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

        return redirect()->route('contributor.dashboard')->with('success', 'Data Artikel Berhasil Di Hapus');
    }
}
