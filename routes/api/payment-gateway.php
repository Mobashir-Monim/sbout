<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('payment-gateway.')->prefix('/payment-gateway')->group(function () {
    Route::post('/ipn/{course}/store/{purchase}', [App\Http\Controllers\PaymentGatewayController::class, 'storeIPN'])->name('index');
    Route::post('/register/{course}/success/{purchase}', [App\Http\Controllers\PaymentGatewayController::class, 'enrollmentSucceedful'])->name('register.success');
    Route::post('/register/{course}/fail/{purchase}', [App\Http\Controllers\PaymentGatewayController::class, 'enrollmentUnsuccessful'])->name('register.fail');
    Route::post('/register/{course}/cancel/{purchase}', [App\Http\Controllers\PaymentGatewayController::class, 'enrollmentUnsuccessful'])->name('register.cancel');
});