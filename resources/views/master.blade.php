<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css')}}">
</head>
<body>
    <div class="sidebar">
        <div class="text-center">
            <i class="bi bi-image"></i> Logo
        </div>
        <div class="text-center">
            <strong>{{ Auth::user()->nama }}</strong>
        </div>
        <hr>
        <a href="{{ route('account') }}" class="d-block {{ request()->is('account') ? 'active' : '' }}" class="d-block">
            <i class="bi bi-person icon-custom"></i> Account
        </a>
        <a href="{{ route('kategori') }}" class="d-block {{ request()->is('kategori') ? 'active' : '' }}">
            <i class="bi bi-house icon-custom"></i> Home
        </a>
        <a href="{{ route('favorite') }}" class="d-block {{ request()->is('favorite') ? 'active' : '' }}" class="d-block">
            <i class="bi bi-star icon-custom"></i> Favorites
        </a>
        <a href="/chatify" class="d-block {{ request()->is('chatify') ? 'active' : '' }}">
            <i class="bi bi-chat icon-custom"></i> Chat CS
        </a>

    </div>

    <main>
        @yield('konten')
    </main>

</body>
</html>
