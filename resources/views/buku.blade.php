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
            </div>
        </div>

        <!-- Detail Buku -->
        <div class="col-md-8">
                <div class="book-details">
                    <h1>{{ $buku->NamaBuku }}</h1>
                    
                    <div class="book-meta mb-4">
                        <p class="author mb-2">
                            <strong>{{ $buku->penulis }}</strong>
                        </p>
                        <div class="categories mb-3">
                            @foreach($buku->kategoris as $kategori)
                                <span class="badge bg-primary me-1">{{ $kategori->NamaKategori }}</span>
                            @endforeach
                        </div>
                        <p class="publisher mb-2">
                            {{ $buku->deskripsi }}
                        </p><br>
                        <p class="publish-date mb-2">
                            <h4>Rating</h4>
                        </p>
                    </div>

                    <!-- Setelah judul buku, tambahkan rating -->
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

                    <!-- Bagian ulasan -->
                    <div class="reviews mt-5">
                        <h4>Reviews ({{ $buku->reviews_count }})</h4>
                        
                        @if($buku->ulasans->count() > 0)
                            <div class="review-container">
                                <!-- Review pertama selalu muncul -->
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
                                        <small class="text-muted">
                                            {{ $buku->ulasans->first()->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <div class="review-content mt-2">
                                        {{ $buku->ulasans->first()->Ulasan }}
                                    </div>
                                </div>

                                <!-- Container untuk review tambahan -->
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
                                                <small class="text-muted">
                                                    {{ $ulasan->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                            <div class="review-content mt-2">
                                                {{ $ulasan->Ulasan }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Tombol Show More jika ada lebih dari 1 review -->
                                @if($buku->ulasans->count() > 1)
                                    <div class="text-center mt-3">
                                        <button class="btn btn-link show-more-btn">
                                            Show More
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-muted">
                                No reviews yet. Be the first to review this book!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Cover Buku -->
            <div class="col-md-4">
                <div class="book-cover-container position-relative">
                    <!-- Tombol Favorit -->
                    <form action="{{ route('favorites.toggle', ['action' => auth()->user()->favorites->contains('BukuID', $buku->id) ? 'remove' : 'add', 'bukuId' => $buku->id]) }}" method="POST" class="position-absolute top-0 end-0 p-2">
                        @csrf
                        <button type="submit" class="btn border-0 bg-transparent">
                            <i class="bi bi-star{{ auth()->user()->favorites->contains('BukuID', $buku->id) ? '-fill' : '' }} fs-3 text-warning" aria-hidden="true"></i>
                        </button>
                    </form>
        
                    @if($buku->CoverBuku)
                        <img src="{{ asset('storage/cover_buku/' . $buku->CoverBuku) }}" 
                             alt="{{ $buku->NamaBuku }}" 
                             class="img-fluid rounded shadow">
                    @else
                        <div class="no-image p-5 bg-light text-center rounded">
                            No Image Available
                        </div>
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
