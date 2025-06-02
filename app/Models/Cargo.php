<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_cargo';
    protected $fillable = ['description', 'volume', 'weight'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_cargo');
    }
}
