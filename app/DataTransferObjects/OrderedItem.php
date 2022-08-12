<?php

namespace App\DataTransferObjects;

use App\Models\Product;
use App\ValueObjects\Price;

class OrderedItem
{
    public function __construct(
        public Product $product,
        public int $totalQuantity,
        public Price $totalPrice,
    ) {
    }
}
