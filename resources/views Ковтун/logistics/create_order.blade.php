@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="bg-white p-4 p-md-5 rounded shadow-sm">
            <h3 class="mb-4">Регистрация заказа</h3>

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
                    <label for="full_name" class="form-label visually-hidden">ФИО клиента</label>
                    <input type="text" name="full_name" id="full_name" class="form-control form-control-lg" placeholder="ФИО клиента" required>
                </div>

                <div class="mb-3">
                    <label for="contact_info" class="form-label visually-hidden">Контактная информация</label>
                    <input type="text" name="contact_info" id="contact_info" class="form-control form-control-lg" placeholder="Контактная информация" required>
                </div>

                <div class="mb-3">
                    <label for="cargo_description" class="form-label visually-hidden">Описание груза</label>
                    <input type="text" name="cargo_description" id="cargo_description" class="form-control form-control-lg" placeholder="Описание груза" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col">
                        <label for="cargo_volume" class="form-label visually-hidden">Объем (м³)</label>
                        <input type="number" step="0.1" name="cargo_volume" id="cargo_volume" class="form-control form-control-lg" placeholder="Объем (м³)" required>
                    </div>
                    <div class="col">
                        <label for="cargo_weight" class="form-label visually-hidden">Масса (кг)</label>
                        <input type="number" step="0.1" name="cargo_weight" id="cargo_weight" class="form-control form-control-lg" placeholder="Масса (кг)" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="delivery_level" class="form-label visually-hidden">Доступный уровень доставки</label>
                    <input type="text" name="delivery_level" id="delivery_level" class="form-control form-control-lg" placeholder="Уровень доставки" required>
                </div>

                <div class="mb-3">
                    <label for="payment_amount" class="form-label visually-hidden">Сумма оплаты</label>
                    <input type="number" step="0.01" name="payment_amount" id="payment_amount" class="form-control form-control-lg" placeholder="Сумма оплаты" required>
                </div>

                <div class="mb-3">
                    <label for="contract_terms" class="form-label visually-hidden">Условия договора</label>
                    <textarea name="contract_terms" id="contract_terms" class="form-control form-control-lg" placeholder="Условия договора" required rows="3"></textarea>
                </div>

                <div class="mb-4">
                    <label for="route_sheet_id" class="form-label visually-hidden">Маршрутный лист</label>
                    <select name="route_sheet_id" id="route_sheet_id" class="form-select form-select-lg" required>
                        <option value="">Выберите маршрут</option>
                        @foreach($routeSheets as $sheet)
                            <option value="{{ $sheet->id_route_sheet }}">
                                №{{ $sheet->id_route_sheet }} — {{ $sheet->departure_point }} → {{ $sheet->destination_point }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary btn-lg w-100">Зарегистрировать</button>
            </form>
        </div>
    </div>
</div>
@endsection