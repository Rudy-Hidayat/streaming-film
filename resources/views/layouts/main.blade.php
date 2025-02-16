<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Streaming Film')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    {{-- HEADER --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Streaming Film</a>
            <div class="d-flex">
                <a href="" class="btn btn-outline-light">Login</a>
            </div>
        </div>
    </nav>

    {{-- SUB-HEADER --}}
    <div class="bg-light py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <a href="" class="btn btn-secondary">Home</a>

                {{-- Dropdown Kategori --}}
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        Kategori
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Comedy</a></li>
                        <li><a class="dropdown-item" href="#">Fantasy</a></li>
                        <li><a class="dropdown-item" href="#">History</a></li>
                        <li><a class="dropdown-item" href="#">Horror</a></li>
                        <li><a class="dropdown-item" href="#">Melodrama</a></li>
                        <li><a class="dropdown-item" href="#">Romance</a></li>
                        <li><a class="dropdown-item" href="#">School</a></li>
                    </ul>
                </div>
            </div>

            {{-- Search Bar --}}
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Cari Film" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>

    {{-- KONTEN --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>About Me | Copyright © 2025</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#" class="text-white"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="#" class="text-white"><i class="fab fa-twitter"></i> X</a>
            <a href="#" class="text-white"><i class="fas fa-envelope"></i> Gmail</a>
            <a href="#" class="text-white"><i class="fab fa-youtube"></i> YouTube</a>
        </div>
    </footer>

</body>
</html>
