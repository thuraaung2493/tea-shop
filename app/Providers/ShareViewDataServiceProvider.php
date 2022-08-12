<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Table;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ShareViewDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('tables', Table::get());
        View::share('products', Product::all());
    }
}
