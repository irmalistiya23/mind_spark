@extends('master')
@section('konten')
@section('content')
<div class="container">
    <h2>Buku yang Sedang Dipinjam</h2>
    <div class="row">
        @foreach($booksOnLoan as $loan)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ asset('storage/'.$loan->buku->cover_image) }}" class="card-img-top" alt="{{ $loan->buku->judul }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $loan->buku->judul }}</h5>
                    {{-- <p class="card-text">Dipinjam pada: {{ $loan->TanggalPeminjaman->format('d M Y') }}</p> --}}
                    <p class="card-text">Status: Sedang Dipinjam</p>
                    <a href="{{ route('returnBook', $loan->buku->id) }}" class="btn btn-warning">Kembalikan Buku</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <h2>Riwayat Buku yang Sudah Dikembalikan</h2>
    <div class="row">
        @foreach($returnedBooks as $loan)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ asset('storage/'.$loan->buku->cover_image) }}" class="card-img-top" alt="{{ $loan->buku->judul }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $loan->buku->judul }}</h5>
                    {{-- <p class="card-text">Dipinjam pada: {{ $loan->TanggalPeminjaman->format('d M Y') }}</p>
                    <p class="card-text">Dikembalikan pada: {{ $loan->TanggalPengembalian->format('d M Y') }}</p> --}}
                    <p class="card-text">Status: Dikembalikan</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection