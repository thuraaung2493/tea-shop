<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\ViewModels\OrderFormViewModel;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function show(Table $table)
    {
        return view('tables.show')->with(
            'viewModel',
            new OrderFormViewModel($table)
        );
    }
}
