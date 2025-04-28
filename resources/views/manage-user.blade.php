@extends('master')
@section('konten')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/manage.css') }}">
<div class="container-fluid">
    <div class="row">
        <!-- Main content -->
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Kelola Pengguna</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger"
                                    onclick="confirmDelete('{{ route('manage-user.destroy', $user->id) }}', '{{ $user->nama }}')">
                                Hapus
                            </button>
                            

                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus <strong id="deleteUserName"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal')); // Inisialisasi modal di luar function

    function confirmDelete(url, name) {
        document.getElementById('deleteUserName').textContent = name;
        document.getElementById('deleteForm').action = url;
        deleteModal.show(); // Panggil modal tanpa inisialisasi ulang
    }
</script>


@endsection 