<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function artikel() 
    {
        return view('admin.artikel');
    }

    public function create()
    {
        return view('admin.tambah.tambah_artikel');
    }

}
