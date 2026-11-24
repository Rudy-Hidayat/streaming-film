# Streaming Film

Aplikasi katalog film berbasis **Laravel 10** dengan tampilan bergaya platform streaming: tema gelap, poster sebagai elemen utama, film dikelompokkan per kategori, dan pencarian yang berfungsi.

## Fitur

- **Beranda** (`/`): baris film per kategori.
- **Daftar film** (`/films`): grid film dengan pencarian dan tombol *Load More*.
- **Detail film** (`/films/{id}`): poster, rating, tahun, durasi, genre, dan sinopsis.
- **Filter kategori** (`/kategori/{kategori}`): daftar film dalam satu kategori.
- **Poster otomatis** (`/films/{film}/poster.svg`): poster SVG dibuat otomatis untuk film yang belum punya gambar.
- Responsif untuk HP, tablet, dan desktop.

## Teknologi

- PHP ^8.1, Laravel ^10.10
- MySQL
- Blade + Bootstrap 5.3
- Vite

## Instalasi

```bash
git clone https://github.com/Rudy-Hidayat/streaming-film.git
cd streaming-film

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Atur koneksi database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=streaming_film
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi beserta data contoh:

```bash
php artisan migrate --seed
```

## Menjalankan

```bash
npm run dev        # Vite (aset frontend)
php artisan serve  # server Laravel
```

Buka http://127.0.0.1:8000.

Untuk build produksi gunakan `npm run build`.

## Struktur Database

| Tabel | Keterangan |
|---|---|
| `films` | Data utama film |
| `detail_films` | Informasi tambahan film |
| `kategoris` | Daftar kategori/genre |
| `film_kategori` | Relasi banyak-ke-banyak film dan kategori |

## Struktur View

```
resources/views/
├── layouts/main.blade.php      # layout utama (navbar, pencarian, footer)
├── components/
│   ├── film-card.blade.php     # kartu film
│   ├── film-row.blade.php      # baris film per kategori
│   └── genre-chip.blade.php    # label genre
└── films/
    ├── home.blade.php          # beranda
    ├── index.blade.php         # daftar & hasil pencarian
    ├── _grid.blade.php         # grid film (dipakai Load More)
    ├── show.blade.php          # detail film
    └── poster.blade.php        # template poster SVG
```

## Dokumentasi

Rancangan redesign UI/UX ada di [`docs/ui-ux-redesign.md`](docs/ui-ux-redesign.md).

## Lisensi

[MIT](https://opensource.org/licenses/MIT)
