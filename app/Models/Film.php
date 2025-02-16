<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'sinopsis', 'tahun_rilis'];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'film_kategori', 'film_id', 'kategori_id');
    }

    public function detailFilm()
    {
        return $this->hasOne(DetailFilm::class, 'film_id');
    }
}


