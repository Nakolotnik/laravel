@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Вход в систему</h3>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.perform') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="login" class="form-label fw-bold">Логин:</label>
                            <input type="text" class="form-control" id="login" name="login" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Пароль:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection