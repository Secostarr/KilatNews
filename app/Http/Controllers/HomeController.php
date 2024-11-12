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

<<<<<<< HEAD
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logout Berhasil');
=======
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
>>>>>>> bb56ff64292226b5a5c5cf4ffc5017f07390e834
    }
}
