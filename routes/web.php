<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontviews.index');
})->name('cashier');

Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('backviews.pages.index');
    })->name('admin.dashboard');

    Route::prefix('stock')->group(function () {
        Route::get('/', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.stocks.index');
        Route::get('/detail/{id}', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.stocks.detail');
        Route::get('/create', function () {
            return view('backviews.pages.stock.create');
        })->name('admin.stocks.create');
        Route::get('/update', function () {
            return view('backviews.pages.stock.index');
        })->name('admin.stocks.update');
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

});
