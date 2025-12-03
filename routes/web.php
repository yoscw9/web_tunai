<?php

use App\Http\Controllers\DrinksController;
use App\Http\Controllers\FoodsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PeanutBrittlesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SnacksController;
use App\Http\Controllers\ToppingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

// Pesanan
Route::resource('/pesanan', OrdersController::class)
    ->names('orders') // <--- INI WAJIB DITAMBAHKAN
    ->parameters([
        'pesanan' => 'orders'
    ]);

// Route detail manual tetap
Route::get('/pesanan/{id}/detail', [OrdersController::class, 'detail'])->name('orders.detail');
Route::get('/pesanan/{id}/edit', [OrdersController::class, 'edit'])->name('orders.edit');

// Master
// Menu
Route::prefix('/menu')->group(function () {
    Route::prefix('makanan')->name('makanan.')->group(function () {
        Route::get('/', [FoodsController::class, 'index'])->name('makanan'); // makanan.makanan
        Route::get('/tambah', [FoodsController::class, 'create'])->name('create');
        Route::post('/', [FoodsController::class, 'store'])->name('store');
        Route::get('/{foods}/edit', [FoodsController::class, 'edit'])->name('edit');
        Route::put('/{foods}', [FoodsController::class, 'update'])->name('update');
        Route::delete('/{foods}', [FoodsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('minuman')->name('minuman.')->group(function () {
        Route::get('/', [DrinksController::class, 'index'])->name('minuman'); // minuman.minuman
        Route::get('/tambah', [DrinksController::class, 'create'])->name('create');
        Route::post('/', [DrinksController::class, 'store'])->name('store');
        Route::get('/{drinks}/edit', [DrinksController::class, 'edit'])->name('edit');
        Route::put('/{drinks}', [DrinksController::class, 'update'])->name('update');
        Route::delete('/{drinks}', [DrinksController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('snack')->name('snack.')->group(function () {
        Route::get('/', [SnacksController::class, 'index'])->name('snack'); // snack.snack
        Route::get('/tambah', [SnacksController::class, 'create'])->name('create');
        Route::post('/', [SnacksController::class, 'store'])->name('store');
        Route::get('/{snacks}/edit', [SnacksController::class, 'edit'])->name('edit');
        Route::put('/{snacks}', [SnacksController::class, 'update'])->name('update');
        Route::delete('/{snacks}', [SnacksController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('topping')->name('topping.')->group(function () {
        Route::get('/', [ToppingsController::class, 'index'])->name('topping'); // topping.topping
        Route::get('/tambah', [ToppingsController::class, 'create'])->name('create');
        Route::post('/', [ToppingsController::class, 'store'])->name('store');
        Route::get('/{toppings}/edit', [ToppingsController::class, 'edit'])->name('edit');
        Route::put('/{toppings}', [ToppingsController::class, 'update'])->name('update');
        Route::delete('/{toppings}', [ToppingsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('rempeyek')->name('rempeyek.')->group(function () {
        Route::get('/', [PeanutBrittlesController::class, 'index'])->name('rempeyek'); // rempeyek.rempeyek
        Route::get('/tambah', [PeanutBrittlesController::class, 'create'])->name('create');
        Route::post('/', [PeanutBrittlesController::class, 'store'])->name('store');
        Route::get('/{peanut_brittles}/edit', [PeanutBrittlesController::class, 'edit'])->name('edit');
        Route::put('/{peanut_brittles}', [PeanutBrittlesController::class, 'update'])->name('update');
        Route::delete('/{peanut_brittles}', [PeanutBrittlesController::class, 'destroy'])->name('destroy');
    });
});

// Laporan
Route::get('/laporan', [ReportsController::class, 'index'])->name('reports.index');
Route::resource('/laporan/detail', OrdersController::class)->name('show', 'orders.show');
Route::get('/laporan/{id}/print', [OrdersController::class, 'print'])->name('orders.print');

// Cetak Nota
Route::get('/orders/{id}/print', [OrdersController::class, 'print'])->name('orders.print');
