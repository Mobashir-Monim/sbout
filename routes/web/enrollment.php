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

Route::name('enrollment.')->prefix('/enrollment')->group(function () {
    Route::get('/registration/{course}', [App\Http\Controllers\EnrollmentController::class, 'registration'])->name('registration');
    Route::post('/register/{course}', [App\Http\Controllers\EnrollmentController::class, 'register'])->name('register');
});
