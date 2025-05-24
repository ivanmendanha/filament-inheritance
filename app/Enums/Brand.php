<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Brand: string implements HasLabel, HasIcon, HasColor
{
    case Toyota = 'toyota';
    case Ford = 'ford';
    case Honda = 'honda';
    case Chevrolet = 'chevrolet';
    case Nissan = 'nissan';
    case Volvo = 'volvo';
    case Scania = 'scania';
    case Mercedes = 'mercedes';
    case Iveco = 'iveco';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Toyota => 'Toyota',
            self::Ford => 'Ford',
            self::Honda => 'Honda',
            self::Chevrolet => 'Chevrolet',
            self::Nissan => 'Nissan',
            self::Volvo => 'Volvo',
            self::Scania => 'Scania',
            self::Mercedes => 'Mercedes',
            self::Iveco => 'Iveco',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Toyota => 'si-toyota',
            self::Ford => 'si-ford',
            self::Honda => 'si-honda',
            self::Chevrolet => 'si-chevrolet',
            self::Nissan => 'si-nissan',
            self::Volvo => 'si-volvo',
            self::Scania => 'si-scania',
            self::Mercedes => 'si-mercedes',
            self::Iveco => 'si-iveco',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Toyota => 'warning',
            self::Ford => 'success',
            self::Honda => 'primary',
            self::Chevrolet => 'info',
            self::Nissan => 'warning',
            self::Volvo => 'success',
            self::Scania => 'primary',
            self::Mercedes => 'info',
            self::Iveco => 'danger',
        };
    }
}
