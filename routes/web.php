<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Models\Order;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tables/{table}', [TableController::class, 'show'])->name('tables.show');

Route::post('/tables/{table}/order', [OrderController::class, 'store'])->name('tables.order');
Route::get('orders/{order}/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
