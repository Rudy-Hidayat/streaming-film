@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="row align-items-center">
        <!-- Poster -->
        <div class="col-md-2">
            <img src="{{ asset($film->poster_url) }}" alt="{{ $film->judul }}" class="img-fluid rounded shadow w-100">
        </div>

        <!-- Informasi Film -->
        <div class="col-md-10">
            <div class="p-2">
                <h4 class="mb-1">{{ $film->judul }}</h4>
                <p class="text-muted small">{{ $film->deskripsi }}</p>
                <ul class="list-unstyled fs-6">
                    <li><strong>Durasi:</strong> {{ $film->durasi }} menit</li>
                    <li><strong>Tahun Rilis:</strong> {{ $film->tahun_rilis }}</li>
                    <li><strong>Rating:</strong> {{ $film->rating }}</li>
                </ul>

                <h5 class="mt-3">Detail Film</h5>
                @if ($film->detailFilm)
                    <ul class="list-unstyled small">
                        <li><strong>Direktur:</strong> {{ $film->detailFilm->direktur }}</li>
                        <li><strong>Pemain:</strong> {{ $film->detailFilm->pemain }}</li>
                        <li><strong>Bahasa:</strong> {{ $film->detailFilm->bahasa }}</li>
                        <li><strong>Subtitle:</strong> {{ $film->detailFilm->subtitle }}</li>
                    </ul>
                @else
                    <p class="text-muted small">Detail film tidak tersedia.</p>
                @endif
            </div>
        </div>

    </div>

    <div class="row mt-3">
        <!-- Video Player -->
        <div class="col-md-8">
            <h6>Tonton Film</h6>
            <div class="ratio ratio-16x9 shadow rounded">
                <video controls>
                    <source src="{{ asset($film->url_film) }}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>
        </div>

        <!-- Film Rekomendasi -->
        <div class="col-md-4">
            <h6>Film Lainnya</h6>
            <div class="row g-1">
                @foreach($recommendations as $rec)
                    <div class="col-12">
                        <div class="card shadow-sm border-0 p-1">
                            <div class="row g-1 align-items-center">
                                <div class="col-3">
                                    <img src="{{ asset($rec->poster_url) }}" class="img-fluid rounded" alt="{{ $rec->judul }}">
                                </div>
                                <div class="col-9">
                                    <div class="card-body p-1">
                                        <h6 class="card-title text-truncate small m-0">{{ $rec->judul }}</h6>
                                        <p class="card-text text-muted small m-0">{{ $rec->tahun_rilis }}</p>
                                        <a href="{{ route('films.show', $rec->id) }}" class="btn btn-sm btn-primary mt-1">Tonton</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
