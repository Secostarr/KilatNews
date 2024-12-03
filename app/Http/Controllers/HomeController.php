<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\artikel;
use App\Models\kategori;
use App\Models\komentar;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        // Artikel terbaru yang trending
        $trendingLatestAll = Artikel::where('trending', 1)
            ->latest()
            ->get();

        // Artikel terbaru yang highlight
        $highlightLatestAll = Artikel::where('highlight', 1)
            ->latest()
            ->get();

        // Artikel terbaru yang trending
        $trendingLatest = Artikel::where('trending', 1)->where('status_publikasi', 'published')
            ->latest()
            ->first();

        // Artikel terbaru yang highlight
        $highlightLatest = Artikel::where('highlight', 1)
            ->latest()
            ->first();

        // Tiga artikel tambahan yang trending
        $artikelsTrending = Artikel::where('trending', 1)->where('status_publikasi', 'published')
            ->latest()
            ->take(3)
            ->get();

        // Empat artikel tambahan yang highlight
        $artikelsHighlight = Artikel::where('highlight', 1)->where('status_publikasi', 'published')
            ->latest()
            ->take(4)
            ->get();


        return view('home', compact('trendingLatestAll', 'highlightLatestAll', 'trendingLatest', 'highlightLatest', 'artikelsTrending', 'artikelsHighlight'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function categori()
    {
        $artikels = artikel::where('status_publikasi', 'published')->get();
        $artikelstwo = artikel::where('status_publikasi', 'published')->get();
        $categoris = kategori::all();
        return view('categori', compact('artikels', 'artikelstwo', 'categoris'));
    }

    public function about()
    {
        return view('about');
    }

    public function latest_news()
    {
        return view('latest_news');
    }

    public function showBerita($slug)
    {
        // Cari artikel berdasarkan slug
        $artikel = Artikel::where('slug', $slug)
        ->with('komentars.user')
        ->firstOrFail();

        // Meningkatkan jumlah views setiap kali artikel dibuka
        $artikel->increment('viewer_count'); // Ini akan menambah 1 pada view_count

        // Artikel terkait
        $relatedArtikels = Artikel::where('id_artikel', '!=', $artikel->id_artikel)
            ->where('id_kategori', $artikel->id_kategori)
            ->take(5)
            ->get();

        $komentars = komentar::where('id_artikel', $slug)->get();

        return view('detail', compact('artikel', 'relatedArtikels', 'komentars'));
    }

    public function likeArtikel(Request $request, $slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        $artikel->increment('like_count');
    
        return back();
    }
}