<?php

namespace App\ViewModels;

use App\DataTransferObjects\OrderedData;
use App\Models\Table;
use App\ValueObjects\Price;
use Illuminate\Support\Collection;

class CheckoutViewModel
{
    /**
     * CheckoutViewModel
     *
     * @param Collection<OrderedData> $checkoutOrders
     */
    public function __construct(
        public readonly Table $currentTable,
        public readonly Collection $checkoutOrders,
    ) {
    }

    public function totalAmount(): Price
    {
        return Price::from($this->checkoutOrders->sum(fn ($o) => $o->getTotalAmount()->value()));
    }

    public function totalQuantity(): int
    {
        return $this->checkoutOrders->sum(fn ($o) => $o->getTotalQuantity());
    }

    public function tableNos(): string
    {
        return $this->checkoutOrders->map(
            fn ($o) => $o->table->no
        )->sort()->join(', ');
    }
}
