<?php

namespace App\Enums;

enum TableStatus: string
{
    case FREE = 'free';
    case RESERVED = 'reserved';

    public function isFree()
    {
        return match ($this) {
            TableStatus::FREE => true,
            TableStatus::RESERVED => false,
        };
    }
}
