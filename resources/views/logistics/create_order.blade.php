@extends('layouts.app')

@section('content')
<h3>Регистрация клиента и создание заказа</h3>

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
        <label>ФИО клиента</label>
        <input type="text" name="full_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Контактная информация</label>
        <input type="text" name="contact_info" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Описание груза</label>
        <input type="text" name="cargo_description" class="form-control" required>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label>Объем (м³)</label>
            <input type="number" step="0.1" name="cargo_volume" class="form-control" required>
        </div>
        <div class="col">
            <label>Масса (кг)</label>
            <input type="number" step="0.1" name="cargo_weight" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label>Доступный уровень доставки</label>
        <input type="text" name="delivery_level" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Сумма оплаты</label>
        <input type="number" step="0.01" name="payment_amount" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Условия договора</label>
        <textarea name="contract_terms" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Маршрутный лист</label>
        <select name="route_sheet_id" class="form-control" required>
            <option value="">Выберите маршрут</option>
            @foreach($routeSheets as $sheet)
                <option value="{{ $sheet->id_route_sheet }}">
                    №{{ $sheet->id_route_sheet }} — {{ $sheet->departure_point }} → {{ $sheet->destination_point }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Зарегистрировать</button>
</form>
@endsection
