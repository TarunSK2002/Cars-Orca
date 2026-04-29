<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'car_id',
        'message',
        'status',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
