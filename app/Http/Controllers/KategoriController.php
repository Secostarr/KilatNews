<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function kategori()
    {
        return view('admin.kategori');
    }

    public function create()
    {
        return view('admin.tambah.tambah_kategori');    
    }
}
