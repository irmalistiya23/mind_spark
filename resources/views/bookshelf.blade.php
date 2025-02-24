@extends('master')

@section('konten')
<link rel="stylesheet" href="{{ asset('css/bookshelf.css') }}">

    <div class="container mt-4">
        <h1>Your Bookshelf</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Borrowed Books --}}
        <div class="section borrowed-section">
            <h2>Borrowed Books</h2>
            <div class="row">
                @forelse($borrowedBooks as $pinjam)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            @if($pinjam->buku->CoverBuku)
                                <img src="{{ asset('storage/cover_buku/' . $pinjam->buku->CoverBuku) }}" class="card-img-top" alt="{{ $pinjam->buku->NamaBuku }}">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center" style="height:200px; background-color: #f0f0f0;">
                                    No Image Available
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $pinjam->buku->NamaBuku }}</h5>
                                <p class="card-text">Status: {{ ucfirst($pinjam->StatusPeminjaman) }}</p>
                                <p class="card-text">Borrowed on: {{ $pinjam->TanggalPeminjaman }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No books currently borrowed.</p>
                @endforelse
            </div>
        </div>

        {{-- Returned Books --}}
        <div class="section returned-section">
            <h2>Returned Books</h2>
            <div class="row">
                @forelse($returnedBooks as $pinjam)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            @if($pinjam->buku->CoverBuku)
                                <img src="{{ asset('storage/cover_buku/' . $pinjam->buku->CoverBuku) }}" class="card-img-top" alt="{{ $pinjam->buku->NamaBuku }}">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center" style="height:200px; background-color: #f0f0f0;">
                                    No Image Available
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $pinjam->buku->NamaBuku }}</h5>
                                <p class="card-text">Status: {{ ucfirst($pinjam->StatusPeminjaman) }}</p>
                                <p class="card-text">Borrowed on: {{ $pinjam->TanggalPeminjaman }}</p>
                                <p class="card-text">Returned on: {{ $pinjam->TanggalPengembalian }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No books returned yet.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
