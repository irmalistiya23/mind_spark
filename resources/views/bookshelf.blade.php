@extends('master')

@section('konten')
<link rel="stylesheet" href="{{ asset('css/bookshelf.css') }}">

<div class="container mt-4">
    <h1>Rak Bukumu</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Buku yang Dipinjam --}}
    <div class="section borrowed-section">
        <h2>Buku yang Dipinjam</h2>
        <div class="row">
            @forelse($borrowedBooks as $pinjam)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        @if($pinjam->buku->CoverBuku)
                            <img src="{{ asset('storage/cover_buku/' . $pinjam->buku->CoverBuku) }}" class="card-img-top" alt="{{ $pinjam->buku->NamaBuku }}">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center" style="height:200px; background-color: #f0f0f0;">
                                Gambar Tidak Tersedia
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $pinjam->buku->NamaBuku }}</h5>
                            <p class="card-text">Status: {{ ucfirst($pinjam->StatusPeminjaman) }}</p>
                            <p class="card-text">Tanggal Pinjam: {{ $pinjam->TanggalPeminjaman }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada buku yang dipinjam.</p>
            @endforelse
        </div>
    </div>

    {{-- Buku yang Dikembalikan --}}
    <div class="section returned-section">
        <h2>Buku yang Dikembalikan</h2>
        <div class="row">
            @forelse($returnedBooks as $pinjam)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        @if($pinjam->buku->CoverBuku)
                            <img src="{{ asset('storage/cover_buku/' . $pinjam->buku->CoverBuku) }}" class="card-img-top" alt="{{ $pinjam->buku->NamaBuku }}">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center" style="height:200px; background-color: #f0f0f0;">
                                Gambar Tidak Tersedia
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $pinjam->buku->NamaBuku }}</h5>
                            <p class="card-text">Status: {{ ucfirst($pinjam->StatusPeminjaman) }}</p>
                            <p class="card-text">Tanggal Pinjam: {{ $pinjam->TanggalPeminjaman }}</p>
                            <p class="card-text">Tanggal Kembali: {{ $pinjam->TanggalPengembalian }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada buku yang dikembalikan.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
