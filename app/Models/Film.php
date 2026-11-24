<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'durasi', 'tahun_rilis', 'rating', 'url_film', 'poster_url'];

    protected $casts = [
        'rating' => 'decimal:1',
    ];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'film_kategori', 'film_id', 'kategori_id');
    }

    public function detailFilm()
    {
        return $this->hasOne(DetailFilm::class, 'film_id');
    }

    /**
     * URL poster: gambar asli bila ada, selain itu poster SVG yang dibuat otomatis.
     */
    public function getPosterSrcAttribute(): string
    {
        return $this->poster_url ? asset($this->poster_url) : route('films.poster', $this->id);
    }

    /**
     * URL video yang bisa diputar, atau null bila belum tersedia
     * (file lokal tidak ada / bukan file video).
     */
    public function getVideoUrlAttribute(): ?string
    {
        $url = $this->url_film;

        if (! $url || ! preg_match('/\.(mp4|webm|ogg)(\?.*)?$/i', $url)) {
            return null;
        }

        if (preg_match('#^https?://#i', $url)) {
            return $url;
        }

        return file_exists(public_path($url)) ? asset($url) : null;
    }
}


