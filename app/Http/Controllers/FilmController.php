<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Kategori;

class FilmController extends Controller
{
    private const SORTS = [
        'rating' => 'Rating tertinggi',
        'terbaru' => 'Rilis terbaru',
        'judul' => 'Judul (A–Z)',
    ];

    public function home()
    {
        $hero = Film::with('kategoris')->orderByDesc('rating')->first();
        $topRated = Film::orderByDesc('rating')->take(12)->get();
        $latest = Film::orderByDesc('tahun_rilis')->take(12)->get();
        $kategoris = Kategori::has('films')
            ->with(['films' => fn ($query) => $query->orderByDesc('rating')])
            ->orderBy('nama_kategori')
            ->get();

        return view('films.home', compact('hero', 'topRated', 'latest', 'kategoris'));
    }

    public function index(Request $request)
    {
        return $this->listing($request);
    }

    public function byKategori(Request $request, Kategori $kategori)
    {
        return $this->listing($request, $kategori);
    }

    public function show($id)
    {
        $film = Film::with(['kategoris', 'detailFilm'])->findOrFail($id);

        // Utamakan film dengan kategori yang sama, sisanya diisi film acak
        $recommendations = Film::where('id', '!=', $film->id)
            ->whereHas('kategoris', fn ($query) => $query->whereIn('kategoris.id', $film->kategoris->pluck('id')))
            ->inRandomOrder()
            ->limit(12)
            ->get();

        if ($recommendations->count() < 12) {
            $recommendations = $recommendations->concat(
                Film::whereNotIn('id', $recommendations->pluck('id')->push($film->id))
                    ->inRandomOrder()
                    ->limit(12 - $recommendations->count())
                    ->get()
            );
        }

        return view('films.show', compact('film', 'recommendations'));
    }

    public function poster(Film $film)
    {
        $film->load('kategoris');

        // Pecah judul menjadi baris maksimal ±14 karakter
        $lines = [];
        foreach (preg_split('/\s+/', $film->judul) as $word) {
            $last = array_key_last($lines);
            if ($last !== null && mb_strlen($lines[$last] . ' ' . $word) <= 14) {
                $lines[$last] .= ' ' . $word;
            } else {
                $lines[] = $word;
            }
        }

        $longest = max(array_map('mb_strlen', $lines));
        $fontSize = (int) max(30, min(64, 330 / max($longest, 1) * 1.6));

        return response()
            ->view('films.poster', [
                'film' => $film,
                'lines' => $lines,
                'fontSize' => $fontSize,
                'hue' => ($film->id * 47) % 360,
            ])
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'public, max-age=86400');
    }

    private function listing(Request $request, ?Kategori $activeKategori = null)
    {
        $q = trim((string) $request->query('q'));
        $sort = array_key_exists($request->query('sort'), self::SORTS) ? $request->query('sort') : 'rating';

        $films = Film::query()
            ->when($q !== '', fn ($query) => $query->where('judul', 'like', "%{$q}%"))
            ->when($activeKategori, fn ($query) => $query->whereHas('kategoris', fn ($k) => $k->whereKey($activeKategori->id)))
            ->when($sort === 'rating', fn ($query) => $query->orderByDesc('rating'))
            ->when($sort === 'terbaru', fn ($query) => $query->orderByDesc('tahun_rilis'))
            ->when($sort === 'judul', fn ($query) => $query->orderBy('judul'))
            ->orderBy('id')
            ->paginate(24)
            ->withQueryString();

        // Permintaan dari tombol "Muat lebih banyak"
        if ($request->ajax()) {
            return response()->json([
                'html' => view('films._grid', compact('films'))->render(),
                'next' => $films->nextPageUrl(),
            ]);
        }

        $sorts = self::SORTS;

        return view('films.index', compact('films', 'q', 'sort', 'sorts', 'activeKategori'));
    }
}
