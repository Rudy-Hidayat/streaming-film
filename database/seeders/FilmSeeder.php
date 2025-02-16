<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    public function run()
    {
        $films = [
            [
                'judul' => 'Avengers: Endgame',
                'deskripsi' => 'Para Avengers bertarung melawan Thanos untuk mengembalikan keseimbangan alam semesta.',
                'durasi' => 181,
                'tahun_rilis' => 2019,
                'rating' => 8.4,
                'url_film' => 'assets/Hymne_Universitas_Syiah_Kuala.mp4',
                'poster_url' => 'images/no1.jpg',
            ],
            [
                'judul' => 'Joker',
                'deskripsi' => 'Kisah asal-usul Arthur Fleck sebelum menjadi Joker, musuh terbesar Batman.',
                'durasi' => 122,
                'tahun_rilis' => 2019,
                'rating' => 8.5,
                'url_film' => 'https://example.com/joker',
                'poster_url' => 'images/no2.jpg',
            ],
            [
                'judul' => 'Interstellar',
                'deskripsi' => 'Tim penjelajah ruang angkasa mencari planet baru untuk umat manusia.',
                'durasi' => 169,
                'tahun_rilis' => 2014,
                'rating' => 8.7,
                'url_film' => 'https://example.com/interstellar',
                'poster_url' => 'images/no3.jpg',
            ],
            [
                'judul' => 'The Dark Knight',
                'deskripsi' => 'Batman harus menghadapi ancaman besar dari Joker yang ingin menguasai Gotham.',
                'durasi' => 152,
                'tahun_rilis' => 2008,
                'rating' => 9.0,
                'url_film' => 'https://example.com/dark-knight',
                'poster_url' => 'images/no4.jpg',
            ],
            [
                'judul' => 'Parasite',
                'deskripsi' => 'Sebuah keluarga miskin menyusup ke dalam rumah keluarga kaya dengan berbagai cara.',
                'durasi' => 132,
                'tahun_rilis' => 2019,
                'rating' => 8.6,
                'url_film' => 'https://example.com/parasite',
                'poster_url' => 'images/no5.jpg',
            ],
            [
                'judul' => 'Inception',
                'deskripsi' => 'Seorang pencuri yang bisa memasuki mimpi orang lain berusaha mencuri informasi berharga.',
                'durasi' => 148,
                'tahun_rilis' => 2010,
                'rating' => 8.8,
                'url_film' => 'https://example.com/inception',
                'poster_url' => 'images/no6.jpg',
            ],
            [
                'judul' => 'Spider-Man: No Way Home',
                'deskripsi' => 'Peter Parker bekerja sama dengan Spider-Man dari semesta lain untuk melawan musuh-musuh lamanya.',
                'durasi' => 148,
                'tahun_rilis' => 2021,
                'rating' => 8.2,
                'url_film' => 'https://example.com/spiderman-no-way-home',
                'poster_url' => 'images/no7.jpg',
            ],
            [
                'judul' => 'The Matrix',
                'deskripsi' => 'Seorang hacker menemukan kenyataan bahwa dunia yang ia tinggali hanyalah simulasi komputer.',
                'durasi' => 136,
                'tahun_rilis' => 1999,
                'rating' => 8.7,
                'url_film' => 'https://example.com/matrix',
                'poster_url' => 'images/no8.jpg',
            ],
            [
                'judul' => 'The Godfather',
                'deskripsi' => 'Sebuah kisah epik tentang keluarga mafia Italia di Amerika Serikat.',
                'durasi' => 175,
                'tahun_rilis' => 1972,
                'rating' => 9.2,
                'url_film' => 'https://example.com/godfather',
                'poster_url' => 'images/no9.jpg',
            ],
            [
                'judul' => 'Forrest Gump',
                'deskripsi' => 'Seorang pria sederhana dengan IQ rendah mengalami berbagai kejadian luar biasa sepanjang hidupnya.',
                'durasi' => 142,
                'tahun_rilis' => 1994,
                'rating' => 8.8,
                'url_film' => 'https://example.com/forrest-gump',
                'poster_url' => 'images/no10.jpg',
            ],
        ];

        foreach ($films as $film) {
            DB::table('films')->updateOrInsert(
                ['judul' => $film['judul']], // Cek apakah film dengan judul ini sudah ada
                array_merge($film, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }
}
