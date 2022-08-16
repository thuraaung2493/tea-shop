<?php

namespace App\Actions;

use App\DataTransferObjects\OrderedData;
use App\Enums\TableStatus;

class CreateOrderAction
{
    public function execute(OrderedData $data): void
    {
        $data->table->status = TableStatus::RESERVED;
        $data->table->save();

        $data->table->orders()->create([
            'user_id' => auth()->id(),
            'products' => $data->productIds,
            'total_quantity' => $data->getTotalQuantity(),
            'total_amount' => $data->getTotalAmount()->value(),
        ]);
    }
}
