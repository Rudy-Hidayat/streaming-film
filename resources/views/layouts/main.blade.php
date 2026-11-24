<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Streaming Film') · StreamFilm</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a href="#konten" class="sf-skip-link">Lewati ke konten</a>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg sf-navbar" data-bs-theme="dark" aria-label="Navigasi utama">
        <div class="container">
            <a class="sf-brand me-lg-4" href="{{ route('home') }}">
                <span class="sf-brand__icon"><i class="bi bi-play-fill" aria-hidden="true"></i></span>
                <span>Stream<span class="sf-brand__accent">Film</span></span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sfNavOffcanvas" aria-controls="sfNavOffcanvas" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end sf-offcanvas" tabindex="-1" id="sfNavOffcanvas" aria-labelledby="sfNavOffcanvasLabel">
                <div class="offcanvas-header">
                    <h2 class="offcanvas-title fs-5" id="sfNavOffcanvasLabel">Menu</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
                </div>

                <div class="offcanvas-body align-items-lg-center">
                    {{-- Search --}}
                    <form class="sf-search order-lg-2 ms-lg-auto mb-3 mb-lg-0" action="{{ route('films.index') }}" method="GET" role="search">
                        <i class="bi bi-search" aria-hidden="true"></i>
                        <input class="form-control" type="search" name="q" value="{{ request('q') }}" placeholder="Cari film…" aria-label="Cari film">
                    </form>

                    {{-- Menu --}}
                    <ul class="navbar-nav order-lg-1 gap-lg-1">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('films.index', 'films.show') ? 'active' : '' }}" href="{{ route('films.index') }}" @if (request()->routeIs('films.index')) aria-current="page" @endif>Jelajahi</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('films.kategori') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Kategori
                            </a>
                            <div class="dropdown-menu sf-mega">
                                <div class="sf-mega__grid">
                                    @forelse ($navKategoris as $navKategori)
                                        <a class="dropdown-item {{ request()->route('kategori')?->id === $navKategori->id ? 'active' : '' }}" href="{{ route('films.kategori', $navKategori) }}">
                                            {{ $navKategori->nama_kategori }}
                                        </a>
                                    @empty
                                        <span class="dropdown-item-text text-muted">Belum ada kategori</span>
                                    @endforelse
                                </div>
                            </div>
                        </li>
                    </ul>

                    {{-- Akun --}}
                    <div class="order-lg-3 ms-lg-3 mt-3 mt-lg-0">
                        <button type="button" class="btn btn-sf-ghost" disabled title="Fitur login segera hadir">
                            <i class="bi bi-person-circle me-1" aria-hidden="true"></i> Masuk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- KONTEN --}}
    <main id="konten" tabindex="-1">
        @yield('hero')

        <div class="container mt-4">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="sf-footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5">
                    <a class="sf-brand mb-3" href="{{ route('home') }}">
                        <span class="sf-brand__icon"><i class="bi bi-play-fill" aria-hidden="true"></i></span>
                        <span>Stream<span class="sf-brand__accent">Film</span></span>
                    </a>
                    <p class="mb-0" style="max-width: 26rem;">
                        Tonton film favoritmu kapan saja. Jelajahi koleksi dari berbagai genre, mulai dari action hingga romance.
                    </p>
                </div>

                <div class="col-sm-7 col-lg-4">
                    <h2>Kategori</h2>
                    <ul class="sf-footer__links">
                        @foreach ($navKategoris->take(8) as $navKategori)
                            <li><a href="{{ route('films.kategori', $navKategori) }}">{{ $navKategori->nama_kategori }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-sm-5 col-lg-3">
                    <h2>Ikuti Kami</h2>
                    <div class="d-flex gap-2">
                        <a href="#" class="sf-social" aria-label="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                        <a href="#" class="sf-social" aria-label="X"><i class="bi bi-twitter-x" aria-hidden="true"></i></a>
                        <a href="#" class="sf-social" aria-label="Email"><i class="bi bi-envelope" aria-hidden="true"></i></a>
                        <a href="#" class="sf-social" aria-label="YouTube"><i class="bi bi-youtube" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <div class="sf-footer__bottom d-flex flex-column flex-sm-row justify-content-between gap-2">
                <span>&copy; {{ date('Y') }} StreamFilm. All rights reserved.</span>
                <span>Dibuat dengan Laravel</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
