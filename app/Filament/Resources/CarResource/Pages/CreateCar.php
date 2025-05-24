<?php

namespace App\Filament\Resources\CarResource\Pages;

use App\Filament\Resources\CarResource;
use App\Filament\Resources\VehiclesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCar extends CreateRecord
{
    protected static string $resource = CarResource::class;

    public function create(bool $another = false): void
    {
        $data = $this->data['vehicle'];
        $vehicle = VehiclesResource::createVehicleForm(
            brand: $data['brand'],
            model: $data['model'],
            year: $data['year'],
        );

        $this->data['vehicle_id'] = $vehicle->id;

        parent::create($another);
    }
}
