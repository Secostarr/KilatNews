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
}
