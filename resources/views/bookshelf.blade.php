@extends('master')
@section('konten')
    <div class="container mt-4">
        <h1>Your Borrowed Books</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            @foreach($peminjaman as $pinjam)
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
                            <p class="card-text">Status: {{ $pinjam->StatusPeminjaman }}</p>
                            <p class="card-text">Borrowed on: {{ $pinjam->TanggalPeminjaman }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
