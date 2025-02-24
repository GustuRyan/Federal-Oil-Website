<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserQueueController;

Route::get('/auth', function () {
    return view('frontviews.auth');
})->name('auth');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth')->group(function () {
    Route::get('/', [TransactionController::class, 'dashboard'])->name('cashier');

    Route::prefix('admin')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('admin.dashboard');

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
            Route::get('/', [TransactionController::class, 'index'])->name('admin.income.index');
            Route::get('/detail/{id}', [TransactionController::class, 'detail'])->name('admin.income.detail');
            Route::get('/edit/{id}', [TransactionController::class, 'edit'])->name('admin.income.update');
        });

        Route::prefix('spending')->group(function () {
            Route::get('/', [SpendingController::class, 'index'])->name('admin.spending.index');
            Route::get('/create', function () {
                return view('backviews.pages.spending.create');
            })->name('admin.spending.create');
            Route::get('/edit/{id}', [SpendingController::class, 'edit'])->name('admin.spending.update');
        });

        Route::prefix('receivable')->group(function () {
            Route::get('/', [ReceivableController::class, 'index'])->name('admin.receivables.index');
            Route::get('/create', [ReceivableController::class, 'create'])->name('admin.receivables.create');
            Route::get('/edit/{id}', [ReceivableController::class, 'edit'])->name('admin.receivables.update');
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
            Route::get('/update/{id}', [ServiceController::class, 'edit'])->name('admin.service.update');
        });
    });

    Route::get('/queue/get', [QueueController::class, 'index'])->name('get.queue');
    Route::post('/queues/store', [QueueController::class, 'store']);
    Route::put('/queues/update/{id}', [QueueController::class, 'update'])->name('update.queue');
    Route::put('/queues/current/{id}', [QueueController::class, 'updateCurrent']);
    Route::delete('/queues/{id}', [QueueController::class, 'destroy'])->name('delete.queue');

    Route::post('/customers', [CustomerController::class, 'store'])->name('create.customer');
    Route::post('/customers/dashboard', [CustomerController::class, 'storeDashboard'])->name('create.dashboard.customer');
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

    Route::post('/transaction', [TransactionController::class, 'store'])->name('create.transaction');
    Route::put('/transaction/{id}', [TransactionController::class, 'update'])->name('update.transaction');
    Route::delete('/transaction/{id}', [TransactionController::class, 'destroy'])->name('delete.transaction');

    Route::post('/receivable', [ReceivableController::class, 'store'])->name('create.receivable');
    Route::put('/receivable/{id}', [ReceivableController::class, 'update'])->name('update.receivable');
    Route::delete('/receivable/{id}', [ReceivableController::class, 'destroy'])->name('delete.receivable');

    Route::post('/spending', [SpendingController::class, 'store'])->name('create.spending');
    Route::put('/spending/{id}', [SpendingController::class, 'update'])->name('update.spending');
    Route::delete('/spending/{id}', [SpendingController::class, 'destroy'])->name('delete.spending');

    Route::post('/user-queue', [UserQueueController::class, 'store'])->name('user-queue.store');
    Route::put('/user-queue/{id}', [UserQueueController::class, 'update'])->name('user-queue.update');
    Route::delete('/user-queue/{id}', [UserQueueController::class, 'destroy'])->name('user-queue.destroy');

    Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'generatePDF'])->name('invoice.pdf');
    Route::get('/ticket/pdf', [QueueController::class, 'generatePDF'])->name('ticket.pdf');
});