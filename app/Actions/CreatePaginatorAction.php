<?php

namespace App\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CreatePaginatorAction
{
    public function execute(
        Collection|array $items,
        int $perPage = 10,
        int $page = null,
        array $options = [],
    ): LengthAwarePaginator {
        $page = $page ?: Paginator::resolveCurrentPage();
        $items = $items instanceof Collection ? $items : collect($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
