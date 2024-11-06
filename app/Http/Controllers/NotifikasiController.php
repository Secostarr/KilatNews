<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function notifikasi()
    {
        return view('admin.notifikasi.notifikasi'); 
    }

    public function pendaftar()
    {
        return view('admin.notifikasi.pendaftar'); 
    }

    public function penyetor()
    {
        return view('admin.notifikasi.penyetor'); 
    }
}
