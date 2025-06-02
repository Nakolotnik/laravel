<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Система логистики</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 60px; font-family: sans-serif; }
        .navbar-simple {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar-simple a { text-decoration: none; color: #333; font-size: 1.2em; }
        .navbar-simple form { margin-left: auto; }
        .container-simple { padding: 20px; }
    </style>
</head>
<body>

    <div class="navbar-simple">
        <div style="display: flex; align-items: center; width: 100%;">
            <a href="/">Логистика</a>
            @auth
            <form method="POST" action="{{ route('logout') }}" style="margin-left: auto;">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">Выйти</button>
            </form>
            @endauth
        </div>
    </div>

    <div class="container-simple">
        @yield('content')
    </div>

</body>
</html>