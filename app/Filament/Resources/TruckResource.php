<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TruckResource\Pages;
use App\Models\Truck;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
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
                Split::make([
                    Section::make()
                        ->relationship('vehicle')
                        ->schema(VehicleResource::getFormFields()),
                    Section::make()
                        ->schema([
                            Hidden::make('vehicle_id'),
                            TextInput::make('load_capacity')
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->placeholder('Enter load capacity in tons'),
                        ])
                ])
                ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('vehicle.brand')
                    ->label('Brand'),
                TextColumn::make('vehicle.model')
                    ->label('Model'),
                TextColumn::make('vehicle.year')
                    ->label('Year')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('load_capacity')
                    ->label('Load Capacity (tons)')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListTrucks::route('/'),
            'create' => Pages\CreateTruck::route('/create'),
            'edit' => Pages\EditTruck::route('/{record}/edit'),
        ];
    }
}
