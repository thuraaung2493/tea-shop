<?php

namespace App\DataTransferObjects;

use App\Http\Requests\TableTransferRequest;
use App\Models\Table;

class TableTransferData
{
    public function __construct(
        public readonly Table $fromTable,
        public readonly Table $toTable,
    ) {
    }

    public static function fromRequest(TableTransferRequest $request): self
    {
        $tables = Table::whereIn('no', $request->validated())->get();

        return new static(
            fromTable: $tables->where('no', $request->from)->first(),
            toTable: $tables->where('no', $request->to)->first(),
        );
    }
}
