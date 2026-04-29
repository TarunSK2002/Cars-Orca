<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'company',
        'model',
        'year_of_manufacture',
        'year_of_purchase',
        'registration_number',
        'owner_count',
        'km_driven',
        'fuel_type',
        'transmission',
        'color',
        'car_price',
        'broker_amount',
        'total_price',
        'status',
        'purchase_date',
        'sell_date',
        'description',
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class)->orderBy('sort_order', 'asc');
    }

    public function condition()
    {
        return $this->hasOne(CarCondition::class);
    }

    public function document()
    {
        return $this->hasOne(CarDocument::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }
}
