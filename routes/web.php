<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

// dd(Order::find(1)->total_amount);
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/tables/{table}', [TableController::class, 'show'])->name('tables.show');
    Route::post('/tables', [TableController::class, 'store'])->name('tables.store');
    Route::post('/tables/transfer', [TableController::class, 'transfer'])->name('tables.transfer');
    Route::get('/tables/{table}/checkout', [TableController::class, 'checkout'])->name('tables.checkout');
    Route::get('/orders/{table}/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');

    Route::post('/tables/{table}/order', [OrderController::class, 'store'])->name('tables.order');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}/', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}/', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/products/{image}', [ProductController::class, 'showImage'])->where('image', '.*')->name('image');
});
