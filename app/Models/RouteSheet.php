<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RouteSheet extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_route_sheet';
    protected $fillable = ['id_vehicle', 'assignment_date', 'departure_point', 'destination_point', 'distance_km', 'estimated_time'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id_vehicle');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_route_sheet');
    }
}
