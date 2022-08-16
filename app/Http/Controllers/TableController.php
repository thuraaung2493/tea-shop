<?php

namespace App\Http\Controllers;

use App\Actions\GetCheckoutOrdersAction;
use App\Actions\TableTransferAction;
use App\DataTransferObjects\TableCheckoutData;
use App\DataTransferObjects\TableTransferData;
use App\Http\Requests\TableCheckoutRequest;
use App\Http\Requests\TableTransferRequest;
use App\Models\Table;
use App\ViewModels\CheckoutViewModel;
use App\ViewModels\OrderFormViewModel;

class TableController extends Controller
{
    public function __construct(
        private readonly TableTransferAction $tableTransfer,
        private readonly GetCheckoutOrdersAction $getCheckoutOrders,
    ) {
    }
    public function show(Table $table)
    {
        return view('tables.show')->with(
            'viewModel',
            new OrderFormViewModel($table)
        );
    }

    public function store()
    {
        Table::create([]);

        return redirect()->back();
    }

    public function transfer(TableTransferRequest $request)
    {
        $tableTransferData = TableTransferData::fromRequest($request);

        $this->tableTransfer->execute($tableTransferData);

        return redirect()->route('home');
    }

    public function checkout(TableCheckoutRequest $request, Table $table)
    {
        $checkoutOrders = $this->getCheckoutOrders->execute(TableCheckoutData::of($table, $request));

        return view('orders.checkout')
            ->with('viewModel', new CheckoutViewModel($table, $checkoutOrders));
    }
}
