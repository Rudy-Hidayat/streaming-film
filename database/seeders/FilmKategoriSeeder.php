<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmKategoriSeeder extends Seeder
{
    public function run()
    {
        $filmKategoris = [
            ['film_id' => 1, 'kategori_id' => 1], // Film 1 - Action
            ['film_id' => 1, 'kategori_id' => 3], // Film 1 - Fantasy
            ['film_id' => 2, 'kategori_id' => 2], // Film 2 - Comedy
            ['film_id' => 2, 'kategori_id' => 7], // Film 2 - Romance
            ['film_id' => 3, 'kategori_id' => 4], // Film 3 - History
            ['film_id' => 4, 'kategori_id' => 5], // Film 4 - Horror
            ['film_id' => 5, 'kategori_id' => 6], // Film 5 - Melodrama
            ['film_id' => 6, 'kategori_id' => 8], // Film 6 - School
            ['film_id' => 7, 'kategori_id' => 9], // Film 7 - Sci-Fi
            ['film_id' => 8, 'kategori_id' => 10], // Film 8 - Thriller
        ];

        DB::table('film_kategori')->insert($filmKategoris);
    }
}
