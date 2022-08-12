<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrderAction;
use App\DataTransferObjects\OrderedData;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected CreateOrderAction $createOrderAction,
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

    public function checkout(Order $order)
    {
        // dd($order->products);
        return view('orders.checkout')->with('order', $order);
    }
}
