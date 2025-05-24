<?php

namespace App\Models;

use App\Enums\BrandEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    protected $fillable = ['vehicle_id', 'doors'];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
