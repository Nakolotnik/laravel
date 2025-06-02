<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_client', 'id_employee', 'id_cargo',
        'id_delivery_status', 'creation_date',
        'id_contract', 'id_route_sheet', 'id_payment'
    ];

    public function client() { return $this->belongsTo(Client::class, 'id_client'); }
    public function employee() { return $this->belongsTo(Employee::class, 'id_employee'); }
    public function cargo() { return $this->belongsTo(Cargo::class, 'id_cargo'); }
    public function status() { return $this->belongsTo(DeliveryStatus::class, 'id_delivery_status'); }
    public function contract() { return $this->belongsTo(Contract::class, 'id_contract'); }
    public function routeSheet() { return $this->belongsTo(RouteSheet::class, 'id_route_sheet'); }
    public function payment() { return $this->belongsTo(Payment::class, 'id_payment'); }
}
