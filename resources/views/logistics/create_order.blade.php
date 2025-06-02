@extends('layouts.app')

@section('content')
<h3 class="mb-4 text-light">Регистрация клиента и создание заказа</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('logistics.storeClientOrder') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">ФИО клиента</label>
        <input type="text" name="full_name" class="form-control bg-dark text-light border-secondary" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Контактная информация</label>
        <input type="text" name="contact_info" class="form-control bg-dark text-light border-secondary" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Описание груза</label>
        <input type="text" name="cargo_description" class="form-control bg-dark text-light border-secondary" required>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label class="form-label">Объем (м³)</label>
            <input type="number" step="0.1" name="cargo_volume" class="form-control bg-dark text-light border-secondary" required>
        </div>
        <div class="col">
            <label class="form-label">Масса (кг)</label>
            <input type="number" step="0.1" name="cargo_weight" class="form-control bg-dark text-light border-secondary" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Доступный уровень доставки</label>
        <input type="text" name="delivery_level" class="form-control bg-dark text-light border-secondary" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Сумма оплаты</label>
        <input type="number" step="0.01" name="payment_amount" class="form-control bg-dark text-light border-secondary" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Условия договора</label>
        <textarea name="contract_terms" class="form-control bg-dark text-light border-secondary" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Маршрутный лист</label>
        <select name="route_sheet_id" class="form-select bg-dark text-light border-secondary" required>
            <option value="">Выберите маршрут</option>
            @foreach($routeSheets as $sheet)
                <option value="{{ $sheet->id_route_sheet }}">
                    №{{ $sheet->id_route_sheet }} — {{ $sheet->departure_point }} → {{ $sheet->destination_point }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-outline-primary">Зарегистрировать</button>
</form>
@endsection