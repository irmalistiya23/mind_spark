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
    <style>
        body {
            background-color: #1c1c1c;
            font-family: "Poppins", serif;
            font-weight: 500;
            font-style: normal;
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
            border-radius: 50%;
            margin: 10px auto;
        }
        .icon-custom {
            font-size: 24px;
            color: #000000; /* Warna biru */
            margin-right: 10px; /* Spasi antara ikon dan teks */
        }
        .sidebar a {
            color: black;
            font-weight: 500;
            text-decoration: none;
            display: block;
            padding: 15px;
            border-radius: 10px;
        }
        .sidebar a:hover {
            background-color: #f0f0f0;
        }

        .text-center{
            margin-bottom: 10px
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
            <img src="{{ Auth::user()->foto_url }}"
                alt="User Avatar"
                class="user-avatar img-fluid rounded-circle">
        </div>
        <div class="text-center">
            <strong>{{ Auth::user()->nama }}</strong>
        </div>
        <hr>
        <a href="{{ route('account') }}" class="d-block {{ request()->is('account') ? 'active' : '' }}" class="d-block">
            <i class="bi bi-person icon-custom"></i> Account
        </a>
        <a href="{{ route('home') }}" class="d-block {{ request()->is('home') ? 'active' : '' }}">
            <i class="bi bi-house icon-custom"></i> Home
        </a>
        <a href="{{ route('favorite') }}" class="d-block {{ request()->is('favorite') ? 'active' : '' }}" class="d-block">
            <i class="bi bi-star icon-custom"></i> Favorites
        </a>
        <a href="{{ route('chatcs') }}" class="d-block {{ request()->is('chatcs') ? 'active' : '' }}" class="d-block">
            <i class="bi bi-chat icon-custom"></i> Chat CS
        </a>
    </div>

    <main>
        @yield('konten')
    </main>

</body>
</html>
