<?php

namespace App\Filament\Resources\TruckResource\Pages;

use App\Enums\VehicleType;
use App\Filament\Resources\TruckResource;
use App\Filament\Resources\VehiclesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTruck extends CreateRecord
{
    protected static string $resource = TruckResource::class;

    public function create(bool $another = false): void
    {
        $this->data['type'] = VehicleType::Truck->value;

        parent::create($another);
    }
}
