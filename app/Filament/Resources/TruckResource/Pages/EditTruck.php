<?php

namespace App\Filament\Resources\TruckResource\Pages;

use App\Filament\Resources\TruckResource;
use App\Models\Truck;
use App\Models\Vehicle;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditTruck extends EditRecord
{
    protected static string $resource = TruckResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        try {
            DB::beginTransaction();

            $vehicle = Vehicle::find($record->vehicle_id);

            $vehicle->fill([
                'brand' => $data['brand'],
                'model' => $data['model'],
                'year' => $data['year'],
            ])->save();

            $truck = Truck::find($record->id);

            $truck->fill([
                'vehicle_id' => $vehicle->id,
                'load_capacity' => $data['load_capacity'],
            ])->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->halt();
        }

        return $truck;
    }
}
