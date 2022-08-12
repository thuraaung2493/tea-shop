<?php

namespace App\DataTransferObjects;

use App\Models\Product;
use App\Models\Table;
use App\ValueObjects\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderedData
{
    public function __construct(
        public readonly Table $table,
        public readonly mixed $productIds,
        public readonly Collection $items,
    ) {
    }

    public function getTotalQuantity(): int
    {
        return $this->items->sum('totalQuantity');
    }

    public function getTotalAmount(): Price
    {
        return Price::from($this->items->sum(function ($item) {
            return $item->totalPrice->value();
        }));
    }

    public static function of(Collection $data, Table $table)
    {
        return static::toInstance($data, $table);
    }

    public static function fromRequest(Request $request): self
    {
        $requestData = static::filter($request)->reduce(function ($c, $count, $id) {
            return $c->put(explode('_', $id)[1], $count);
        }, collect());

        return static::toInstance($requestData, $request->table);
    }

    public static function toInstance($data, Table $table)
    {
        $products = Product::whereIn('id', $data->keys())->get();

        $items = $products->map(function ($product) use ($data) {
            $count = $data->get($product->id);
            return new OrderedItem(
                $product,
                $count,
                Price::from($product->price->value() * $count),
            );
        });

        return new static($table, $data, $items);
    }

    public static function filter($request): Collection
    {
        return collect($request->except(['_token', 'table']))
            ->filter(fn ($val) => (int) $val > 0);
    }
}
