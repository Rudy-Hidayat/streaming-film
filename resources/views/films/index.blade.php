@extends('layouts.main')

@section('title', 'Daftar Film')

@section('content')
    <h2 class="text-center mb-4">Daftar Film</h2>

    <div class="row" id="film-container">
        @foreach ($films as $film)
            <div class="col-md-3 mb-4">
                <div class="card" onclick="window.location='{{ route('films.show', $film->id) }}'">
                    <img src="{{ $film->poster_url }}" class="card-img-top" alt="{{ $film->judul }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $film->judul }}</h5>
                        <p class="card-text text-muted">{{ $film->tahun_rilis }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Tombol Load More --}}
    @if ($films->hasMorePages())
        <div class="text-center mt-3">
            <button class="btn btn-primary" id="load-more">Load More</button>
        </div>
    @endif

    {{-- Script untuk Load More --}}
    <script>
        let page = 1;
        document.getElementById('load-more').addEventListener('click', function () {
            page++;
            fetch(`?page=${page}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('film-container').innerHTML += data;
                })
                .catch(error => console.log(error));
        });
    </script>
@endsection
