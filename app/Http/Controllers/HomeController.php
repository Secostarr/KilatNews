<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\artikel;
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

        return view('categori', compact('artikels', 'artikelstwo'));
    }

    public function about()
    {
        return view('about');
    }

    public function latest_news()
    {
        return view('latest_news');
    }
}
