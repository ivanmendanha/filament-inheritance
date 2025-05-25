<?php

namespace App\Models;

use App\Enums\Brand;
use App\Enums\VehicleType;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['brand', 'model', 'year', 'doors', 'load_capacity', 'type'];

    protected $casts = [
        'brand' => Brand::class,
        'type' => VehicleType::class,
    ];
}
