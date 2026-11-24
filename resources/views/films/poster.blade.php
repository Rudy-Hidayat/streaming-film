@php
    $lineHeight = $fontSize * 1.08;
    $titleBottom = 470;
    $titleTop = $titleBottom - $lineHeight * (count($lines) - 1);
@endphp
<svg xmlns="http://www.w3.org/2000/svg" width="400" height="600" viewBox="0 0 400 600" role="img" aria-label="Poster {{ $film->judul }}">
    <defs>
        <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0" stop-color="hsl({{ $hue }}, 65%, 42%)"/>
            <stop offset=".55" stop-color="hsl({{ ($hue + 35) % 360 }}, 55%, 18%)"/>
            <stop offset="1" stop-color="#0b0d12"/>
        </linearGradient>
        <radialGradient id="glow" cx=".75" cy=".25" r=".6">
            <stop offset="0" stop-color="hsl({{ ($hue + 180) % 360 }}, 80%, 65%)" stop-opacity=".45"/>
            <stop offset="1" stop-color="hsl({{ ($hue + 180) % 360 }}, 80%, 65%)" stop-opacity="0"/>
        </radialGradient>
        <linearGradient id="fade" x1="0" y1="0" x2="0" y2="1">
            <stop offset=".45" stop-color="#0b0d12" stop-opacity="0"/>
            <stop offset="1" stop-color="#0b0d12" stop-opacity=".9"/>
        </linearGradient>
    </defs>

    <rect width="400" height="600" fill="url(#bg)"/>
    <rect width="400" height="600" fill="url(#glow)"/>
    <circle cx="300" cy="170" r="120" fill="none" stroke="#fff" stroke-opacity=".12" stroke-width="2"/>
    <circle cx="300" cy="170" r="80" fill="none" stroke="#fff" stroke-opacity=".08" stroke-width="2"/>
    <rect width="400" height="600" fill="url(#fade)"/>

    <g font-family="Poppins, 'Segoe UI', Arial, sans-serif" fill="#fff">
        <text x="368" y="56" font-size="15" font-weight="700" letter-spacing="3" fill-opacity=".75" text-anchor="end">STREAMFILM</text>
        <rect x="328" y="68" width="40" height="3" fill="#e50914"/>

        @foreach ($lines as $i => $line)
            <text x="32" y="{{ round($titleTop + $i * $lineHeight) }}" font-size="{{ $fontSize }}" font-weight="700">{{ $line }}</text>
        @endforeach

        <text x="32" y="{{ $titleBottom + 44 }}" font-size="18" font-weight="500" fill-opacity=".75">{{ $film->tahun_rilis }}@if ($film->kategoris->isNotEmpty()) · {{ $film->kategoris->pluck('nama_kategori')->take(2)->join(' · ') }}@endif</text>
    </g>
</svg>
