@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Админская панель</h2>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Всего транспортных средств</h5>
                    <p class="card-text fs-3">{{ $totalVehicles }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-bg-danger">
                <div class="card-body">
                    <h5 class="card-title">ТС в ремонте</h5>
                    <p class="card-text fs-3">{{ $vehiclesInRepair }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5 class="card-title">Активных заказов</h5>
                    <p class="card-text fs-3">{{ $activeOrders }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card text-bg-info">
                <div class="card-body">
                    <h5 class="card-title">Пользователи системы</h5>
                    <p class="card-text fs-3">{{ $usersCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h5 class="card-title">ТО просрочено/ожидается</h5>
                    <p class="card-text fs-3">{{ $maintenanceDue }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
