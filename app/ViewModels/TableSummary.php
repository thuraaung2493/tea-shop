<?php

namespace App\ViewModels;

use App\Enums\TableStatus;
use App\Models\Order;
use App\ValueObjects\Price;

class TableSummary
{
    public function __construct(
        public string $tableNo,
        public TableStatus $status,
        public ?Order $order,
    ) {
    }

    public function getBackgroundClass(): string
    {
        return $this->status->isFree() ? 'bg-success' : 'bg-danger';
    }

    public function isCheckout(): bool
    {
        return !$this->status->isFree() && isset($this->order);
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
