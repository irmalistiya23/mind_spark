@extends('master')
@section('konten')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>MindSpark</title>
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-4 align-items-center">
            <!-- Search Bar -->
            <div class="col-md-4 text-end">
                <div class="search-container">
                    <form action="{{ $action ?? request()->url() }}" method="GET" class="search-form">
                        @foreach(request()->except(['search', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <div class="search-wrapper d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="What book are you looking for...." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div><br>
            <!-- Kategori -->
            <div class="col-md-8">
                <div class="category-container mb-4">
                    <h2 class="category-title">Category</h2>
                    <div class="category-list d-flex flex-wrap gap-2">
                        <a href="{{ route('kategori') }}" 
                           class="btn btn-outline-primary {{ !request('KategoriID') ? 'active' : '' }}">
                            All Categories
                        </a>
                        @foreach($kategoris as $kategori)
                            <a href="{{ route('kategori', ['KategoriID' => $kategori->id]) }}" 
                               class="btn btn-outline-primary {{ request('KategoriID') == $kategori->id ? 'active' : '' }}">
                                {{ $kategori->NamaKategori }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Daftar Buku -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @forelse($bukus as $buku)
            <div class="col">
                <div class="book-card h-100">
                    <a href="{{ route('buku.show', $buku->id) }}" class="text-decoration-none">
                        @if($buku->CoverBuku)
                            <img src="{{ asset('storage/cover_buku/' . $buku->CoverBuku) }}" 
                                 alt="{{ $buku->NamaBuku }}" 
                                 class="book-cover">
                        @else
                            <div class="no-image">No Image Available</div>
                        @endif
                        <div class="book-info">
                            <h5 class="book-title">{{ $buku->NamaBuku }}</h5>
                            <p class="book-author">{{ $buku->penulis }}</p>
                            <p class="book-category">
                                Categories: 
                                @foreach($buku->kategoris as $kategori)
                                    <span class="badge bg-primary">{{ $kategori->NamaKategori }}</span>
                                @endforeach
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No books found.
                </div>
            </div>
            @endforelse
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html></html>
@endsection