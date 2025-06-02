@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-5 text-center display-5">Статистика системы</h2>

    <dl class="row gy-4">
        <dt class="col-sm-4 col-md-3 fs-5 text-muted">Всего транспортных средств</dt>
        <dd class="col-sm-8 col-md-9 fs-4 fw-bold text-primary">{{ $totalVehicles }}</dd>

        <dt class="col-sm-4 col-md-3 fs-5 text-muted">Транспортных средств в ремонте</dt>
        <dd class="col-sm-8 col-md-9 fs-4 fw-bold text-danger">{{ $vehiclesInRepair }}</dd>

        <dt class="col-sm-4 col-md-3 fs-5 text-muted">Активных заказов в системе</dt>
        <dd class="col-sm-8 col-md-9 fs-4 fw-bold text-success">{{ $activeOrders }}</dd>

        <dt class="col-sm-4 col-md-3 fs-5 text-muted">Зарегистрированных пользователей</dt>
        <dd class="col-sm-8 col-md-9 fs-4 fw-bold text-info">{{ $usersCount }}</dd>

        <dt class="col-sm-4 col-md-3 fs-5 text-muted">ТО просрочено или ожидается</dt>
        <dd class="col-sm-8 col-md-9 fs-4 fw-bold text-warning">{{ $maintenanceDue }}</dd>
    </dl>
</div>
@endsection