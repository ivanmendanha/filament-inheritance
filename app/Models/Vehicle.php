<?php

namespace App\Models;

use App\Enums\Brand;
use App\Enums\VehicleType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vehicle extends Model
{
    protected $fillable = ['brand', 'model', 'year'];

    protected $casts = [
        'brand' => Brand::class,
    ];

    protected $appends = ['type'];

    public function type(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->car()->exists() ? VehicleType::Car : ($this->truck()->exists() ? VehicleType::Truck : VehicleType::Unknown),
        );
    }

    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }

    public function truck(): HasOne
    {
        return $this->hasOne(Truck::class);
    }
}
