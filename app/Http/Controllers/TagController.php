<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function tag()
    {
        return view('admin.tag');
    }

    public function create()
    {
        return view('admin.tambah.tambah_tag');    
    }
}
