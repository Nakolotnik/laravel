<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Смена пароля</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/change-password.css') }}">
</head>
<body>

<div class="password-change-container">
    <h1>Смена пароля</h1>

    @if(session('message'))
        <div class="success-message">{{ session('message') }}</div>
    @endif

    @if(session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form action="{{ route('password.change') }}" method="POST">
        @csrf

        <div class="form-control">
            <label for="password">Новый пароль</label>
            <input type="password" id="password" name="password" placeholder="Введите новый пароль" required>
        </div>

        <div class="form-control">
            <label for="password_confirmation">Подтверждение пароля</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Подтвердите новый пароль" required>
        </div>

        <button type="submit" class="btn">Изменить пароль</button>
    </form>
</div>

</body>
</html>
