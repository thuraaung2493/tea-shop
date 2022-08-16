<?php

namespace App\Actions;

use App\DataTransferObjects\TableTransferData;
use App\Enums\TableStatus;
use App\Models\Table;

class TableTransferAction
{
    public function execute(TableTransferData $tableTransferData): void
    {
        $fromTable = $tableTransferData->fromTable;
        $toTable = $tableTransferData->toTable;

        if ($this->isTransfer($fromTable, $toTable)) {
            $fromTable->update(['status' => TableStatus::FREE]);
            $toTable->update(['status' => TableStatus::RESERVED]);

            $fromTable->currentOrder()->update([
                'table_id' => $toTable->id,
            ]);
        }
    }

    private function isTransfer(Table $from, Table $to): bool
    {
        return $from->isTransfer() && $to->status->isFree();
    }
}
