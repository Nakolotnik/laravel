<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Система логистики</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .form-control-dark::placeholder { color: #adb5bd; }
      .form-control-dark:-ms-input-placeholder { color: #adb5bd; }
      .form-control-dark::-ms-input-placeholder { color: #adb5bd; }
    </style>
</head>
<body class="bg-dark text-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-black mb-4 border-bottom border-secondary">
        <div class="container">
            <a class="navbar-brand" href="/">Логистика</a>
            @auth
            <form method="POST" action="{{ route('logout') }}" class="d-flex ms-auto">
                @csrf
                <button class="btn btn-sm btn-outline-warning">Выйти</button>
            </form>
            @endauth
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>