<?php

use Illuminate\Support\Facades\Route;

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

Route::name('course-category.')->prefix('/course-category')->group(function () {
    Route::get('/', [App\Http\Controllers\CourseCategoryController::class, 'index'])->name('index');
    Route::get('create', [App\Http\Controllers\CourseCategoryController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\CourseCategoryController::class, 'store'])->name('store');
    Route::get('/{category}', [App\Http\Controllers\CourseCategoryController::class, 'show'])->name('show');
    Route::patch('/{category}', [App\Http\Controllers\CourseCategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [App\Http\Controllers\CourseCategoryController::class, 'delete'])->name('delete');
});
