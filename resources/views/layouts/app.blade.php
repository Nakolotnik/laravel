<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Система логистики</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Логистика</a>
            <form method="POST" action="{{ route('logout') }}" class="d-flex ms-auto">
                @csrf
                <button class="btn btn-sm btn-outline-light">Выйти</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
