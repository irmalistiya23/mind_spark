
@extends('master')

@section('konten')


<div class="container mt-4">
    <h1>Your Favorite Books</h1>
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
</div>
@endsection