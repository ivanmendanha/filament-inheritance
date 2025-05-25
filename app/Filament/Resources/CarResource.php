<?php

namespace App\Filament\Resources;

use App\Filament\Forms\VehicleForm;
use App\Filament\Resources\CarResource\Pages;
use App\Filament\Tables\VehicleTable;
use App\Models\Car;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'mdi-car-outline';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Car Details')
                    ->schema(VehicleForm::getCarForm())
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(VehicleTable::getCarTable())
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
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
