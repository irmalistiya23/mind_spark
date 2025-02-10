<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindSpark</title>
</head>
<body>
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <form action="{{ $action ?? request()->url() }}" method="GET" class="d-flex gap-2">
                @foreach(request()->except(['search', 'page']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                
                <input type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="{{ $placeholder ?? 'What book are looking for?...' }}"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>

            <h2>Category</h2>
            <ul class="list-unstyled">
                @foreach($kategoris as $kategori)
                    <li class="mb-2">
                        <a href="{{ route('kategori', ['kategori_id' => $kategori->KategoriID]) }}" 
                        class="btn btn-outline-primary {{ request('kategori_id') == $kategori->KategoriID ? 'active' : '' }}">
                            {{ $kategori->NamaKategori }}
                        </a>
                    </li>
                @endforeach
            </ul>
            
        </div>
    </div>
</body>
</html>