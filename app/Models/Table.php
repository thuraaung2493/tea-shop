<?php

namespace App\Models;

use App\Builders\TableBuilder;
use App\DataTransferObjects\OrderedData;
use App\Enums\TableStatus;
use App\Models\Traits\GenerateTableNo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    use HasFactory, GenerateTableNo;

    protected $guarded = [];

    protected $with = ['orders'];

    protected $casts = [
        'status' => TableStatus::class,
    ];

    public function getRouteKeyName()
    {
        return 'no';
    }

    public function newEloquentBuilder($query): TableBuilder
    {
        return new TableBuilder($query);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function currentOrder(): Order
    {
        return $this->orders->where('completed', false)->last();
    }

    public function currentOrderData(): OrderedData
    {
        return OrderedData::of($this);
    }

    public function otherReservedTables()
    {
        return Table::whereOtherReserved($this->no)->get();
    }

    public function isTransfer(): bool
    {
        return $this->status->isReserved();
    }
}
