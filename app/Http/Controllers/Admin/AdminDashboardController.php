<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Order;
use App\Models\Maintenance;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $vehiclesInRepair = Vehicle::whereHas('status', fn($q) => $q->where('status_name', 'Неисправен'))->count();
        $activeOrders = Order::count();
        $usersCount = User::count();
        $maintenanceDue = Maintenance::whereDate('planned_date', '<=', now())->whereNull('completion_date')->count();

        return view('admin.dashboard', compact(
            'totalVehicles',
            'vehiclesInRepair',
            'activeOrders',
            'usersCount',
            'maintenanceDue'
        ));
    }
}
