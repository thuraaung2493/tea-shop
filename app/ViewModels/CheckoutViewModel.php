<?php

namespace App\ViewModels;

class CheckoutViewModel
{
    public function __construct(
        protected readonly array $items,
    ) {
    }
}
