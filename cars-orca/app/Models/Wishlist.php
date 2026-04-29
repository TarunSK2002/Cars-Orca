<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'car_id',
        'session_id',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
