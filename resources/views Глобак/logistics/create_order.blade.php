@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-light">
        <h3>Регистрация клиента и создание заказа</h3>
    </div>
    <div class="card-body">
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
            <fieldset class="mb-4 p-3 border rounded">
                <legend class="w-auto px-2 h6">Данные клиента</legend>
                <div class="mb-3">
                    <label for="full_name" class="form-label">ФИО клиента</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contact_info" class="form-label">Контактная информация</label>
                    <input type="text" name="contact_info" id="contact_info" class="form-control" required>
                </div>
            </fieldset>

            <fieldset class="mb-4 p-3 border rounded">
                <legend class="w-auto px-2 h6">Информация о грузе</legend>
                <div class="mb-3">
                    <label for="cargo_description" class="form-label">Описание груза</label>
                    <input type="text" name="cargo_description" id="cargo_description" class="form-control" required>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="cargo_volume" class="form-label">Объем (м³)</label>
                        <input type="number" step="0.1" name="cargo_volume" id="cargo_volume" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="cargo_weight" class="form-label">Масса (кг)</label>
                        <input type="number" step="0.1" name="cargo_weight" id="cargo_weight" class="form-control" required>
                    </div>
                </div>
            </fieldset>

            <fieldset class="mb-4 p-3 border rounded">
                <legend class="w-auto px-2 h6">Детали заказа</legend>
                <div class="mb-3">
                    <label for="delivery_level" class="form-label">Доступный уровень доставки</label>
                    <input type="text" name="delivery_level" id="delivery_level" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="payment_amount" class="form-label">Сумма оплаты</label>
                    <input type="number" step="0.01" name="payment_amount" id="payment_amount" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contract_terms" class="form-label">Условия договора</label>
                    <textarea name="contract_terms" id="contract_terms" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="route_sheet_id" class="form-label">Маршрутный лист</label>
                    <select name="route_sheet_id" id="route_sheet_id" class="form-control" required>
                        <option value="">Выберите маршрут</option>
                        @foreach($routeSheets as $sheet)
                            <option value="{{ $sheet->id_route_sheet }}">
                                №{{ $sheet->id_route_sheet }} — {{ $sheet->departure_point }} → {{ $sheet->destination_point }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </fieldset>

            <button class="btn btn-primary">Зарегистрировать</button>
        </form>
    </div>
</div>
@endsection