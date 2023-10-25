<?php

use App\Http\Controllers\API\V1\LoginController;
use App\Http\Controllers\API\V1\Rooms\RoomController;
use App\Http\Controllers\API\V1\Rooms\RoomDetailsController;
use App\Http\Controllers\API\V1\Rooms\RoomImagesController;
use App\Http\Controllers\API\V1\Rooms\RoomReviewsController;
use App\Http\Controllers\API\V1\UserDataController;
use Illuminate\Support\Facades\Route;

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
    Route::post('/login', LoginController::class);
    Route::apiResource('/users', UserDataController::class);
    Route::apiResource('/rooms', RoomController::class);
    Route::apiResource('/roomdetails', RoomDetailsController::class);
    Route::apiResource('/roomratings', RoomReviewsController::class);
    Route::apiResource('/roomimages', RoomImagesController::class);
});
