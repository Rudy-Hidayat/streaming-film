# Rancangan Update UI/UX — Streaming Film

> Status: **Selesai diimplementasikan (fase 1–5)** · Dibuat: 30 Oktober 2026
> Cakupan: `resources/views/layouts/main.blade.php`, `resources/views/films/*.blade.php`, `routes/web.php`, `app/Http/Controllers/FilmController.php`

---

## 1. Latar Belakang

Tampilan saat ini masih memakai komponen Bootstrap bawaan tanpa kustomisasi, sehingga terasa seperti template admin, bukan platform streaming. Dokumen ini merancang ulang tampilan agar lebih **sinematik, imersif, dan mudah dijelajahi**, sambil tetap memakai stack yang ada (Laravel Blade + Bootstrap 5.3).

### 1.1 Kondisi Saat Ini (hasil audit)

| Area | Masalah | Lokasi |
|---|---|---|
| Visual | Tema terang standar, navbar `bg-dark` + sub-header `bg-light` terasa terpisah | `layouts/main.blade.php` |
| Navigasi | Tombol Home, Login, dan logo mengarah ke `href=""` / `#` | `layouts/main.blade.php` |
| Kategori | Dropdown di-*hardcode*, link `#`, kategori **Sci-Fi** & **Thriller** tidak muncul | `layouts/main.blade.php` |
| Kategori | Route `byKategori` tidak terdaftar; view memakai nama kolom salah (`Nama_Kategori`, `Judul`, `Film_ID`) dan tidak memakai layout | `routes/web.php`, `films/by_kategori.blade.php` |
| Pencarian | Form search tidak punya `action` dan tidak diproses di controller | `layouts/main.blade.php` |
| Footer | Memakai ikon Font Awesome (`fab fa-…`) tapi library-nya tidak dimuat → ikon kosong | `layouts/main.blade.php` |
| Daftar film | Kartu polos tanpa efek hover, kursor bukan pointer, tidak ada rating/kategori | `films/index.blade.php` |
| Daftar film | Script *Load More* error saat tombol tidak ada (`getElementById` → `null`) dan menempelkan **seluruh HTML halaman** ke grid | `films/index.blade.php` |
| Detail film | Poster kecil (`col-md-2`), informasi berupa list teks, kategori film tidak ditampilkan padahal sudah di-*load* | `films/show.blade.php` |
| Halaman utama | `/` masih halaman welcome Laravel | `routes/web.php` |

---

## 2. Tujuan Desain

1. **Sinematik** — tema gelap, poster sebagai elemen visual utama, aksen warna yang tegas.
2. **Mudah dijelajahi** — film dikelompokkan per kategori, pencarian berfungsi, navigasi selalu terlihat.
3. **Cepat dikenali** — informasi penting (rating, tahun, durasi, genre) tampil tanpa harus membuka detail.
4. **Responsif** — nyaman di HP (≥ 360px), tablet, dan desktop.
5. **Aksesibel** — kontras cukup, bisa dinavigasi dengan keyboard, teks alternatif pada gambar.

---

## 3. Design System

### 3.1 Warna

Menggunakan mode gelap Bootstrap (`<html data-bs-theme="dark">`) lalu di-*override* lewat CSS variables.

| Token | Nilai | Kegunaan |
|---|---|---|
| `--sf-bg` | `#0b0d12` | Latar halaman |
| `--sf-surface` | `#151922` | Kartu, navbar saat discroll, panel |
| `--sf-surface-2` | `#1f2430` | Hover, input |
| `--sf-border` | `rgba(255,255,255,.08)` | Garis pemisah |
| `--sf-text` | `#e9ecf2` | Teks utama |
| `--sf-muted` | `#9aa3b2` | Teks sekunder |
| `--sf-accent` | `#e50914` | Tombol utama, highlight, link aktif |
| `--sf-accent-hover` | `#ff1f2b` | Hover tombol utama |
| `--sf-gold` | `#f5c518` | Ikon & angka rating |

