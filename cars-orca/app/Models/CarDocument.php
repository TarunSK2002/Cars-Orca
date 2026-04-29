<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarDocument extends Model
{
    protected $fillable = [
        'car_id',
        'rc_book',
        'insurance',
        'pollution_certificate',
        'loan_status',
        'hypothecation',
        'status',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
