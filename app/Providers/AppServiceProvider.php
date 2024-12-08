<?php

namespace App\Providers;

use App\Models\pengaturan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $pengaturan = Pengaturan::first(); // Mendapatkan record pertama
        View::share('pengaturan', $pengaturan);
    }
}
