<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrderAction;
use App\Actions\OrderCheckoutAction;
use App\Actions\PrintInvoiceAction;
use App\DataTransferObjects\OrderedData;
use App\DataTransferObjects\TableCheckoutData;
use App\Http\Requests\TableCheckoutRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected CreateOrderAction $createOrderAction,
        protected OrderCheckoutAction $orderCheckout,
    ) {
    }

    public function store(Table $table, Request $request)
    {
        $this->createOrderAction->execute(
            OrderedData::fromRequest(
                $request->merge(['table' => $table])
            )
        );

        return redirect()->route('home');
    }

    public function checkout(Table $table, TableCheckoutRequest $request)
    {
        $checkoutData = TableCheckoutData::of($table, $request);

        return $this->orderCheckout->execute($table, $checkoutData);
    }
}