```css
:root,
[data-bs-theme="dark"] {
  --sf-bg: #0b0d12;
  --sf-surface: #151922;
  --sf-surface-2: #1f2430;
  --sf-border: rgba(255, 255, 255, .08);
  --sf-text: #e9ecf2;
  --sf-muted: #9aa3b2;
  --sf-accent: #e50914;
  --sf-accent-hover: #ff1f2b;
  --sf-gold: #f5c518;

  --bs-body-bg: var(--sf-bg);
  --bs-body-color: var(--sf-text);
  --bs-primary: var(--sf-accent);
  --bs-primary-rgb: 229, 9, 20;
  --bs-border-color: var(--sf-border);
}
```

### 3.2 Tipografi

- Font: **Poppins** (judul, 600/700) + **Inter** (teks, 400/500) dari Google Fonts.
- Skala: Hero `clamp(2rem, 5vw, 3.5rem)` · Judul section `1.375rem` · Judul kartu `0.95rem` · Meta `0.8rem`.

### 3.3 Ikon

Ganti Font Awesome yang tidak termuat dengan **Bootstrap Icons** (satu ekosistem dengan Bootstrap):

```html
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
```

Ikon yang dipakai: `bi-play-fill`, `bi-star-fill`, `bi-clock`, `bi-calendar3`, `bi-search`, `bi-person-circle`, `bi-facebook`, `bi-twitter-x`, `bi-envelope`, `bi-youtube`.

### 3.4 Spasi, Radius, Bayangan

| Token | Nilai |
|---|---|
| Radius kartu | `12px` |
| Radius tombol | `999px` (pill) |
| Bayangan kartu hover | `0 12px 30px rgba(0,0,0,.5)` |
| Transisi | `transform .25s ease, box-shadow .25s ease` |
| Jarak antar section | `3rem` |

---

## 4. Komponen

### 4.1 Navbar (gabungan navbar + sub-header)

Satu baris, *sticky*, transparan di atas hero lalu berubah solid + blur saat discroll.

```
┌──────────────────────────────────────────────────────────────────────┐
│ ▶ StreamFilm   Beranda  Kategori ▾  Terbaru        [🔍 Cari film… ]  👤 Masuk │
└──────────────────────────────────────────────────────────────────────┘
```

- Logo & "Beranda" → `route('home')`.
- Menu link aktif diberi garis bawah warna aksen (`request()->routeIs(...)`).
- **Dropdown kategori dinamis** dari database (lihat §6.2), ditampilkan sebagai *mega menu* 2 kolom.
- Search: `form action="{{ route('films.index') }}" method="GET"` dengan `name="q"`, nilai input mempertahankan `request('q')`.
- Mobile: menu masuk ke `offcanvas` dari kanan; search tetap tampil di atas.

```css
.sf-navbar { position: sticky; top: 0; z-index: 1030; transition: background .3s; }
.sf-navbar.is-scrolled { background: rgba(11,13,18,.85); backdrop-filter: blur(12px); border-bottom: 1px solid var(--sf-border); }
```

### 4.2 Kartu Film (poster card)

Rasio poster tetap **2:3**, informasi muncul sebagai overlay saat hover/focus.

```
┌────────────┐        hover →    ┌────────────┐
│            │                   │ ★ 8.8      │
│   POSTER   │                   │            │
│            │                   │    ( ▶ )   │
│            │                   │ Inception  │
└────────────┘                   │ 2010 · 148m│
 Inception                       └────────────┘
 2010 · ★ 8.8
```

- Seluruh kartu adalah `<a>` (bukan `onclick`) → bisa di-*tab* dan dibuka di tab baru.
- Badge rating di pojok kiri atas (`--sf-gold`).
- Hover: `transform: scale(1.05)`, bayangan, gradien gelap dari bawah, tombol ▶ di tengah.
- `loading="lazy"` pada gambar; fallback `images/nophoto.jpg` jika `poster_url` kosong.

