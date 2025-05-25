<?php

namespace App\Models;

use App\Enums\VehicleType;

class Truck extends Vehicle
{
    protected $table = 'vehicles';

    protected static function booted()
    {
        static::addGlobalScope('onlyCars', function ($query) {
            $query->where('type', VehicleType::Truck->value);
        });
    }
}
