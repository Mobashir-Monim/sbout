<?php

use Illuminate\Support\Facades\Route;

Route::name('user.')->prefix('/user')->group(function () {
    Route::get('/', [App\Http\Controllers\CourseController::class, 'index'])->name('index');
    
});
