<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book - MindSpark</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/manage.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col">
                <h2>Add New Book</h2>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('manage.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="NamaBuku" class="form-label">Book Title</label>
                                <input type="text" class="form-control" id="NamaBuku" name="NamaBuku" required>
                            </div>

                            <div class="mb-3">
                                <label for="penulis" class="form-label">Author</label>
                                <input type="text" class="form-control" id="penulis" name="penulis" required>
                            </div>

                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Publisher</label>
                                <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Description</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Categories</label>
                                <div class="row">
                                    @foreach($kategoris as $kategori)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="kategoris[]" value="{{ $kategori->id }}" 
                                                       id="kategori{{ $kategori->id }}">
                                                <label class="form-check-label" for="kategori{{ $kategori->id }}">
                                                    {{ $kategori->NamaKategori }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="CoverBuku" class="form-label">Book Cover</label>
                                <input type="file" class="form-control" id="CoverBuku" name="CoverBuku" 
                                       accept="image/jpeg,image/png,image/jpg" required>
                                <div class="form-text">Max size: 2MB. Formats: JPG, JPEG, PNG</div>
                            </div>
                            <div class="mt-3" id="imagePreview" style="display: none;">
                                <img src="" alt="Preview" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('manage') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image preview
        document.getElementById('CoverBuku').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.querySelector('img').src = e.target.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindSpark</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/manage.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col">
                <h2>Add New Book</h2>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('manage.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="NamaBuku" class="form-label">Book Title</label>
                                <input type="text" class="form-control" id="NamaBuku" name="NamaBuku" required>
                            </div>

                            <div class="mb-3">
                                <label for="penulis" class="form-label">Author</label>
                                <input type="text" class="form-control" id="penulis" name="penulis" required>
                            </div>

                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Publisher</label>
                                <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Description</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Categories</label>
                                <div class="row">
                                    @foreach($kategoris as $kategori)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="kategoris[]" value="{{ $kategori->id }}" 
                                                       id="kategori{{ $kategori->id }}">
                                                <label class="form-check-label" for="kategori{{ $kategori->id }}">
                                                    {{ $kategori->NamaKategori }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="CoverBuku" class="form-label">Book Cover</label>
                                <input type="file" class="form-control" id="CoverBuku" name="CoverBuku" 
                                       accept="image/jpeg,image/png,image/jpg" required>
                                <div class="form-text">Max size: 2MB. Formats: JPG, JPEG, PNG</div>
                            </div>
                            <div class="mt-3" id="imagePreview" style="display: none;">
                                <img src="" alt="Preview" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('manage') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image preview
        document.getElementById('CoverBuku').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.querySelector('img').src = e.target.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>