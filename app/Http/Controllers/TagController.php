<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\ArtikelTag;
use App\Models\tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    public function tag()
    {
        $tags = tag::all();
        $artikels = artikel::all();
        return view('admin.kelola_tag', compact('artikels', 'tags'));
    }

    public function create()
    {
        return view('admin.tambah.tambah_tag');
    }

    public function edit($id_tag)
    {
        $tag = tag::find($id_tag);
        return view('admin.edit.edit_tag', compact('tag'));
    }

    public function delete($id_tag)
    {
        $tag = tag::find($id_tag);
        $tag->delete();

        return redirect()->route('admin.artikel.kelola.tag')->with('success', 'Data Artikel Berhasil Di Hapus');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tag' => 'required|unique:tag,nama_tag',
        ]);

        $slug = Str::slug($validated['nama_tag'], '-');

        // Cek apakah slug sudah ada di database
        $originalSlug = $slug;
        $counter = 1;
        while (Artikel::where('slug', $slug)->exists()) {
            $slug = "$originalSlug-$counter";
            $counter++;
        }

        tag::create([
            'nama_tag' => $request->nama_tag,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.artikel.tag')->with('success', 'Tag Berhasil di tambahkan');
    }

    public function update(Request $request, $id_tag)
    {
        $tag = tag::find($id_tag);

        $validated = $request->validate([
            'nama_tag' => 'required|unique:tag,nama_tag',
        ]);

        $slug = Str::slug($validated['nama_tag'], '-');

        // Cek apakah slug sudah ada di database
        $originalSlug = $slug;
        $counter = 1;
        while (Artikel::where('slug', $slug)->exists()) {
            $slug = "$originalSlug-$counter";
            $counter++;
        }

        $tag->update([
            'nama_tag' => $request->nama_tag,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.artikel.tag.edit', $id_tag)->with('success', 'Tag Berhasil di edit');
    }
}
