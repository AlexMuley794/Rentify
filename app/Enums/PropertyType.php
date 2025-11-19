<?php

namespace App\Enums;

enum PropertyType: string
{
    case HOUSE = 'house';
    case APARTMENT = 'apartment';
    case LOCAL = 'local';

    public function label(): string
    {
        return match($this) {
            self::HOUSE => 'Casa',
            self::APARTMENT => 'Apartamento',
            self::LOCAL => 'Local',
        };
    }
}
