<?php

namespace App\Actions;

use App\DataTransferObjects\OrderedData;
use App\DataTransferObjects\TableCheckoutData;
use Illuminate\Support\Collection;

class GetCheckoutOrdersAction
{
    public function execute(TableCheckoutData $data): Collection
    {
        return $data->tables->map(function ($table) {
            return OrderedData::of($table);
        });
    }
}
