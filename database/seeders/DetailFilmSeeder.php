<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailFilm;

class DetailFilmSeeder extends Seeder
{
    public function run()
    {
        $details = [
            [
                'film_id' => 1,
                'direktur' => 'Christopher Nolan',
                'pemain' => 'Leonardo DiCaprio, Joseph Gordon-Levitt',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
            [
                'film_id' => 2,
                'direktur' => 'Steven Spielberg',
                'pemain' => 'Tom Hanks, Matt Damon',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
            [
                'film_id' => 3,
                'direktur' => 'Quentin Tarantino',
                'pemain' => 'Brad Pitt, Christoph Waltz',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
            [
                'film_id' => 4,
                'direktur' => 'James Cameron',
                'pemain' => 'Sam Worthington, Zoe Saldana',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
            [
                'film_id' => 5,
                'direktur' => 'Ridley Scott',
                'pemain' => 'Russell Crowe, Joaquin Phoenix',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
            [
                'film_id' => 6,
                'direktur' => 'Denis Villeneuve',
                'pemain' => 'Timothée Chalamet, Zendaya',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
            [
                'film_id' => 7,
                'direktur' => 'Martin Scorsese',
                'pemain' => 'Leonardo DiCaprio, Robert De Niro',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
            [
                'film_id' => 8,
                'direktur' => 'Peter Jackson',
                'pemain' => 'Elijah Wood, Ian McKellen',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
            [
                'film_id' => 9,
                'direktur' => 'David Fincher',
                'pemain' => 'Edward Norton, Brad Pitt',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
            [
                'film_id' => 10,
                'direktur' => 'Stanley Kubrick',
                'pemain' => 'Jack Nicholson, Shelley Duvall',
                'bahasa' => 'English',
                'subtitle' => 'Indonesia',
            ],
        ];

        foreach ($details as $detail) {
            DetailFilm::create($detail);
        }
    }
}
