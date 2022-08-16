<?php

namespace App\ViewModels;

use App\Enums\TableStatus;
use App\Models\Order;
use App\Models\Table;
use App\ValueObjects\Price;

class TableSummary
{
    public function __construct(
        public Table $table,
        public ?Order $order,
    ) {
    }

    public function getBackgroundClass(): string
    {
        return $this->table->status->isFree() ? 'bg-success' : 'bg-danger';
    }

    public function isCheckout(): bool
    {
        return !$this->table->status->isFree() && isset($this->order);
    }

    public function getTotalAmount(): Price
    {
        return $this->order ? $this->order->total_amount : Price::from();
    }

    public function getTotalQuantity(): int
    {
        return $this->order ? $this->order->total_quantity : 0;
    }
}
