<!DOCTYPE html>
<html>
<head>
    <title>Film Kategori: {{ $kategori->Nama_Kategori }}</title>
</head>
<body>
    <h1>Film Kategori: {{ $kategori->Nama_Kategori }}</h1>
    @foreach ($kategori->films as $film)
        <div>
            <h2>{{ $film->Judul }}</h2>
            <p>{{ $film->Deskripsi }}</p>
            <img src="{{ $film->Poster_URL }}" alt="{{ $film->Judul }}" width="200">
            <a href="{{ route('films.show', $film->Film_ID) }}">Detail</a>
        </div>
    @endforeach
</body>
</html>
