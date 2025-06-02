@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Обзор системы</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
        <div class="col">
            <div class="card h-100 border-primary shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-primary">Всего ТС</h6>
                    <p class="card-text display-4 fw-bold">{{ $totalVehicles }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 border-danger shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-danger">ТС в ремонте</h6>
                    <p class="card-text display-4 fw-bold">{{ $vehiclesInRepair }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 border-success shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-success">Активные заказы</h6>
                    <p class="card-text display-4 fw-bold">{{ $activeOrders }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 border-info shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-info">Пользователи</h6>
                    <p class="card-text display-4 fw-bold">{{ $usersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 border-warning shadow-sm">
                <div class="card-body text-center">
                    <h6 class="card-title text-warning">Ожидает ТО</h6>
                    <p class="card-text display-4 fw-bold">{{ $maintenanceDue }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection