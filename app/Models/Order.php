<?php

namespace App\Models;

use App\ValueObjects\Price;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'products' => 'collection',
    ];

    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Price::from($value),
        );
    }

    public function orderTable(): BelongsTo
    {
        return $this->belongsTo(Table::class, 'table_id', 'id');
    }
}
