<?php

use App\Application\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'finish']);
