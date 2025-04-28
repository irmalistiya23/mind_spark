@extends('master')
@section('konten')
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>MindSpark</title>
</head>

<body>
    <div class="container mt-12">
        <div class="row mb-4 align-items-center">
            <!-- Search Bar -->
            <div class="col-md-12 text-end">
                <div class="search-container search-bar">
                    <form action="{{ $action ?? request()->url() }}" method="GET" class="search-form">
                        @foreach(request()->except(['search', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <div class="search-wrapper d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Buku apa yang anda cari...." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div><br>
            <!-- Kategori -->
            <div class="col-md-12">
                <div class="category-container mb-4">
                    <h2 class="category-title">Kategori</h2>
                    <div class="category-list d-flex flex-wrap gap-2">
                        <a href="{{ route('kategori') }}" 
                           class="btn btn-outline-primary {{ !request('KategoriID') ? 'active' : '' }}">
                           Semua Kategori
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
                            <div class="no-image">Gambar tidak tersedia</div>
                        @endif
                        <div class="book-info">
                            <h5 class="book-title">{{ $buku->NamaBuku }}</h5>
                            <p class="book-author">{{ $buku->penulis }}</p>
                            <p class="book-category">
                                Kategori: 
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
                    Buku tidak ditemukan.
                </div>
            </div>
            @endforelse
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html></html>
@endsection