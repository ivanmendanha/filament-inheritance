<?php

namespace App\Filament\Forms;

use App\Enums\Brand;
use App\Enums\VehicleType;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;

class VehicleForm
{
    /**
     * Returns the base form fields for vehicles.
     *
     * @return array
     */
    public static function getBaseForm(): array
    {
        return [
            Select::make('brand')
                ->options(Brand::class)
                ->required()
                ->label('Brand'),
            TextInput::make('model')
                ->required()
                ->maxLength(255)
                ->label('Model'),
            Select::make('year')
                ->options(self::getYears())
                ->required()
                ->label('Year'),
        ];
    }

    /**
     * Returns the years from 1950 to the current year.
     *
     * @return array
     */
    private static function getYears(): array
    {
        $years = range(date('Y'), 1950);
        return array_combine($years, $years);
    }

    /**
     * Returns the form schema for vehicles.
     *
     * @return array
     */
    public static function getVehicleForm(): array
    {
        return [
            ...self::getBaseForm(),
            Select::make('type')
                ->options(VehicleType::class)
                ->label('Type')
                ->required()
                ->disabledOn('edit')
                ->live(),
            Select::make('doors')
                ->label('Number of Doors')
                ->options([
                    2 => '2 Doors',
                    4 => '4 Doors',
                    5 => '5 Doors',
                ])
                ->default(4)
                ->required()
                ->visible(fn (Get $get) => $get('type') === VehicleType::Car->value),
            TextInput::make('load_capacity')
                ->required()
                ->numeric()
                ->minValue(1)
                ->placeholder('Enter load capacity in tons')
                ->label('Load Capacity (tons)')
                ->suffix('tons')
                ->visible(fn (Get $get) => $get('type') === VehicleType::Truck->value),
        ];
    }

    /**
     * Returns the form schema for cars.
     *
     * @return array
     */
    public static function getCarForm(): array
    {
        return [
            ...self::getBaseForm(),
            Hidden::make('type'),
            Select::make('doors')
                ->label('Number of Doors')
                ->options([
                    2 => '2 Doors',
                    4 => '4 Doors',
                    5 => '5 Doors',
                ])
                ->default(4)
                ->required()
            ,
        ];
    }

    /**
     * Returns the form schema for trucks.
     *
     * @return array
     */
    public static function getTruckForm(): array
    {
        return [
            ...self::getBaseForm(),
            Hidden::make('type'),
            TextInput::make('load_capacity')
                ->required()
                ->numeric()
                ->minValue(1)
                ->placeholder('Enter load capacity in tons')
                ->label('Load Capacity (tons)')
                ->suffix('tons'),
        ];
    }
}
