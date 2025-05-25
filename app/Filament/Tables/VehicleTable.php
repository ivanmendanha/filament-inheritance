<?php

namespace App\Filament\Tables;

use Filament\Tables\Columns\TextColumn;

class VehicleTable
{
    /**
     * Returns the base table columns for vehicles.
     *
     * @return array
     */
    public static function getBaseTableColumns(): array
    {
        return [
            TextColumn::make('brand')
                    ->label('Brand'),
            TextColumn::make('model')
                ->label('Model'),
            TextColumn::make('year')
                ->label('Year')
                ->sortable()
                ->searchable(),
        ];
    }

    /**
     * Returns the table schema for vehicles.
     *
     * @return array
     */
    public static function getVehicleTable(): array
    {
        return [
            ...self::getBaseTableColumns(),
            TextColumn::make('type')
        ];
    }

    /**
     * Returns the table schema for cars.
     *
     * @return array
     */
    public static function getCarTable(): array
    {
        return [
            ...self::getBaseTableColumns(),
            TextColumn::make('doors')
                ->label('Number of Doors')
                ->sortable()
                ->searchable(),
        ];
    }

    /**
     * Returns the table schema for trucks.
     *
     * @return array
     */
    public static function getTruckTable(): array
    {
        return [
            ...self::getBaseTableColumns(),
            TextColumn::make('load_capacity')
                ->label('Load capacity (tons)')
                ->sortable()
                ->searchable(),
        ];
    }
}
