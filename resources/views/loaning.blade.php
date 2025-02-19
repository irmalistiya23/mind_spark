@extends('master')

@section('konten')
<div class="container">
    <h2 class="mb-4">Daftar Peminjaman Buku</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Status</th>
                <th>Tanggal Pengembalian</th>
                <th>Aksi</th>
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

                    <td>
                        <form action="{{ route('loaning.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection