@extends('master')

@section('konten')
<link rel="stylesheet" href="{{ asset('css/loaning.css') }}">
<div class="container">
    <h2 class="mb-4 text-center">Book Loan List</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-white table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Book Title</th>
                    <th>Loan Date</th>
                    <th>Status</th>
                    <th>Return Date</th>
                    {{-- <th>Acttion</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->user->nama }}</td>
                        <td>{{ $item->buku->NamaBuku }}</td>
                        <td>{{ $item->TanggalPeminjaman }}</td>
                        <td>
                            <form action="{{ route('loaning.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="StatusPeminjaman" class="form-select" onchange="this.form.submit()">
                                    <option value="borrowed" {{ $item->StatusPeminjaman == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                                    <option value="returned" {{ $item->StatusPeminjaman == 'returned' ? 'selected' : '' }}>Returned</option>
                                </select>
                            </form>
                        </td>
                        <td>{{ $item->TanggalPengembalian }}</td>
    
                        {{-- <td>
                            <form action="{{ route('loaning.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