```blade
<a href="{{ route('films.show', $film) }}" class="sf-card">
    <div class="sf-card__poster ratio" style="--bs-aspect-ratio: 150%">
        <img src="{{ asset($film->poster_url ?? 'images/nophoto.jpg') }}" alt="Poster {{ $film->judul }}" loading="lazy">
        <span class="sf-card__rating"><i class="bi bi-star-fill"></i> {{ $film->rating }}</span>
        <span class="sf-card__play"><i class="bi bi-play-fill"></i></span>
    </div>
    <h3 class="sf-card__title">{{ $film->judul }}</h3>
    <p class="sf-card__meta">{{ $film->tahun_rilis }} · {{ $film->durasi }} mnt</p>
</a>
```

Sebaiknya dijadikan Blade component: `resources/views/components/film-card.blade.php` → dipakai `<x-film-card :film="$film" />`.

### 4.3 Baris Horizontal (carousel per kategori)

```
Action                                                    Lihat semua →
┌────┐ ┌────┐ ┌────┐ ┌────┐ ┌────┐ ┌────┐ ┌──
│    │ │    │ │    │ │    │ │    │ │    │ │
└────┘ └────┘ └────┘ └────┘ └────┘ └────┘ └──   ‹ ›
```

- CSS `overflow-x: auto; scroll-snap-type: x mandatory;` — tanpa library tambahan.
- Tombol ‹ › hanya di desktop, memanggil `scrollBy({ left: el.clientWidth * .8, behavior: 'smooth' })`.
- Lebar kartu: 45% (HP), 22% (tablet), 15% (desktop).

### 4.4 Chip Genre

`<a class="badge rounded-pill sf-chip">Action</a>` — latar `--sf-surface-2`, hover berubah ke aksen. Dipakai di hero, detail film, dan filter halaman daftar.

### 4.5 Footer

Tiga kolom: (1) logo + deskripsi singkat, (2) tautan kategori populer, (3) ikon sosial Bootstrap Icons. Baris bawah: `© {{ date('Y') }} StreamFilm`. Tahun dinamis, bukan *hardcode* 2025.

---

## 5. Rancangan Halaman

### 5.1 Beranda (`/`) — **baru**

```
┌──────────────────────────────── NAVBAR ────────────────────────────────┐
│                                                                        │
│  HERO (backdrop = poster film rating tertinggi, blur + gradien)        │
│                                                                        │
│  [Action] [Sci-Fi]                                                     │
│  INCEPTION                                                             │
│  ★ 8.8 · 2010 · 148 menit                                              │
│  Seorang pencuri yang mencuri rahasia lewat mimpi…                     │
│  [ ▶ Tonton Sekarang ]  [ ⓘ Detail ]                                   │
│                                                                        │
├────────────────────────────────────────────────────────────────────────┤
│ 🔥 Rating Tertinggi                                    Lihat semua →   │
│ [card][card][card][card][card][card]                                    │
│ 🆕 Rilis Terbaru                                                        │
│ [card][card][card][card][card][card]                                    │
│ Action / Comedy / Sci-Fi … (satu baris per kategori yang punya film)   │
├──────────────────────────────── FOOTER ────────────────────────────────┤
```

- Hero: `background-image` poster + `filter: blur(24px) brightness(.4)` di layer belakang, poster tajam di sisi kanan (desktop).
- Gradien: `linear-gradient(90deg, var(--sf-bg) 10%, transparent 60%), linear-gradient(0deg, var(--sf-bg), transparent 40%)`.
- Kategori tanpa film tidak ditampilkan.

### 5.2 Daftar / Jelajah Film (`/films`)

```
Jelajahi Film                                   Urutkan: [Rating ▾]
[Semua] [Action] [Comedy] [Fantasy] [Horror] [Sci-Fi] …   ← chip filter

Hasil untuk "dark" (3 film)                                ← bila ada ?q=

[card] [card] [card] [card] [card] [card]
[card] [card] [card] [card] [card] [card]

                 [ Muat lebih banyak ]
```

