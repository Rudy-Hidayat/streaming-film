@props(['kategori' => null, 'href' => null, 'active' => false])

<a href="{{ $href ?? route('films.kategori', $kategori) }}"
   {{ $attributes->class(['sf-chip', 'is-active' => $active]) }}
   @if ($active) aria-current="page" @endif>
    {{ $slot->isEmpty() ? $kategori->nama_kategori : $slot }}
</a>
