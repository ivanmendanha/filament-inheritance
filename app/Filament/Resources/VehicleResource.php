<?php

namespace App\Filament\Resources;

use App\Filament\Forms\VehicleForm;
use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Tables\VehicleTable;
use App\Models\Vehicle;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'mdi-car-multiple';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Vehicle Details')
                    ->schema(VehicleForm::getVehicleForm())
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(VehicleTable::getVehicleTable())
            ->filters([
            ])
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
