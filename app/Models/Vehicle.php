<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_vehicle';
    protected $fillable = ['model', 'license_plate', 'capacity_kg', 'id_status', 'gps_location'];

    public function status()
    {
        return $this->belongsTo(VehicleStatus::class, 'id_status');
    }

    public function routeSheets()
    {
        return $this->hasMany(RouteSheet::class, 'id_vehicle');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'id_vehicle');
    }

    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class, 'id_vehicle');
    }
}
