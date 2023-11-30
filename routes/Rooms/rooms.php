<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Rooms\RoomController;
use App\Http\Controllers\API\V1\Rooms\RoomImagesController;
use App\Http\Controllers\API\V1\Rooms\RoomDetailsController;
use App\Http\Controllers\API\V1\Rooms\RoomReviewsController;

Route::apiResource('/rooms', RoomController::class);
Route::apiResource('/roomdetails', RoomDetailsController::class);
Route::apiResource('/roomratings', RoomReviewsController::class);
Route::apiResource('/roomimages', RoomImagesController::class);
