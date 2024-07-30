<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ChatController;


Route::group(['prefix' => 'auth'], function () {
    Route::apiResource('schedules', ScheduleController::class);
    //Route::apiResource('messages/{chat_id}', ChatController::class);
    Route::apiResource('messages', ChatController::class);         
});
