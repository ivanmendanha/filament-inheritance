<?php

namespace App\Filament\Resources;

use App\Enums\Brand;
use App\Enums\VehicleType;
use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->schema(self::getFormFields())
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('brand')
                    ->label('Brand'),
                TextColumn::make('model')
                    ->label('Model'),
                TextColumn::make('year')
                    ->label('Year')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
            ])
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }

    public static function getTableColumns(): array
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

    public static function getFormFields(): array
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
            TextInput::make('year')
                ->required()
                ->numeric()
                ->maxLength(4)
                ->label('Year'),
            Select::make('type')
                ->options(VehicleType::class)
                ->disabled()
                ->visibleOn(['edit', 'view'])
                ->label('Type'),
        ];
    }

    public static function createVehicleForm(string $brand, string $model, string $year): Vehicle
    {
        return Vehicle::create([
            'brand' => $brand,
            'model' => $model,
            'year' => $year,
        ]);
    }
}
