<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:api')->post('/payment', [PaymentController::class, 'createPayment']); 

Route::post('/login', [AuthController::class, 'login']); 

Route::post('/register', [AuthController::class, 'register']);
