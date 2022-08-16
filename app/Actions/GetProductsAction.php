<?php

namespace App\Actions;

use App\Models\Product;

class GetProductsAction
{
    public function execute()
    {
        return Product::paginate(10);
    }
}