- Grid: `row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3`.
- Filter & sort lewat query string: `?q=`, `?kategori=`, `?sort=rating|terbaru|judul` — tetap bisa dibagikan sebagai URL.
- **Empty state** saat pencarian kosong: ikon `bi-film`, teks "Film tidak ditemukan", tombol "Reset pencarian".
- **Load More diperbaiki**: controller mengembalikan *partial* `films/_grid.blade.php` bila `request()->ajax()`, tombol disembunyikan saat `!hasMorePages()`, dan script dicek `if (btn)` sebelum `addEventListener`. Alternatif paling sederhana: pakai `{{ $films->withQueryString()->links() }}` dengan pagination Bootstrap.

### 5.3 Detail Film (`/films/{id}`)

```
┌────────────────────────────────────────────────────────────────────────┐
│ BACKDROP (poster blur, gelap)                                          │
│  ┌────────┐                                                            │
│  │        │  INCEPTION                                                 │
│  │ POSTER │  ★ 8.8   📅 2010   ⏱ 148 menit                             │
│  │  2:3   │  [Action] [Sci-Fi]                                         │
│  │        │  Seorang pencuri yang mencuri rahasia lewat mimpi…         │
│  └────────┘  [ ▶ Tonton ]  [ + Daftar Saya ]                           │
└────────────────────────────────────────────────────────────────────────┘

┌──────────────── PLAYER 16:9 ───────────────┐  ┌── Info ─────────────┐
│                                            │  │ Sutradara  C. Nolan │
│                                            │  │ Pemain     L. DiCap…│
│                                            │  │ Bahasa     English  │
└────────────────────────────────────────────┘  │ Subtitle   Indonesia│
                                                └─────────────────────┘
Film Serupa
[card] [card] [card] [card] [card] [card]
```

- Tombol "Tonton" melakukan *smooth scroll* ke `#player`.
- Tampilkan `$film->kategoris` sebagai chip (data sudah di-*eager load* di controller).
- **Player fallback**: bila `url_film` bukan file video (mis. `https://example.com/...`) atau gagal dimuat, tampilkan panel "Video belum tersedia" dengan poster sebagai latar — bukan player kosong.
- Rekomendasi: prioritaskan film dengan kategori yang sama, isi sisa slot secara acak; tampilkan sebagai baris kartu (komponen §4.2), bukan list kecil.
- Info detail berupa *definition list* (`<dl class="row">`) agar label & nilai rata.

### 5.4 Film per Kategori (`/kategori/{kategori}`)

Memakai layout & grid yang sama dengan §5.2, judul halaman "Film Action", chip kategori aktif ditandai. View lama `by_kategori.blade.php` ditulis ulang agar `@extends('layouts.main')` dan memakai nama kolom yang benar (`nama_kategori`, `judul`, `id`).

---

## 6. Perubahan Backend Pendukung

### 6.1 Route

```php
Route::get('/', [FilmController::class, 'home'])->name('home');
Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');
Route::get('/kategori/{kategori}', [FilmController::class, 'byKategori'])->name('films.kategori');
```

### 6.2 Kategori global untuk navbar

Di `AppServiceProvider::boot()`:

```php
View::composer('layouts.main', function ($view) {
    $view->with('navKategoris', Kategori::orderBy('nama_kategori')->get());
});
```

### 6.3 Controller

- `home()` — film rating tertinggi (hero), `orderByDesc('rating')->take(12)`, `orderByDesc('tahun_rilis')->take(12)`, dan kategori `with('films')` yang `has('films')`.
- `index()` — dukung `q` (`where('judul', 'like', "%$q%")`), `kategori` (`whereHas`), `sort`; pakai `->paginate(24)->withQueryString()`.
- `show()` — rekomendasi berdasarkan kategori yang sama.

