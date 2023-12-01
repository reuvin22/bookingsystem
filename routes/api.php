<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Rooms\RoomController;
use App\Http\Controllers\API\V1\AuthData\LoginController;
use App\Http\Controllers\API\V1\AuthData\UserRegistration;
use App\Http\Controllers\API\V1\Rooms\RoomImagesController;
use App\Http\Controllers\API\V1\Rooms\RoomDetailsController;
use App\Http\Controllers\API\V1\Rooms\RoomReviewsController;
use App\Http\Controllers\API\V1\UserData\WishListController;
use App\Http\Controllers\API\V1\AuthData\ChangePassController;
use App\Http\Controllers\API\V1\AuthData\EmailForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function(){
    require __DIR__ . '\Rooms\rooms.php';
    require __DIR__ . '\Payments\payments.php';
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [UserRegistration::class, 'store']);
    Route::put('/changepass/{id}', [ChangePassController::class, 'changePass']);
    Route::post('/forgotpass', [EmailForgotPasswordController::class, 'emailForgotPassword']);
    Route::apiResource('/users', UserRegistration::class);
    Route::apiResource('/wishlist', WishListController::class);
});
