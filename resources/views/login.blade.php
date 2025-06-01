<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/login.css') }}">
</head>
<body>

<div class="login-container">
    <h2>Авторизация</h2>

    @if(session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login') }}" method="POST">
    @csrf

    <div class="form-control">
        <label for="login">Логин</label>
        <input type="text" id="login" name="login" placeholder="Введите логин" required>
    </div>

    <div class="form-control">
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" placeholder="Введите пароль" required>
    </div>

    <button type="submit" class="btn">Войти</button>
</form>

</div>

</body>
</html>
