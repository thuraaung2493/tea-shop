<?php

namespace App\Models;

use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Table extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => TableStatus::class,
    ];

    public static function booted()
    {
        static::creating(function ($table) {
            $table->no = static::generateCode(static::max('id') ?? 0);
        });
    }

    public static function generateCode(int $id): string
    {
        return 'TBL-' . Str::padLeft(++$id, 3, '0');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getRouteKeyName()
    {
        return 'no';
    }
}
