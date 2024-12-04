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
        $namaDaerah = null; // Tidak ada daerah yang dipilih
        $trendingLatestAll = Artikel::where('trending', 1)->where('status_publikasi', 'published')->latest()->get();
        $highlightLatestAll = Artikel::where('highlight', 1)->where('status_publikasi', 'published')->latest()->get();
        $trendingLatest = Artikel::where('trending', 1)->where('status_publikasi', 'published')->latest()->first();
        $highlightLatest = Artikel::where('highlight', 1)->where('status_publikasi', 'published')->latest()->first();
        $artikelsTrending = Artikel::where('trending', 1)->where('status_publikasi', 'published')->latest()->take(3)->get();
        $artikelsHighlight = Artikel::where('highlight', 1)->where('status_publikasi', 'published')->latest()->take(4)->get();

        return view('home', compact('trendingLatestAll', 'highlightLatestAll', 'trendingLatest', 'highlightLatest', 'artikelsTrending', 'artikelsHighlight', 'namaDaerah'));
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

        // Periksa session untuk menghindari penambahan view count terus-menerus
        $viewedKey = 'viewed_artikel_' . $artikel->id_artikel;

        if (!session()->has($viewedKey)) {
            // Meningkatkan jumlah views hanya jika belum pernah dilihat pada sesi ini
            $artikel->increment('viewer_count');
            // Tandai artikel ini sebagai sudah dilihat dalam sesi
            session()->put($viewedKey, true);
        }

        // Artikel terkait
        $relatedArtikels = Artikel::where('id_artikel', '!=', $artikel->id_artikel)
            ->where('id_kategori', $artikel->id_kategori)
            ->take(5)
            ->get();

        // Komentar
        $komentars = Komentar::where('id_artikel', $artikel->id_artikel)->get();

        // Ambil artikel terkait berdasarkan kategori
        $relatedArtikelsten = Artikel::where('id_kategori', $artikel->id_kategori)
            ->where('id_artikel', '!=', $artikel->id_artikel) // Tidak termasuk artikel yang sedang dibuka
            ->take(5) // Batas maksimal artikel terkait
            ->get();

        return view('detail', compact('artikel', 'relatedArtikels', 'komentars', 'relatedArtikelsten'));
    }
}
