@extends('master')
@section('konten')
<!DOCTYPE html>
<html lang="en">

    <link rel="stylesheet" href="{{ asset('css/buku.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="book-cover-container">
                    <form action="{{ route('favorites.toggle', ['action' => auth()->user()->favorites->contains('BukuID', $buku->id) ? 'remove' : 'add', 'bukuId' => $buku->id]) }}" method="POST" class="favorite-btn">
                        @csrf
                        <button type="submit" class="btn border-0 bg-transparent">
                            <i class="bi bi-star{{ auth()->user()->favorites->contains('BukuID', $buku->id) ? '-fill' : '' }} fs-3 text-warning" aria-hidden="true"></i>
                        </button>
                    </form>
                
                    @if($buku->CoverBuku)
                        <img src="{{ asset('storage/cover_buku/' . $buku->CoverBuku) }}" alt="{{ $buku->NamaBuku }}" class="img-fluid">
                    @else
                        <div class="no-image p-5 bg-light text-center rounded">No Image Available</div>
                    @endif
                </div>
            </div>
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
                        <div class="mt-3">
                            @if($isBorrowed)
                                <button type="button" class="btn btn-secondary" disabled>Borrowed</button>
                            @else
                                <form id="borrowForm" action="{{ route('borrow', $buku->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" id="borrowButton" class="btn btn-success">Borrow</button>
                                </form>
                            @endif
                        </div>
                
                        <!-- Modal Pop-up -->
                        <div class="modal fade" id="borrowModal" tabindex="-1" aria-labelledby="borrowModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="borrowModalLabel">Book Successfully Borrowed</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                You have successfully borrowed the book.
                              </div>
                              <div class="modal-footer">
                                <button type="button" id="checkBookshelf" class="btn btn-primary">Check Bookshelf</button>
                                <button type="button" id="okButton" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                              </div>
                            </div>
                          </div>
                        </div>
                                    
                        <h4>Rating</h4>
                    </div>
                    <div class="book-actions mt-4">
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
        </div>

            <!-- Book List -->
        <h3 class="mt-5">Other Books</h3>
        <div class="row mt-3">
            @foreach($otherBooks as $buku)
                <div class="col-6 col-md-3 mb-4">
                    <div class="other-book-item">
                        <div class="other-book-cover-container">
                            <a href="{{ route('buku.show', $buku->id) }}">
                                <img src="{{ asset('storage/cover_buku/' . $buku->CoverBuku) }}" 
                                    alt="{{ $buku->NamaBuku }}" 
                                    class="img-fluid rounded shadow">
                            </a>
                        </div>
                        <div class="book-info">
                            <h5 class="book-title">{{ $buku->NamaBuku }}</h5>
                            <p class="book-author">{{ $buku->penulis }}</p>    
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>

    



</body>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // Jika buku belum dipinjam, tambahkan event listener pada form
            const borrowForm = document.getElementById('borrowForm');
            if(borrowForm){
                const borrowButton = document.getElementById('borrowButton');
                const modalElement = document.getElementById('borrowModal');
                const borrowModal = new bootstrap.Modal(modalElement, { keyboard: false });

                borrowForm.addEventListener('submit', function(e){
                    e.preventDefault();
                    fetch(borrowForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success){
                            // Ubah tombol menjadi 'Borrowed', ganti warna dan nonaktifkan
                            borrowButton.textContent = 'Borrowed';
                            borrowButton.classList.remove('btn-success');
                            borrowButton.classList.add('btn-secondary');
                            borrowButton.disabled = true;
                            // Tampilkan modal pop-up
                            borrowModal.show();
                        } else {
                            // Jika terjadi error atau buku sudah dipinjam (meski seharusnya tidak terjadi), tampilkan pesan error
                            alert(data.message || 'An error occurred.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            }

            // Tombol untuk menuju Bookshelf
            document.getElementById('checkBookshelf').addEventListener('click', function(){
                window.location.href = "{{ route('bookshelf') }}";
            });
        });
    
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