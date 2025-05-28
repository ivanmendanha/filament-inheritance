<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TruckDetails extends Vehicle
{
    protected $table = 'truck_details';

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
