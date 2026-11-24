@foreach ($films as $film)
    <div class="col">
        <x-film-card :film="$film" />
    </div>
@endforeach
