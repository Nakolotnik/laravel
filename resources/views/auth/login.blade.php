@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <div class="card bg-dark text-light border-secondary">
        <div class="card-body p-4">
            <h3 class="mb-4 text-center">Авторизация</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.perform') }}">
                @csrf
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control form-control-dark bg-dark text-light border-secondary" id="login" name="login" required autofocus style="--bs-body-color: #fff;">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control form-control-dark bg-dark text-light border-secondary" id="password" name="password" required style="--bs-body-color: #fff;">
                </div>

                <button type="submit" class="btn btn-outline-light w-100">Войти</button>
            </form>
        </div>
    </div>
</div>
@endsection