<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Ambil data kategori beserta jumlah artikel, views, likes, dan komentar
        $categories = kategori::withCount([
            'artikels', // Menghitung jumlah artikel per kategori
            'artikels as total_views' => function ($query) {
                $query->select(DB::raw('SUM(viewer_count)'));
            },
            'artikels as total_likes' => function ($query) {
                $query->select(DB::raw('SUM(like_count)'));
            },
            'artikels as total_comments' => function ($query) {
                $query->select(DB::raw('SUM(comment_count)'));
            },
        ])->get();

        return view('admin.dashboard', compact('user', 'categories'));
    }

    public function editProfile()
    {
        return view('admin.edit.edit_admin');
    }

    public function edit()
    {
        $admin = Auth::user(); // Ambil data admin yang sedang login

        if (!$admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak ditemukan.');
        }

        return view('edit_admin', compact('admin')); // Pastikan 'edit_admin' adalah nama file view yang benar
    }
}
