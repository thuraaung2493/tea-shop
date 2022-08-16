<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;


trait GenerateTableNo
{
    public static function bootGenerateTableNo()
    {
        static::creating(function ($table) {
            $table->no = static::generateCode(static::max('id') ?? 0);
        });
    }

    public static function generateCode(int $id): string
    {
        return 'TBL-' . Str::padLeft(++$id, 3, '0');
    }
}
