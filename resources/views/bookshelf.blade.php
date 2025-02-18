@extends('master')
@section('konten')
@section('content')
<div class="container">
@foreach ($bukus as $buku)
    <div class="book-item">
        <h3>{{ $buku->NamaBuku }}</h3>
        <p>{{ $buku->penulis }}</p>
        <p>Status: {{ $buku->status }}</p>
    </div>
@endforeach
</div>



@endsection