@extends('layouts.main')

@section('title', 'Beranda')

@section('hero')
    @if ($hero)
        <section class="sf-hero" aria-labelledby="hero-title">
            <div class="sf-hero__bg" style="background-image: url('{{ $hero->poster_src }}')" aria-hidden="true"></div>

            <div class="container sf-hero__content sf-reveal">
                <div class="row align-items-center g-5">
                    <div class="col-lg-7">
                        <span class="sf-hero__eyebrow"><i class="bi bi-fire" aria-hidden="true"></i> Rating tertinggi</span>

                        @if ($hero->kategoris->isNotEmpty())
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach ($hero->kategoris as $kategori)
                                    <x-genre-chip :kategori="$kategori" />
                                @endforeach
                            </div>
                        @endif

                        <h1 id="hero-title" class="sf-hero__title">{{ $hero->judul }}</h1>

                        <ul class="sf-meta mb-3">
                            <li><i class="bi bi-star-fill sf-meta__star" aria-hidden="true"></i> {{ $hero->rating }}</li>
                            <li><i class="bi bi-calendar3" aria-hidden="true"></i> {{ $hero->tahun_rilis }}</li>
                            <li><i class="bi bi-clock" aria-hidden="true"></i> {{ $hero->durasi }} menit</li>
                        </ul>

                        <p class="sf-hero__desc">{{ Str::limit($hero->deskripsi, 200) }}</p>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('films.show', $hero->id) }}#player" class="btn btn-primary btn-lg">
                                <i class="bi bi-play-fill me-1" aria-hidden="true"></i> Tonton Sekarang
                            </a>
                            <a href="{{ route('films.show', $hero->id) }}" class="btn btn-sf-ghost btn-lg">
                                <i class="bi bi-info-circle me-1" aria-hidden="true"></i> Detail
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 offset-lg-1 d-none d-lg-block">
                        <img src="{{ $hero->poster_src }}" alt="Poster {{ $hero->judul }}" class="sf-hero__poster">
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('content')
    @if (! $hero)
        <div class="sf-empty">
            <i class="bi bi-film" aria-hidden="true"></i>
            <h1 class="h5">Belum ada film</h1>
            <p class="text-muted mb-0">Jalankan <code>php artisan db:seed</code> untuk mengisi data film.</p>
        </div>
    @endif

    <x-film-row title="Rating Tertinggi" icon="fire" :films="$topRated" :href="route('films.index', ['sort' => 'rating'])" />
    <x-film-row title="Rilis Terbaru" icon="stars" :films="$latest" :href="route('films.index', ['sort' => 'terbaru'])" />

    @foreach ($kategoris as $kategori)
        <x-film-row :title="$kategori->nama_kategori" :films="$kategori->films" :href="route('films.kategori', $kategori)" />
    @endforeach
@endsection
