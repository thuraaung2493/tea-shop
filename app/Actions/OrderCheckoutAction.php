<?php

namespace App\Actions;

use App\DataTransferObjects\TableCheckoutData;
use App\Enums\TableStatus;
use App\Models\Order;
use App\Models\Table;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;

class OrderCheckoutAction
{
    public function execute(Table $table, TableCheckoutData $tableCheckoutData): Response
    {
        $invoice = $this->printInvoice($table, $tableCheckoutData);

        $tableIds = $tableCheckoutData->tables->map(fn ($t) => $t->no);
        $orderIds = $tableCheckoutData->tables->map(fn ($t) => $t->currentOrder()->id);

        Table::whereIn('no', $tableIds)->update(['status' => TableStatus::FREE->value]);
        Order::whereIn('id', $orderIds)->update(['completed' => true]);

        return $invoice->download('invoice.pdf');
    }

    private function printInvoice(Table $table, TableCheckoutData $tableCheckoutData): PDF
    {
        $checkoutOrders = (new GetCheckoutOrdersAction)->execute($tableCheckoutData);

        return (new PrintInvoiceAction)->execute($table, $checkoutOrders);
    }
}
