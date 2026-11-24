<?php

namespace App\Providers;

use App\Models\Kategori;
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
        // Daftar kategori untuk navbar, footer & chip filter
        View::composer(['layouts.main', 'films.index'], function ($view) {
            $view->with('navKategoris', Kategori::orderBy('nama_kategori')->get());
        });
    }
}
