<?php

namespace App\Enums;

enum TableStatus: string
{
    case FREE = 'free';
    case RESERVED = 'reserved';

    public function isFree(): bool
    {
        return $this === TableStatus::FREE;
    }

    public function isReserved(): bool
    {
        return $this === TableStatus::RESERVED;
    }
}
