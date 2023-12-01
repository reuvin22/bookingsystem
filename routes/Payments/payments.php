<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Payments\PaymentController;

Route::post('/payment', [PaymentController::class, 'createPayment']);
