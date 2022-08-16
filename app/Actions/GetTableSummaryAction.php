<?php

namespace App\Actions;

use App\Models\Table;
use App\ViewModels\TableSummary;
use Illuminate\Pagination\LengthAwarePaginator;

class GetTableSummaryAction
{
    public function __construct(
        protected CreatePaginatorAction $createPaginatorAction
    ) {
    }

    public function execute(): LengthAwarePaginator
    {
        $result = Table::with('orders')->get()->map(function ($table) {
            $order = $table->orders->where('completed', false)->last();
            return new TableSummary(
                $table,
                $order,
            );
        });

        return $this->createPaginatorAction->execute($result);
    }
}
