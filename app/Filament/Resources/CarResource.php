<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Models\Car;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Split;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'mdi-car-outline';
    protected static ?int $navigationSort = 2;

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
                            TextInput::make('doors')
                                ->label('Number of Doors')
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(5)
                                ->default(4)
                                ->placeholder('Enter number of doors'),
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
                TextColumn::make('doors')
                    ->label('Number of Doors')
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
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
