<?php

namespace App\Http\Controllers;

use App\Actions\CreatePaginatorAction;
use App\Actions\GetTableSummaryAction;

class HomeController extends Controller
{
    public function __construct(
        protected GetTableSummaryAction $getTableSummary,
    ) {
    }

    public function index()
    {
        return view('home')->with(
            'summary',
            $this->getTableSummary->execute(),
        );
    }
}
