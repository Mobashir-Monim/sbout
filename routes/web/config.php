<?php

use Illuminate\Support\Facades\Route;

Route::name('config.')->prefix('/config')->group(function () {
    Route::get('/', [App\Http\Controllers\ConfigController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\ConfigController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\ConfigController::class, 'store'])->name('store');
    Route::get('/edit/{config}', [App\Http\Controllers\ConfigController::class, 'edit'])->name('edit');
    Route::post('/update/{config}', [App\Http\Controllers\ConfigController::class, 'update'])->name('update');
});
