@extends('layouts.main')

@php
    $pageTitle = $activeKategori ? 'Film ' . $activeKategori->nama_kategori : 'Jelajahi Film';
    // Parameter yang dibawa saat berpindah kategori
    $keep = array_filter(['q' => $q, 'sort' => $sort === 'rating' ? null : $sort]);
@endphp

@section('title', $q !== '' ? "Cari \"{$q}\"" : $pageTitle)

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">{{ $pageTitle }}</h1>
            @if ($q !== '')
                <p class="text-muted mb-0">
                    Hasil untuk "<span class="text-body">{{ $q }}</span>" · {{ $films->total() }} film
                    <a href="{{ url()->current() . ($sort !== 'rating' ? '?sort=' . $sort : '') }}" class="ms-2 small"><i class="bi bi-x-lg" aria-hidden="true"></i> Reset</a>
                </p>
            @else
                <p class="text-muted mb-0">{{ $films->total() }} film</p>
            @endif
        </div>

        <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-center gap-2">
            @if ($q !== '')
                <input type="hidden" name="q" value="{{ $q }}">
            @endif
            <label for="sort" class="text-muted small text-nowrap">Urutkan</label>
            <select id="sort" name="sort" class="form-select form-select-sm sf-select" onchange="this.form.submit()">
                @foreach ($sorts as $value => $label)
                    <option value="{{ $value }}" @selected($sort === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <noscript><button type="submit" class="btn btn-sm btn-sf-ghost">Terapkan</button></noscript>
        </form>
    </div>

    <nav class="sf-chip-list mb-4" aria-label="Kategori">
        <x-genre-chip :href="route('films.index', $keep)" :active="! $activeKategori">Semua</x-genre-chip>
        @foreach ($navKategoris as $kategori)
            <x-genre-chip :kategori="$kategori" :href="route('films.kategori', [$kategori] + $keep)" :active="$activeKategori?->id === $kategori->id" />
        @endforeach
    </nav>

    @if ($films->isEmpty())
        <div class="sf-empty">
            <i class="bi bi-film" aria-hidden="true"></i>
            <h2 class="h5">Film tidak ditemukan</h2>
            <p class="text-muted">
                @if ($q !== '')
                    Tidak ada film yang cocok dengan "{{ $q }}"{{ $activeKategori ? ' di kategori ' . $activeKategori->nama_kategori : '' }}.
                @else
                    Belum ada film di kategori ini.
                @endif
            </p>
            <a href="{{ route('films.index') }}" class="btn btn-primary">Lihat semua film</a>
        </div>
    @else
        <h2 class="visually-hidden">Daftar film</h2>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3 gy-4" id="film-grid">
            @include('films._grid')
        </div>

        @if ($films->hasMorePages())
            <div class="text-center mt-5">
                <button type="button" class="btn btn-sf-ghost px-4" data-load-more="#film-grid" data-next="{{ $films->nextPageUrl() }}">
                    Muat lebih banyak
                </button>
            </div>
        @endif
    @endif
@endsection
