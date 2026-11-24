@extends('layouts.main')

@section('title', $film->judul)

@section('hero')
    <section class="sf-hero sf-hero--detail" aria-labelledby="film-title">
        <div class="sf-hero__bg" style="background-image: url('{{ $film->poster_src }}')" aria-hidden="true"></div>

        <div class="container sf-hero__content">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-7 col-sm-5 col-md-4 col-lg-3 mx-auto mx-md-0">
                    <img src="{{ $film->poster_src }}" alt="Poster {{ $film->judul }}" class="sf-hero__poster">
                </div>

                <div class="col-md-8 col-lg-9">
                    <h1 id="film-title" class="sf-hero__title">{{ $film->judul }}</h1>

                    <ul class="sf-meta mb-3">
                        <li><i class="bi bi-star-fill sf-meta__star" aria-hidden="true"></i> {{ $film->rating }}</li>
                        <li><i class="bi bi-calendar3" aria-hidden="true"></i> {{ $film->tahun_rilis }}</li>
                        <li><i class="bi bi-clock" aria-hidden="true"></i> {{ $film->durasi }} menit</li>
                    </ul>

                    @if ($film->kategoris->isNotEmpty())
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @foreach ($film->kategoris as $kategori)
                                <x-genre-chip :kategori="$kategori" />
                            @endforeach
                        </div>
                    @endif

                    <p class="sf-hero__desc">{{ $film->deskripsi }}</p>

                    <a href="#player" class="btn btn-primary btn-lg">
                        <i class="bi bi-play-fill me-1" aria-hidden="true"></i> Tonton
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="row g-4 mb-5 sf-reveal">
        {{-- Player --}}
        <div class="col-lg-8">
            <h2 class="sf-section-title" id="player">Tonton Film</h2>

            @if ($film->video_url)
                <div class="ratio ratio-16x9 sf-player">
                    <video controls preload="metadata" poster="{{ $film->poster_src }}">
                        <source src="{{ $film->video_url }}">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                </div>
            @else
                <div class="ratio ratio-16x9 sf-player sf-player--empty">
                    <div>
                        <div class="sf-player__bg" style="background-image: url('{{ $film->poster_src }}')" aria-hidden="true"></div>
                        <div class="sf-player__message">
                            <i class="bi bi-camera-video-off" aria-hidden="true"></i>
                            <p class="h5 mb-1">Video belum tersedia</p>
                            <p class="text-muted mb-0">Film ini belum bisa ditonton. Coba lagi nanti.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="col-lg-4">
            <h2 class="sf-section-title">Info Film</h2>

            <div class="sf-panel">
                @if ($film->detailFilm)
                    <dl class="sf-info">
                        <dt>Sutradara</dt>
                        <dd>{{ $film->detailFilm->direktur }}</dd>
                        <dt>Pemain</dt>
                        <dd>{{ $film->detailFilm->pemain }}</dd>
                        <dt>Bahasa</dt>
                        <dd>{{ $film->detailFilm->bahasa }}</dd>
                        <dt>Subtitle</dt>
                        <dd>{{ $film->detailFilm->subtitle }}</dd>
                    </dl>
                @else
                    <p class="text-muted mb-0">Detail film tidak tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <x-film-row title="Film Serupa" :films="$recommendations" />
@endsection
