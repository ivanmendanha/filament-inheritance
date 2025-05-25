<?php

namespace App\Filament\Resources;

use App\Filament\Forms\VehicleForm;
use App\Filament\Resources\TruckResource\Pages;
use App\Filament\Tables\VehicleTable;
use App\Models\Truck;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TruckResource extends Resource
{
    protected static ?string $model = Truck::class;

    protected static ?string $navigationIcon = 'mdi-truck-outline';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema(VehicleForm::getTruckForm())
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(VehicleTable::getTruckTable())
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrucks::route('/'),
            'create' => Pages\CreateTruck::route('/create'),
            'edit' => Pages\EditTruck::route('/{record}/edit'),
        ];
    }
}
