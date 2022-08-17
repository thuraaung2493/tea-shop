<?php

namespace App\ViewModels;

use App\DataTransferObjects\OrderedData;
use App\Models\Table;
use App\ValueObjects\Price;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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

    public function orderedDate(): string
    {
        return $this->checkoutOrders->last()->table->currentOrder()->created_at->toFormattedDateString();
    }

    public function invoiceNo(): string
    {
        $invNo = $this->checkoutOrders->map(
            fn ($o) => $o->table->currentOrder()->id
        )->sort()->join('-');

        return "INV@" . Str::padLeft($invNo, 5, 0);
    }

    public function items()
    {
        return $this->checkoutOrders->reduce(function ($c, $o) {
            return $c->merge($o->items);
        }, collect());
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
