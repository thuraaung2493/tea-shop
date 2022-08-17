<?php

namespace App\Actions;

use App\Models\Table;
use App\ViewModels\CheckoutViewModel;
use Barryvdh\DomPDF\Facade\PDF;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Collection;

class PrintInvoiceAction
{
    public function execute(Table $table, Collection $checkoutOrders): DomPDFPDF
    {
        $data = new CheckoutViewModel($table, $checkoutOrders);

        return PDF::loadView('pdf.invoice', compact('data'));
    }
}
