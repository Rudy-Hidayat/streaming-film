<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            ['nama_kategori' => 'Action', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Comedy', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Fantasy', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'History', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Horror', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Melodrama', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Romance', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'School', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Sci-Fi', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Thriller', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('kategoris')->insert($kategoris);
    }
}
