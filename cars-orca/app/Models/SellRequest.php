<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellRequest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'car_details',
        'message',
        'status',
    ];
}
