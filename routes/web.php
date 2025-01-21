<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TransactionController::class, 'dashboard'])->name('cashier');

Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('backviews.pages.index');
    })->name('admin.dashboard');

    Route::prefix('stock')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.stocks.index');
        Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('admin.stocks.detail');
        Route::get('/create', function () {
            return view('backviews.pages.stock.create');
        })->name('admin.stocks.create');
        Route::get('/update/{id}', [ProductController::class, 'edit'])->name('admin.stocks.update');
        Route::get('/delete', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.stocks.delete');
    });

    Route::prefix('income')->group(function () {
        Route::get('/', function () {
            return view('backviews.pages.income.index');
        })->name('admin.income.index');
        Route::get('/detail', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.income.detail');
        Route::get('/edit', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.income.edit');
        Route::get('/delete', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.income.delete');
    });

    Route::prefix('spending')->group(function () {
        Route::get('/', function () {
            return view('backviews.pages.spending.index');
        })->name('admin.spending.index');
        Route::get('/detail', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.spending.detail');
        Route::get('/edit', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.spending.edit');
        Route::get('/delete', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.spending.delete');
    });

    Route::prefix('receivable')->group(function () {
        Route::get('/', function () {
            return view('backviews.pages.receivable.index');
        })->name('admin.receivables.index');
        Route::get('/detail', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.receivable.detail');
        Route::get('/create', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.receivable.create');
        Route::get('/edit', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.receivable.edit');
        Route::get('/delete', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.receivable.delete');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('admin.customer.index');
        Route::get('/create', function () {
            return view('backviews.pages.customer.create');
        })->name('admin.customer.create');
        Route::get('/update/{id}', [CustomerController::class, 'edit'])->name('admin.customer.update');
    });

    Route::prefix('service')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('admin.service.index');
        Route::get('/create', function () {
            return view('backviews.pages.service.create');
        })->name('admin.service.create');
        Route::get('/update/{id}', [ServiceController::class, 'show'])->name('admin.service.update');
    });
});

Route::get('/queue/get', [QueueController::class, 'index'])->name('get.queue');
Route::post('/queues/store', [QueueController::class, 'store']);
Route::put('/queues/update/{id}', [QueueController::class, 'update'])->name('update.queue'); 
Route::put('/queues/current/{id}', [QueueController::class, 'updateCurrent']); 
Route::delete('/queues/{id}', [QueueController::class, 'destroy'])->name('delete.queue');

Route::post('/customers', [CustomerController::class, 'store'])->name('create.customer');
Route::post('/customers', [CustomerController::class, 'storeDashboard'])->name('create.dashboard.customer');
Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('update.customer'); 
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('delete.customer');

Route::post('/product', [ProductController::class, 'store'])->name('create.product');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('update.product');
Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('delete.product');

Route::post('/carts', [CartController::class, 'store'])->name('create.cart');
Route::put('/carts/{id}', [CartController::class, 'update'])->name('update.cart');
Route::delete('/carts/{id}', [CartController::class, 'destroy'])->name('delete.cart');

Route::post('/services', [ServiceController::class, 'store'])->name('store.service');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('update.service');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('delete.service');