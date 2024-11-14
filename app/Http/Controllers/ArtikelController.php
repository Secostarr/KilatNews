<?php

namespace App\Http\Controllers;

use App\Models\artikel;
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
        return view('admin.tambah.tambah_artikel');
    }

    

}
