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
        return view('admin.artikel_tag', compact('artikels', 'tags'));
    }

    public function kelola()
    {
        $tags = tag::all();
        return view('admin.kelola_tag', compact('tags'));
    }

    public function create()
    {
        return view('admin.tambah.tambah_tag');    
    }   

    public function delete($id_tag)
    {
        $tag = tag::find($id_tag);
        $tag->delete();

        return redirect()->route('admin.artikel.kelola.tag')->with('success', 'Data Artikel Berhasil Di Hapus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tag' => 'required|unique:tag,nama_tag',
        ]); 

        $slug = Str::slug($request->nama_tag);

        tag::create([
            'nama_tag' => $request->nama_tag,
            'slug' => $slug,
        ]);

        return redirect()->route('admin.artikel.kelola.tag')->with('success', 'Tag Berhasil di tambahkan');
    }

    public function storeArtikel(Request $request)
    {
        $request->validate([
            'id_artikel' => 'required',
            'id_tag' => 'required',
        ]);

        ArtikelTag::create([
            'id_artikel' => $request->id_artikel,
            'id_tag' => $request->id_tag,
        ]);

        return redirect()->route('admin.artikel.tag')->with('success', 'tag Berhasil di sesuaikan.');
    }
}
