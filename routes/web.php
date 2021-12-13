<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Course Category Routes
|--------------------------------------------------------------------------
|
| Here all routes relating to course category are registered
|
*/

Route::get('/', function () {
    $x = 'aaaababa';
    dd(rtrim($x, 'a'));
    return view('landing');
});

Auth::routes(['register' => false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/register', function () {
//     dd('yup');
// });