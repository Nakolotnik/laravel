@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Админская панель</h2>
    <hr>
    <div>
        <h4>Всего транспортных средств: <strong>{{ $totalVehicles }}</strong></h4>
    </div>
    <div>
        <h4>ТС в ремонте: <strong>{{ $vehiclesInRepair }}</strong></h4>
    </div>
    <div>
        <h4>Активных заказов: <strong>{{ $activeOrders }}</strong></h4>
    </div>
    <div>
        <h4>Пользователи системы: <strong>{{ $usersCount }}</strong></h4>
    </div>
    <div>
        <h4>ТО просрочено/ожидается: <strong>{{ $maintenanceDue }}</strong></h4>
    </div>
</div>
@endsection