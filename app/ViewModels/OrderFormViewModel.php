<?php

namespace App\ViewModels;

use App\Models\Product;
use App\Models\Table;
use Illuminate\Database\Eloquent\Collection;

class OrderFormViewModel
{
    public function __construct(public ?Table $currentTable = null)
    {
    }

    public function tables(): Collection
    {
        return Table::all();
    }

    public function products(): Collection
    {
        return Product::get();
    }
}
