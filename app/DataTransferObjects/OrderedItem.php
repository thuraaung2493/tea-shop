<?php

namespace App\DataTransferObjects;

use App\Models\Product;
use App\ValueObjects\Price;

class OrderedItem
{
    public function __construct(
        public readonly Product $product,
        public readonly int $totalQuantity,
        public readonly Price $totalPrice,
    ) {
    }
}
