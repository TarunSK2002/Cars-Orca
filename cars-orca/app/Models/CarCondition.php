<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarCondition extends Model
{
    protected $fillable = [
        'car_id',
        'engine_condition',
        'transmission_condition',
        'body_condition',
        'paint_condition',
        'interior_condition',
        'electrical_system',
        'tyre_condition',
        'ac_condition',
        'brake_system',
        'suspension_condition',
        'overall_notes',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
