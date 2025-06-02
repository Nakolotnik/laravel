<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetricsReport extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_report';
    protected $fillable = ['report_date', 'total_volume_ton_km', 'total_cost', 'avg_cost_per_ton_km'];
}
