<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #1c1c1c;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background: #ffffff;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
        }
        .user-avatar {
            width: 50px;
            height: 50px;
            background: #c0c0c0;
            border-radius: 50%;
            margin: 10px auto;
        }
        .sidebar a {
            color: black;
            font-weight: 500;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #f0f0f0;
        }
        main {
            margin-left: 250px;
            padding: 20px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="text-center">
            <i class="bi bi-image"></i> Logo
        </div>
        <div class="text-center">
            <div class="user-avatar"></div>
            <strong>Username</strong>
        </div>
        <hr>
        <a href="{{ route('account') }}" class="d-block {{ request()->is('account') ? 'active' : '' }}" class="d-block">
            <i class="bi bi-person"></i> Account
        </a>
        <a href="{{ route('home') }}" class="d-block {{ request()->is('home') ? 'active' : '' }}">
            <i class="bi bi-house"></i> Home
        </a>
        <a href="{{ route('favorite') }}" class="d-block {{ request()->is('favorite') ? 'active' : '' }}" class="d-block">
            <i class="bi bi-star"></i> Favorites
        </a>
        <a href="{{ route('chatcs') }}" class="d-block {{ request()->is('chatcs') ? 'active' : '' }}" class="d-block">
            <i class="bi bi-chat"></i> Chat CS
        </a>
    </div>

    <main>
        @yield('konten')
    </main>

</body>
</html>
