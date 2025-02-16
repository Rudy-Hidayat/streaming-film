<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Kategori;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::paginate(30);
        return view('films.index', compact('films'));
    }

    public function show($id)
    {
        $film = Film::with(['kategoris', 'detailFilm'])->findOrFail($id);
        $recommendations = Film::where('id', '!=', $id)->inRandomOrder()->limit(4)->get(); // Ambil 4 film acak sebagai rekomendasi

        return view('films.show', compact('film', 'recommendations'));
    }


    public function byKategori($kategoriId)
    {
        $kategori = Kategori::with('films')->findOrFail($kategoriId);
        return view('films.by_kategori', compact('kategori'));
    }
}

