@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <h3>Регистрация клиента и создание заказа</h3>

    @if(session('success'))
        <div style="color: green; background-color: #e6ffe6; border: 1px solid green; padding: 10px; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="color: red; background-color: #ffe6e6; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('logistics.storeClientOrder') }}">
        @csrf
        <div style="margin-bottom: 10px;">
            <label for="full_name">ФИО клиента</label><br>
            <input type="text" name="full_name" id="full_name" style="width: 100%; padding: 5px;" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="contact_info">Контактная информация</label><br>
            <input type="text" name="contact_info" id="contact_info" style="width: 100%; padding: 5px;" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="cargo_description">Описание груза</label><br>
            <input type="text" name="cargo_description" id="cargo_description" style="width: 100%; padding: 5px;" required>
        </div>

        <div style="display: flex; gap: 10px; margin-bottom: 10px;">
            <div style="flex-grow: 1;">
                <label for="cargo_volume">Объем (м³)</label><br>
                <input type="number" step="0.1" name="cargo_volume" id="cargo_volume" style="width: 100%; padding: 5px;" required>
            </div>
            <div style="flex-grow: 1;">
                <label for="cargo_weight">Масса (кг)</label><br>
                <input type="number" step="0.1" name="cargo_weight" id="cargo_weight" style="width: 100%; padding: 5px;" required>
            </div>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="delivery_level">Доступный уровень доставки</label><br>
            <input type="text" name="delivery_level" id="delivery_level" style="width: 100%; padding: 5px;" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="payment_amount">Сумма оплаты</label><br>
            <input type="number" step="0.01" name="payment_amount" id="payment_amount" style="width: 100%; padding: 5px;" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="contract_terms">Условия договора</label><br>
            <textarea name="contract_terms" id="contract_terms" style="width: 100%; padding: 5px; min-height: 80px;" required></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="route_sheet_id">Маршрутный лист</label><br>
            <select name="route_sheet_id" id="route_sheet_id" style="width: 100%; padding: 8px;" required>
                <option value="">Выберите маршрут</option>
                @foreach($routeSheets as $sheet)
                    <option value="{{ $sheet->id_route_sheet }}">
                        №{{ $sheet->id_route_sheet }} — {{ $sheet->departure_point }} → {{ $sheet->destination_point }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer;">Зарегистрировать</button>
    </form>
</div>
@endsection