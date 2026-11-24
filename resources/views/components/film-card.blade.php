@props(['film'])

<a href="{{ route('films.show', $film->id) }}" {{ $attributes->class('sf-card') }}>
    <div class="sf-card__poster">
        <img src="{{ $film->poster_src }}" alt="Poster {{ $film->judul }}" loading="lazy"
             onerror="this.onerror=null; this.src='{{ asset('images/no-poster.svg') }}'">
        <span class="sf-card__rating"><i class="bi bi-star-fill" aria-hidden="true"></i> {{ $film->rating }}</span>
        <span class="sf-card__play" aria-hidden="true"><i class="bi bi-play-fill"></i></span>
    </div>
    <h3 class="sf-card__title">{{ $film->judul }}</h3>
    <p class="sf-card__meta">{{ $film->tahun_rilis }} · {{ $film->durasi }} mnt</p>
</a>
