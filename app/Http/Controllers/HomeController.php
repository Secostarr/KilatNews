<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        return view('home');    
    }

    public function contact()
    {
        return view('contact');    
    }

    public function categori()
    {
        return view('categori');    
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
