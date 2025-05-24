<?php

namespace App\Enums;


use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum VehicleType: string implements HasLabel, HasIcon, HasColor
{
    case Car = 'car';
    case Truck = 'truck';
    case Unknown = 'unknown';

    public function getLabel(): string
    {
        return match ($this) {
            self::Car => 'Car',
            self::Truck => 'Truck',
            self::Unknown => 'Unknown',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Car => 'info',
            self::Truck => 'secondary',
            self::Unknown => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Car => 'mdi-car-outline',
            self::Truck => 'mdi-truck-outline',
            self::Unknown => 'mdi-close-circle-outline',
        };
    }
}
