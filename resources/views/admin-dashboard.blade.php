<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>

    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>
<body>

<div class="dashboard-container">
    <h2>Панель администратора</h2>

    <div class="error-message" id="error-message"></div>
    <div class="success-message" id="success-message"></div>

    <form id="user-form">
        <div class="form-control">
            <label for="full-name">ФИО</label>
            <input type="text" id="full-name" name="full-name" required placeholder="Введите ФИО">
        </div>

        <div class="form-control">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" required placeholder="Введите логин">
        </div>

        <div class="form-control">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" placeholder="Введите пароль">
        </div>

        <div class="form-control">
            <label for="role">Роль</label>
            <select id="role" name="role">
                <option value="user">Пользователь</option>
                <option value="admin">Администратор</option>
            </select>
        </div>

        <button type="submit" class="btn" id="form-submit-button">Добавить пользователя</button>
    </form>

    <h3>Список пользователей</h3>
    <table id="user-table">
        <thead>
            <tr>
                <th>ФИО</th>
                <th>Логин</th>
                <th>Роль</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script src="{{ asset('js/admin-dashboard.js') }}"></script>

</body>
</html>
