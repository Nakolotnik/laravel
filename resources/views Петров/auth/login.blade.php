@extends('layouts.app')

@section('content')
<div style="width: 300px; margin: 50px auto; padding: 20px; border: 1px solid #ccc;">
    <h3>Авторизация</h3>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.perform') }}">
        @csrf
        <div style="margin-bottom: 10px;">
            <label for="login">Логин</label><br>
            <input type="text" id="login" name="login" required autofocus style="width: 100%;">
        </div>

        <div style="margin-bottom: 10px;">
            <label for="password">Пароль</label><br>
            <input type="password" id="password" name="password" required style="width: 100%;">
        </div>

        <button type="submit" style="width: 100%; padding: 8px;">Войти</button>
    </form>
</div>
@endsection