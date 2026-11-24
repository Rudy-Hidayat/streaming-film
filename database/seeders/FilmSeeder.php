<?php

namespace Database\Seeders;

use App\Models\DetailFilm;
use App\Models\Film;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Data film beserta kategori & detailnya dalam satu tempat.
 * Relasi dicocokkan lewat judul / nama kategori, bukan ID, agar tidak tertukar.
 * Film tanpa `poster_url` akan memakai poster SVG yang dibuat otomatis.
 */
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
                'kategori' => ['Action', 'Sci-Fi', 'Fantasy'],
                'detail' => ['Anthony Russo, Joe Russo', 'Robert Downey Jr., Chris Evans, Scarlett Johansson', 'English'],
            ],
            [
                'judul' => 'Joker',
                'deskripsi' => 'Kisah asal-usul Arthur Fleck sebelum menjadi Joker, musuh terbesar Batman.',
                'durasi' => 122,
                'tahun_rilis' => 2019,
                'rating' => 8.5,
                'url_film' => 'https://example.com/joker',
                'poster_url' => 'images/no2.jpg',
                'kategori' => ['Thriller', 'Melodrama'],
                'detail' => ['Todd Phillips', 'Joaquin Phoenix, Robert De Niro, Zazie Beetz', 'English'],
            ],
            [
                'judul' => 'Interstellar',
                'deskripsi' => 'Sekelompok penjelajah melakukan perjalanan melalui lubang cacing untuk menyelamatkan umat manusia.',
                'durasi' => 169,
                'tahun_rilis' => 2014,
                'rating' => 8.7,
                'url_film' => 'https://example.com/interstellar',
                'poster_url' => 'images/no4.jpg',
                'kategori' => ['Sci-Fi', 'Melodrama'],
                'detail' => ['Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', 'English'],
            ],
            [
                'judul' => 'The Dark Knight',
                'deskripsi' => 'Batman menghadapi Joker yang ingin menjerumuskan Gotham ke dalam kekacauan.',
                'durasi' => 152,
                'tahun_rilis' => 2008,
                'rating' => 9.0,
                'url_film' => 'https://example.com/dark-knight',
                'poster_url' => 'images/no6.jpg',
                'kategori' => ['Action', 'Thriller'],
                'detail' => ['Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart', 'English'],
            ],
            [
                'judul' => 'Parasite',
                'deskripsi' => 'Keluarga miskin menyusup ke kehidupan keluarga kaya dengan konsekuensi yang tak terduga.',
                'durasi' => 132,
                'tahun_rilis' => 2019,
                'rating' => 8.6,
                'url_film' => 'https://example.com/parasite',
                'poster_url' => 'images/no3.jpg',
                'kategori' => ['Thriller', 'Comedy', 'Melodrama'],
                'detail' => ['Bong Joon-ho', 'Song Kang-ho, Lee Sun-kyun, Cho Yeo-jeong', 'Korea'],
            ],
            [
                'judul' => 'Inception',
                'deskripsi' => 'Seorang pencuri yang mencuri rahasia melalui mimpi mendapat tugas menanamkan sebuah ide.',
                'durasi' => 148,
                'tahun_rilis' => 2010,
                'rating' => 8.8,
                'url_film' => 'https://example.com/inception',
                'poster_url' => 'images/no5.jpg',
                'kategori' => ['Sci-Fi', 'Action', 'Thriller'],
                'detail' => ['Christopher Nolan', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Elliot Page', 'English'],
            ],
            [
                'judul' => 'Spider-Man: No Way Home',
                'deskripsi' => 'Peter Parker bekerja sama dengan Spider-Man dari semesta lain untuk melawan musuh-musuh lamanya.',
                'durasi' => 148,
                'tahun_rilis' => 2021,
                'rating' => 8.2,
                'url_film' => 'https://example.com/spiderman-no-way-home',
                'poster_url' => null,
                'kategori' => ['Action', 'Fantasy', 'Sci-Fi'],
                'detail' => ['Jon Watts', 'Tom Holland, Zendaya, Benedict Cumberbatch', 'English'],
            ],
            [
                'judul' => 'The Matrix',
                'deskripsi' => 'Seorang hacker menemukan kenyataan bahwa dunia yang ia tinggali hanyalah simulasi komputer.',
                'durasi' => 136,
                'tahun_rilis' => 1999,
                'rating' => 8.7,
                'url_film' => 'https://example.com/matrix',
                'poster_url' => null,
                'kategori' => ['Sci-Fi', 'Action'],
                'detail' => ['Lana Wachowski, Lilly Wachowski', 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss', 'English'],
            ],
            [
                'judul' => 'The Godfather',
                'deskripsi' => 'Sebuah kisah epik tentang keluarga mafia Italia di Amerika Serikat.',
                'durasi' => 175,
                'tahun_rilis' => 1972,
                'rating' => 9.2,
                'url_film' => 'https://example.com/godfather',
                'poster_url' => 'images/no10.jpg',
                'kategori' => ['Melodrama', 'Thriller'],
                'detail' => ['Francis Ford Coppola', 'Marlon Brando, Al Pacino, James Caan', 'English'],
            ],
            [
                'judul' => 'Forrest Gump',
                'deskripsi' => 'Perjalanan hidup seorang pria sederhana yang tanpa sengaja menjadi bagian dari sejarah Amerika.',
                'durasi' => 142,
                'tahun_rilis' => 1994,
                'rating' => 8.8,
                'url_film' => 'https://example.com/forrest-gump',
                'poster_url' => 'images/no9.jpg',
                'kategori' => ['Melodrama', 'Romance', 'Comedy', 'History'],
                'detail' => ['Robert Zemeckis', 'Tom Hanks, Robin Wright, Gary Sinise', 'English'],
            ],
            [
                'judul' => 'Titanic',
                'deskripsi' => 'Kisah cinta Jack dan Rose yang berbeda kelas di atas kapal pesiar mewah dalam pelayaran perdananya yang tragis.',
                'durasi' => 194,
                'tahun_rilis' => 1997,
                'rating' => 7.9,
                'url_film' => null,
                'poster_url' => 'images/no7.jpg',
                'kategori' => ['Romance', 'Melodrama', 'History'],
                'detail' => ['James Cameron', 'Leonardo DiCaprio, Kate Winslet, Billy Zane', 'English'],
            ],
            [
                'judul' => 'The Shawshank Redemption',
                'deskripsi' => 'Seorang bankir yang dipenjara karena tuduhan pembunuhan menjalin persahabatan dan menjaga harapan selama puluhan tahun.',
                'durasi' => 142,
                'tahun_rilis' => 1994,
                'rating' => 9.3,
                'url_film' => null,
                'poster_url' => 'images/no8.jpg',
                'kategori' => ['Melodrama'],
                'detail' => ['Frank Darabont', 'Tim Robbins, Morgan Freeman, Bob Gunton', 'English'],
            ],

            // ---- Indonesia ----
            [
                'judul' => 'Pengabdi Setan',
                'deskripsi' => 'Sepeninggal ibu mereka, Rini dan adik-adiknya mulai diteror sosok yang menyerupai sang ibu.',
                'durasi' => 107,
                'tahun_rilis' => 2017,
                'rating' => 6.6,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Horror'],
                'detail' => ['Joko Anwar', 'Tara Basro, Bront Palarae, Endy Arfian', 'Indonesia'],
            ],
            [
                'judul' => 'The Raid',
                'deskripsi' => 'Tim pasukan khusus terjebak di gedung apartemen yang dikuasai gembong narkoba dan harus bertarung lantai demi lantai.',
                'durasi' => 101,
                'tahun_rilis' => 2011,
                'rating' => 7.6,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Action', 'Thriller'],
                'detail' => ['Gareth Evans', 'Iko Uwais, Joe Taslim, Yayan Ruhian', 'Indonesia'],
            ],
            [
                'judul' => 'Dilan 1990',
                'deskripsi' => 'Milea, siswi pindahan dari Jakarta, didekati Dilan, anak SMA di Bandung dengan cara yang tidak biasa.',
                'durasi' => 110,
                'tahun_rilis' => 2018,
                'rating' => 6.6,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Romance', 'School'],
                'detail' => ['Fajar Bustomi, Pidi Baiq', 'Iqbaal Ramadhan, Vanesha Prescilla, Giulio Parengkuan', 'Indonesia'],
            ],
            [
                'judul' => 'Ada Apa dengan Cinta?',
                'deskripsi' => 'Cinta, siswi populer yang aktif di mading sekolah, justru tertarik pada Rangga, siswa penyendiri pencinta puisi.',
                'durasi' => 112,
                'tahun_rilis' => 2002,
                'rating' => 7.7,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Romance', 'School', 'Melodrama'],
                'detail' => ['Rudi Soedjarwo', 'Dian Sastrowardoyo, Nicholas Saputra, Titi Kamal', 'Indonesia'],
            ],
            [
                'judul' => 'Laskar Pelangi',
                'deskripsi' => 'Sepuluh anak di Belitung berjuang menempuh pendidikan di sekolah sederhana yang nyaris ditutup.',
                'durasi' => 124,
                'tahun_rilis' => 2008,
                'rating' => 7.9,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['School', 'Melodrama'],
                'detail' => ['Riri Riza', 'Cut Mini, Ikranagara, Zulfanny', 'Indonesia'],
            ],

            // ---- Asia ----
            [
                'judul' => 'Train to Busan',
                'deskripsi' => 'Wabah zombi menyebar di Korea Selatan saat para penumpang kereta cepat menuju Busan berjuang bertahan hidup.',
                'durasi' => 118,
                'tahun_rilis' => 2016,
                'rating' => 7.6,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Horror', 'Action'],
                'detail' => ['Yeon Sang-ho', 'Gong Yoo, Jung Yu-mi, Ma Dong-seok', 'Korea'],
            ],
            [
                'judul' => '3 Idiots',
                'deskripsi' => 'Dua sahabat mencari Rancho, teman kuliah mereka yang dulu menentang sistem pendidikan yang kaku.',
                'durasi' => 170,
                'tahun_rilis' => 2009,
                'rating' => 8.4,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Comedy', 'School', 'Melodrama'],
                'detail' => ['Rajkumar Hirani', 'Aamir Khan, R. Madhavan, Sharman Joshi', 'Hindi'],
            ],
            [
                'judul' => 'Spirited Away',
                'deskripsi' => 'Chihiro terjebak di dunia roh dan harus bekerja di pemandian milik penyihir untuk menyelamatkan orang tuanya.',
                'durasi' => 125,
                'tahun_rilis' => 2001,
                'rating' => 8.6,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Fantasy'],
                'detail' => ['Hayao Miyazaki', 'Rumi Hiiragi, Miyu Irino, Mari Natsuki', 'Jepang'],
            ],
            [
                'judul' => 'Your Name',
                'deskripsi' => 'Dua remaja yang tak saling kenal tiba-tiba bertukar tubuh dan mencoba menemukan satu sama lain.',
                'durasi' => 106,
                'tahun_rilis' => 2016,
                'rating' => 8.4,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Romance', 'Fantasy', 'School'],
                'detail' => ['Makoto Shinkai', 'Ryunosuke Kamiki, Mone Kamishiraishi, Masami Nagasawa', 'Jepang'],
            ],

            // ---- Hollywood ----
            [
                'judul' => 'The Conjuring',
                'deskripsi' => 'Pasangan penyelidik paranormal Ed dan Lorraine Warren membantu keluarga yang diteror di rumah pertanian mereka.',
                'durasi' => 112,
                'tahun_rilis' => 2013,
                'rating' => 7.5,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Horror', 'Thriller'],
                'detail' => ['James Wan', 'Vera Farmiga, Patrick Wilson, Lili Taylor', 'English'],
            ],
            [
                'judul' => 'Get Out',
                'deskripsi' => 'Kunjungan Chris ke rumah keluarga kekasihnya berubah menjadi mimpi buruk yang mengerikan.',
                'durasi' => 104,
                'tahun_rilis' => 2017,
                'rating' => 7.8,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Horror', 'Thriller'],
                'detail' => ['Jordan Peele', 'Daniel Kaluuya, Allison Williams, Bradley Whitford', 'English'],
            ],
            [
                'judul' => 'La La Land',
                'deskripsi' => 'Seorang pianis jazz dan calon aktris jatuh cinta sambil mengejar mimpi masing-masing di Los Angeles.',
                'durasi' => 128,
                'tahun_rilis' => 2016,
                'rating' => 8.0,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Romance', 'Melodrama'],
                'detail' => ['Damien Chazelle', 'Ryan Gosling, Emma Stone, John Legend', 'English'],
            ],
            [
                'judul' => 'Gladiator',
                'deskripsi' => 'Jenderal Romawi yang dikhianati menjadi gladiator dan menuntut balas kepada kaisar yang membunuh keluarganya.',
                'durasi' => 155,
                'tahun_rilis' => 2000,
                'rating' => 8.5,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['History', 'Action'],
                'detail' => ['Ridley Scott', 'Russell Crowe, Joaquin Phoenix, Connie Nielsen', 'English'],
            ],
            [
                'judul' => "Schindler's List",
                'deskripsi' => 'Pengusaha Oskar Schindler menyelamatkan lebih dari seribu pengungsi Yahudi selama Perang Dunia II.',
                'durasi' => 195,
                'tahun_rilis' => 1993,
                'rating' => 9.0,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['History', 'Melodrama'],
                'detail' => ['Steven Spielberg', 'Liam Neeson, Ben Kingsley, Ralph Fiennes', 'English'],
            ],
            [
                'judul' => 'Oppenheimer',
                'deskripsi' => 'Kisah J. Robert Oppenheimer dan perannya dalam pengembangan bom atom pertama.',
                'durasi' => 180,
                'tahun_rilis' => 2023,
                'rating' => 8.3,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['History', 'Thriller'],
                'detail' => ['Christopher Nolan', 'Cillian Murphy, Emily Blunt, Matt Damon', 'English'],
            ],
            [
                'judul' => "Harry Potter and the Philosopher's Stone",
                'deskripsi' => 'Harry mengetahui dirinya seorang penyihir dan memulai tahun pertamanya di Sekolah Sihir Hogwarts.',
                'durasi' => 152,
                'tahun_rilis' => 2001,
                'rating' => 7.7,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Fantasy', 'School'],
                'detail' => ['Chris Columbus', 'Daniel Radcliffe, Rupert Grint, Emma Watson', 'English'],
            ],
            [
                'judul' => 'The Lord of the Rings: The Fellowship of the Ring',
                'deskripsi' => 'Frodo dan rombongannya memulai perjalanan berbahaya untuk menghancurkan Cincin Utama.',
                'durasi' => 178,
                'tahun_rilis' => 2001,
                'rating' => 8.9,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Fantasy', 'Action'],
                'detail' => ['Peter Jackson', 'Elijah Wood, Ian McKellen, Viggo Mortensen', 'English'],
            ],
            [
                'judul' => 'Home Alone',
                'deskripsi' => 'Kevin yang tertinggal sendirian di rumah saat liburan Natal harus menghadapi dua pencuri yang ceroboh.',
                'durasi' => 103,
                'tahun_rilis' => 1990,
                'rating' => 7.7,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Comedy'],
                'detail' => ['Chris Columbus', 'Macaulay Culkin, Joe Pesci, Daniel Stern', 'English'],
            ],
            [
                'judul' => 'The Grand Budapest Hotel',
                'deskripsi' => 'Petualangan concierge legendaris dan bocah lobi kepercayaannya dalam kasus pencurian lukisan berharga.',
                'durasi' => 99,
                'tahun_rilis' => 2014,
                'rating' => 8.1,
                'url_film' => null,
                'poster_url' => null,
                'kategori' => ['Comedy'],
                'detail' => ['Wes Anderson', 'Ralph Fiennes, Tony Revolori, Saoirse Ronan', 'English'],
            ],
        ];

        $kategoriIds = Kategori::pluck('id', 'nama_kategori');

        DB::transaction(function () use ($films, $kategoriIds) {
            foreach ($films as $data) {
                $film = Film::updateOrCreate(
                    ['judul' => $data['judul']],
                    collect($data)->except(['kategori', 'detail'])->all()
                );

                $film->kategoris()->sync($kategoriIds->only($data['kategori'])->values());

                [$direktur, $pemain, $bahasa] = $data['detail'];
                DetailFilm::updateOrCreate(
                    ['film_id' => $film->id],
                    ['direktur' => $direktur, 'pemain' => $pemain, 'bahasa' => $bahasa, 'subtitle' => 'Indonesia']
                );
            }
        });
    }
}