---

## 7. Interaksi & Animasi

| Elemen | Perilaku |
|---|---|
| Navbar | Solid + blur setelah scroll > 40px (IntersectionObserver / `scroll` listener ringan) |
| Kartu | Scale 1.05 + overlay saat `:hover` dan `:focus-visible` |
| Gambar | Skeleton abu-abu berdenyut sampai `load` |
| Section | Fade-in ringan saat masuk viewport |
| Semua animasi | Dimatikan dengan `@media (prefers-reduced-motion: reduce)` |

---

## 8. Responsif

| Breakpoint | Navbar | Grid kartu | Hero | Detail |
|---|---|---|---|---|
| < 576px | Offcanvas + ikon search | 2 kolom | Teks saja, poster disembunyikan | Poster di atas, info di bawah |
| 576–991px | Offcanvas | 3–4 kolom | Teks + backdrop | Poster kiri 1/3 |
| ≥ 992px | Menu penuh | 6 kolom | Teks + poster kanan | Player 8/12, info 4/12 |

---

## 9. Aksesibilitas

- Kontras teks utama vs latar ≥ 4.5:1 (`#e9ecf2` di `#0b0d12` ≈ 16:1); teks muted `#9aa3b2` ≈ 7.5:1.
- Semua elemen interaktif bisa di-*tab* dengan `:focus-visible` outline warna aksen.
- `alt="Poster {judul}"` di setiap gambar; ikon dekoratif diberi `aria-hidden="true"`.
- `<html lang="id">`, satu `<h1>` per halaman, hierarki heading berurutan.
- Video memakai atribut `controls` dan `poster`.

---

## 10. Struktur File

```
resources/
├── css/app.css                       ← design tokens + komponen (§3, §4)
├── js/app.js                         ← navbar scroll, carousel, load more
└── views/
    ├── layouts/main.blade.php        ← navbar baru, footer baru, @vite
    ├── components/
    │   ├── film-card.blade.php
    │   ├── film-row.blade.php
    │   └── genre-chip.blade.php
    └── films/
        ├── home.blade.php            ← baru
        ├── index.blade.php
        ├── _grid.blade.php           ← partial untuk load more
        ├── show.blade.php
        └── by_kategori.blade.php
```

CSS & JS kustom dimuat lewat Vite (`@vite(['resources/css/app.css', 'resources/js/app.js'])`), sehingga butuh `npm install` + `npm run dev` saat development dan `npm run build` sebelum deploy. Bootstrap tetap boleh dari CDN.

---

## 11. Tahapan Implementasi

| Fase | Isi | Estimasi |
|---|---|---|
| **1. Fondasi** | Design tokens, font, Bootstrap Icons, tema gelap, setup Vite, perbaiki footer | 0,5 hari |
| **2. Layout** | Navbar sticky + search berfungsi + kategori dinamis, footer 3 kolom | 0,5 hari |
| **3. Komponen** | `film-card`, `film-row`, `genre-chip` | 0,5 hari |
| **4. Halaman** | Beranda baru, daftar film (filter/sort/empty state/load more), detail film, per kategori | 1,5 hari |
| **5. Polish** | Animasi, skeleton, responsif, cek aksesibilitas, fallback video | 0,5 hari |

---

## 12. Kriteria Selesai

- [ ] Semua link di navbar & footer mengarah ke halaman yang benar (tidak ada `href=""` / `#`). — *sisa: ikon sosial di footer menunggu URL akun asli*
- [x] Pencarian dan filter kategori mengembalikan hasil yang tepat, termasuk empty state.
- [x] Ke-10 kategori muncul di navbar langsung dari database.
- [x] Load More / pagination tidak menghasilkan error di console.
- [x] Halaman nyaman dipakai di lebar 360px, 768px, dan 1440px.
- [x] Semua halaman bisa dinavigasi dengan keyboard saja.
- [x] Tidak ada ikon kosong atau gambar rusak.
