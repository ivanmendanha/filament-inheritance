<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Enums\VehicleType;
use App\Filament\Resources\CarResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCar extends CreateRecord
{
    protected static string $resource = CarResource::class;

    public function create(bool $another = false): void
    {
        $this->data['type'] = VehicleType::Car->value;

        parent::create($another);
    }
}
