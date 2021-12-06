<?php

use Illuminate\Support\Facades\Route;

Route::name('course.')->prefix('/courses')->group(function () {
    Route::get('/', [App\Http\Controllers\CourseController::class, 'index'])->name('index');
    Route::get('create', [App\Http\Controllers\CourseController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\CourseController::class, 'store'])->name('store');
    Route::get('/{course}', [App\Http\Controllers\CourseController::class, 'show'])->name('show');
    Route::patch('/{course}', [App\Http\Controllers\CourseController::class, 'update'])->name('update');
    Route::delete('/{course}', [App\Http\Controllers\CourseController::class, 'delete'])->name('delete');
});
