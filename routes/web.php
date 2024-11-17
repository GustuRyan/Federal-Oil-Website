<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontviews.index');
})->name('cashier');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('backviews.pages.index');
    })->name('admin.dashboard');
    Route::get('/stocks', function () {
        return view('backviews.pages.stocks');
    })->name('admin.stocks');
    Route::get('/income', function () {
        return view('backviews.pages.income');
    })->name('admin.income');
    Route::get('/spending', function () {
        return view('backviews.pages.spending');
    })->name('admin.spending');
    Route::get('/receivables', function () {
        return view('backviews.pages.receivables');
    })->name('admin.receivables');
});
