<?php

namespace App\DataTransferObjects;

use App\Models\Order;
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

    private static function orderedItems(Collection $orders): mixed
    {
        $result = collect();

        foreach ($orders as $order) {
            foreach ($order->products as $id => $count) {
                $result->put($id, (int) $result->pull($id, 0) + $count);
            }
        }

        return $result;
    }

    public static function of(Table $table)
    {
        $order = $table->currentOrder();

        return static::toInstance($order->products, $order->orderTable);

        // return static::toInstance(static::orderedItems($order), $order->map->orderTable);
    }

    public static function fromRequest(Request $request): self
    {
        $requestData = static::filter($request)->reduce(function ($c, $count, $id) {
            return $c->put(explode('_', $id)[1], $count);
        }, collect());

        return static::toInstance($requestData, $request->table);
    }

    private static function toOrderedItem($data): Collection
    {
        $products = Product::whereIn('id', $data->keys())->get();

        return $products->map(function ($product) use ($data) {
            $count = $data->get($product->id);
            return new OrderedItem(
                $product,
                $count,
                Price::from($product->price->value() * $count),
            );
        });
    }

    private static function toInstance($data, Table $table)
    {
        $items = static::toOrderedItem($data);

        return new static($table, $data, $items);
    }

    private static function filter(Request $request): Collection
    {
        return collect($request->except(['_token', 'table']))
            ->filter(fn ($val) => (int) $val > 0);
    }
}
