<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindSpark</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/manage.css') }}">
</head>
<body>
    <div class="container mt-4">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" id="users-tab" data-bs-toggle="tab" href="#users">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="books-tab" data-bs-toggle="tab" href="#books">Manage Books</a>
            </li>
        </ul>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Users Tab -->
            <div class="tab-pane fade show active" id="users">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>NIS</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->nis }}</td>
                                            <td>
                                                <form action="{{ route('manage.destroy', $user->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No users found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books Tab -->
            <div class="tab-pane fade" id="books">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('manage.books.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Book
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Cover</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th>Categories</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($books as $index => $book)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if($book->CoverBuku)
                                                    <img src="{{ asset('storage/cover_buku/' . $book->CoverBuku) }}" 
                                                         alt="Cover" 
                                                         style="height: 50px; width: auto;">
                                                @else
                                                    No Cover
                                                @endif
                                            </td>
                                            <td>{{ $book->NamaBuku }}</td>
                                            <td>{{ $book->penulis }}</td>
                                            <td>{{ $book->penerbit }}</td>
                                            <td>
                                                @foreach($book->kategoris as $kategori)
                                                    <span class="badge bg-primary">{{ $kategori->NamaKategori }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('manage.books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('manage.books.destroy', $book->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this book?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No books found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>