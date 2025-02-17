@extends('master')
@section('konten')
<head>
    <link rel="stylesheet" href="{{ asset('css/buku.css') }}">
    <title>MindSpark</title>
</head>
<style>

</style>
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
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Detail Buku (60%) -->
            <div class="col-md-7">
                <div class="book-details">
                    <h1>{{ $buku->NamaBuku }}</h1>
                    <div class="book-meta mb-4">
                        <p class="author mb-2"><strong>{{ $buku->penulis }}</strong></p>
                        <div class="categories mb-3">
                            @foreach($buku->kategoris as $kategori)
                                <span class="badge bg-primary me-1">{{ $kategori->NamaKategori }}</span>
                            @endforeach
                        </div>
                        <p class="publisher mb-2">{{ $buku->deskripsi }}</p><br>
                        <h4>Rating</h4>
                    </div>

                    <!-- Tombol Borrow / Return -->
                    <div class="book-actions mt-4">
                        <form action="{{ route('borrowBook', $buku->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @if ($buku->peminjamanAktif)
                                <button type="submit" class="btn btn-warning">Kembalikan Buku</button>
                            @else
                                <button type="submit" class="btn btn-success">Pinjam Buku</button>
                            @endif
                        </form>
                    
                    </div>


                    <!-- Rating -->
                    <div class="book-rating mb-3">
                        <div class="stars">
                            @php
                                $rating = $buku->average_rating;
                                $fullStars = floor($rating);
                                $halfStar = $rating - $fullStars >= 0.5;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <i class="fas fa-star text-warning"></i>
                                @elseif($i == $fullStars + 1 && $halfStar)
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span class="rating-text ms-2">
                                {{ number_format($rating, 1) }} / 5.0
                                <span class="text-muted">({{ $buku->reviews_count }} reviews)</span>
                            </span>
                        </div>
                    </div>

                    <!-- Ulasan -->
                    <div class="reviews mt-5">
                        <h4>Reviews ({{ $buku->reviews_count }})</h4>
                        @if($buku->ulasans->count() > 0)
                            <div class="review-container">
                                <div class="review-item mb-4">
                                    <div class="review-header d-flex justify-content-between align-items-center">
                                        <div class="user-info">
                                            <strong>{{ $buku->ulasans->first()->user->name }}</strong>
                                            <div class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $buku->ulasans->first()->Rating)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-warning"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ $buku->ulasans->first()->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="review-content mt-2">{{ $buku->ulasans->first()->Ulasan }}</div>
                                </div>
                                <div class="additional-reviews" style="display: none;">
                                    @foreach($buku->ulasans->skip(1) as $ulasan)
                                        <div class="review-item mb-4">
                                            <div class="review-header d-flex justify-content-between align-items-center">
                                                <div class="user-info">
                                                    <strong>{{ $ulasan->user->name }}</strong>
                                                    <div class="rating">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $ulasan->Rating)
                                                                <i class="fas fa-star text-warning"></i>
                                                            @else
                                                                <i class="far fa-star text-warning"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{ $ulasan->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="review-content mt-2">{{ $ulasan->Ulasan }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($buku->ulasans->count() > 1)
                                    <div class="text-center mt-3">
                                        <button class="btn btn-link show-more-btn">Show More</button>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-muted">No reviews yet. Be the first to review this book!</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cover Buku (40%) -->
            <div class="col-md-5">
                <div class="book-cover-container position-relative">
                    <form action="{{ route('favorites.toggle', ['action' => auth()->user()->favorites->contains('BukuID', $buku->id) ? 'remove' : 'add', 'bukuId' => $buku->id]) }}" method="POST" class="position-absolute top-0 end-0 p-2 z-3">
                        @csrf
                        <button type="submit" class="btn border-0 bg-transparent">
                            <i class="bi bi-star{{ auth()->user()->favorites->contains('BukuID', $buku->id) ? '-fill' : '' }} fs-3 text-warning" aria-hidden="true"></i>
                        </button>
                    </form>
                    @if($buku->CoverBuku)
                        <img src="{{ asset('storage/cover_buku/' . $buku->CoverBuku) }}" alt="{{ $buku->NamaBuku }}" class="img-fluid rounded shadow">
                    @else
                        <div class="no-image p-5 bg-light text-center rounded">No Image Available</div>
                    @endif
                </div>
            </div>
        </div>
    </div>



</body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreBtn = document.querySelector('.show-more-btn');
            const additionalReviews = document.querySelector('.additional-reviews');
    
            if (showMoreBtn) {
                showMoreBtn.addEventListener('click', function() {
                    if (additionalReviews.style.display === 'none') {
                        additionalReviews.style.display = 'block';
                        showMoreBtn.textContent = 'Show Less';
                        additionalReviews.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    } else {
                        additionalReviews.style.display = 'none';
                        showMoreBtn.textContent = 'Show More';
                        document.querySelector('.reviews').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                });
            }
        });
        </script>
</html>
@endsection