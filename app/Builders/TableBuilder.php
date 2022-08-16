<?php

namespace App\Builders;

use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Builder;

class TableBuilder extends Builder
{
    public function whereFree(): self
    {
        return $this->where('status', TableStatus::FREE->value);
    }

    public function whereReserved(): self
    {
        return $this->where('status', TableStatus::RESERVED->value);
    }

    public function whereOtherReserved(string $no): self
    {
        return $this->where('status', TableStatus::RESERVED->value)->whereNot('no', $no);
    }
}
