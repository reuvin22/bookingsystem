<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\ChatAPI\ChatsController;

Route::apiResource('/chat', ChatsController::class);
