<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->post('payment', [PaymentController::class, 'createPayment']);
