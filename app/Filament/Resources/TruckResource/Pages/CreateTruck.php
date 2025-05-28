<?php

namespace App\Filament\Resources\TruckResource\Pages;

use App\Filament\Resources\TruckResource;
use App\Models\Truck;
use App\Models\Vehicle;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateTruck extends CreateRecord
{
    protected static string $resource = TruckResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        try {
            DB::beginTransaction();

            $vehicle = Vehicle::query()->create([
                'brand' => $data['brand'],
                'model' => $data['model'],
                'year' => $data['year'],
            ]);

            $truck = Truck::query()
                ->create([
                    'vehicle_id' => $vehicle->id,
                    'load_capacity' => $data['load_capacity'],
                ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->halt();
        }

        return $truck;
    }
}
