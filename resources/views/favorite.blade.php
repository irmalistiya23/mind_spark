@extends('master')

@section('konten')

<link rel="stylesheet" href="{{ asset('css/bookshelf.css') }}">

<div class="container mt-4 text-center">
    <h1>Your Favorite Books</h1>

    @if($favorites->isEmpty())
        <div class="empty-state">
            <p>You haven't favored any books yet</p>
            <a href="{{ route('kategori') }}" class="btn btn-light">
                Find books <i class="bi bi-plus-circle"></i>
            </a>
        </div>
    @else
        <div class="row">
            @foreach($favorites as $favorite)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ asset('storage/cover_buku/' . $favorite->buku->CoverBuku) }}" class="card-img-top" alt="{{ $favorite->buku->NamaBuku }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorite->buku->NamaBuku }}</h5>
                            <p class="card-text">{{ $favorite->buku->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
