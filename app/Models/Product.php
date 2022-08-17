<?php

namespace App\Models;

use App\ValueObjects\Image;
use App\ValueObjects\Price;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'price' => 'int',
    ];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Price::from($value),
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Image::from($value),
        );
    }
}
