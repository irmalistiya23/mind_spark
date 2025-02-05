@extends('layouts.master')

@section('content')
<style>
    .category-card {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        padding: 15px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        margin-bottom: 20px;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .category-icon {
        font-size: 24px;
        margin-right: 15px;
        color: white;
    }

    .book-card {
        background: linear-gradient(135deg, #3b82f6, #2dd4bf);
        color: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.3s ease;
        height: 100%;
    }
    
    .book-card:hover {
        transform: translateY(-5px);
    }

    .book-title {
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .book-author {
        opacity: 0.9;
        font-size: 0.9rem;
    }

    .search-container {
        position: relative;
        margin-bottom: 30px;
    }

    .search-input {
        padding: 15px 20px;
        border-radius: 25px;
        border: 2px solid #e2e8f0;
        width: 100%;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        outline: none;
    }

    .section-title {
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 30px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(to right, #6366f1, #8b5cf6);
        border-radius: 3px;
    }
</style>

<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold">Explore Our Collection</h1>
    
    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" 
               class="search-input" 
               placeholder="Search for categories and books..." 
               id="searchKategori">
    </div>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- Categories Section -->
    <h2 class="section-title">Categories</h2>
    <div class="row">
        @foreach ($kategoris as $index => $kategori)
            <div class="col-md-4">
                <div class="category-card d-flex align-items-center">
                    <i class="fas fa-bookmark category-icon"></i>
                    <div>
                        <h3 class="mb-0 fs-5">{{ $kategori->NamaKategori }}</h3>
                        <small class="text-white-50">Explore books →</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Featured Books Section -->
    <h2 class="section-title mt-5">Featured Books</h2>
    <div class="row g-4">
        @foreach ($bukus as $buku)
            <div class="col-md-4">
                <div class="book-card">
                    <div class="book-cover mb-3">
                        <img src="{{ $buku->cover_url ?? 'https://via.placeholder.com/150' }}" 
                             alt="Book cover" 
                             class="img-fluid rounded">
                    </div>
                    <h5 class="book-title">{{ $buku->NamaBuku }}</h5>
                    <p class="book-author mb-2">
                        <i class="fas fa-user-edit me-2"></i>
                        {{ $buku->penulis }}
                    </p>
                    <button class="btn btn-light btn-sm mt-2">Read More</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
