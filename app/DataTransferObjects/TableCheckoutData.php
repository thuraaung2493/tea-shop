<?php

namespace App\DataTransferObjects;

use App\Http\Requests\TableCheckoutRequest;
use App\Models\Table;
use Illuminate\Support\Collection;

class TableCheckoutData
{
    public function __construct(
        public readonly Collection $tables,
    ) {
    }

    public static function of(Table $table, TableCheckoutRequest $request): self
    {
        if ($request->has('merge_tables')) {
            return new static(
                Table::whereIn('no', $request->validated('merge_tables'))->get()->prepend($table)
            );
        }

        return new static(collect()->push($table));
    }
}
