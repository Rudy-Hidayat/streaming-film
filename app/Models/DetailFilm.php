<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFilm extends Model
{
    use HasFactory;

    protected $table = 'detail_films';

    protected $fillable = [
        'film_id', 'direktur', 'pemain', 'bahasa', 'subtitle'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }
}
