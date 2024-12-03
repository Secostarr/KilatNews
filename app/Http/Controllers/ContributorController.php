<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContributorController extends Controller
{
    public function dashboard()
    {
        $id_contributor = Auth::user()->id_user;

        // Mengambil semua artikel yang ditambahkan oleh contributor
        $articles = artikel::where('id_user', $id_contributor)
            ->with(['likes', 'comments', 'views']) // Memuat relasi
            ->get();

        // Menjumlahkan total likes, comments, dan views
        $totalLikes = $articles->sum(fn($article) => $article->likes->count());
        $totalComments = $articles->sum(fn($article) => $article->comments->count());
        $totalViews = $articles->sum(fn($article) => $article->views->count());

        // Data pengguna
        $user = User::where('id_user', $id_contributor)->first();

        return view('penyetor.dashboard', compact('user', 'totalLikes', 'totalComments', 'totalViews'));
    }
}
