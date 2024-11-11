<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontviews.index');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('backviews.pages.index');
    });
});
