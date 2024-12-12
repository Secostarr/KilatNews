<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel; // Pastikan model Artikel ada
use App\Models\kategori;
use App\Models\komentar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        $namaDaerah = null;
        $trendingLatestAll = Artikel::where('trending', 1)->where('status_publikasi', 'published')->latest()->get();
        $highlightLatestAll = Artikel::where('highlight', 1)->where('status_publikasi', 'published')->latest()->get();
        $trendingLatest = Artikel::where('trending', 1)->where('status_publikasi', 'published')->latest()->first();
        $highlightLatest = Artikel::where('highlight', 1)->where('status_publikasi', 'published')->latest()->first();
        $artikelsTrending = Artikel::where('trending', 1)->where('status_publikasi', 'published')->latest()->take(3)->get();
        $artikelsHighlight = Artikel::where('highlight', 1)->where('status_publikasi', 'published')->latest()->take(4)->get();

        return view('home', compact('trendingLatestAll', 'highlightLatestAll', 'trendingLatest', 'highlightLatest', 'artikelsTrending', 'artikelsHighlight', 'namaDaerah'));
    }

    public function latest_news()
    {
        // Ambil berita yang dibuat dalam 5 hari terakhir
        $latest_news = Artikel::where('created_at', '>=', now()->subDays(5))
            ->where('status_publikasi', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('latest_news', compact('latest_news'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function categori($slug = null)
    {
        $artikels = Artikel::where('status_publikasi', 'published')->get();
        $artikelstwo = Artikel::where('status_publikasi', 'published')->get();
        $categoris = kategori::all();
        if ($slug) {
            // Cari kategori berdasarkan slug
            $kategori = Kategori::where('slug', $slug)->firstOrFail();

            // Ambil artikel berdasarkan kategori
            $artikels = Artikel::with('kategori')
                ->where('id_kategori', $kategori->id_kategori)
                ->latest()
                ->get();
        } else {
            // Jika slug tidak ada, tampilkan semua artikel
            $artikels = Artikel::with('kategori')->latest()->get();
        }

        return view('categori', compact('categoris', 'artikelstwo', 'artikels'));
    }

    public function about()
    {
        return view('about');
    }

    public function showBerita($slug)
    {
        // Cari artikel berdasarkan slug
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

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


        // Ambil artikel terkait berdasarkan kategori
        $relatedArtikelsten = Artikel::where('id_kategori', $artikel->id_kategori)
            ->where('id_artikel', '!=', $artikel->id_artikel) // Tidak termasuk artikel yang sedang dibuka
            ->take(5) // Batas maksimal artikel terkait
            ->get();

        return view('detail', compact('artikel', 'relatedArtikels', 'relatedArtikelsten'));
    }

    public function getLokasi()
    {
        try {
            $lokasi = DB::table('pengaturan_situs')->value('lokasi'); // Ambil nama lokasi dari database
            if (!$lokasi) {
                return response()->json(['lokasi' => null, 'error' => 'Lokasi tidak ditemukan'], 404);
            }

            return response()->json(['lokasi' => $lokasi]); // Kirim nama lokasi
        } catch (\Exception $e) {
            return response()->json(['lokasi' => null, 'error' => 'Gagal mengambil lokasi dari database'], 500);
        }
    }

    
}
