@props(['title', 'films', 'href' => null, 'icon' => null])

@if ($films->isNotEmpty())
    <section {{ $attributes->class('sf-row sf-reveal') }}>
        <div class="sf-row__header">
            <h2 class="sf-row__title">
                @if ($icon)<i class="bi bi-{{ $icon }} me-1" aria-hidden="true"></i>@endif
                {{ $title }}
            </h2>
            <div class="d-flex align-items-center gap-2">
                @if ($href)
                    <a href="{{ $href }}" class="sf-row__more">Lihat semua <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                @endif
                <button type="button" class="sf-row__nav d-none d-lg-inline-grid" data-row-scroll="-1" aria-label="Geser ke kiri"><i class="bi bi-chevron-left" aria-hidden="true"></i></button>
                <button type="button" class="sf-row__nav d-none d-lg-inline-grid" data-row-scroll="1" aria-label="Geser ke kanan"><i class="bi bi-chevron-right" aria-hidden="true"></i></button>
            </div>
        </div>

        <div class="sf-row__track" data-row-track>
            @foreach ($films as $film)
                <x-film-card :film="$film" class="sf-row__item" />
            @endforeach
        </div>
    </section>
@endif
