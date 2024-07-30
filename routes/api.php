<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\QuestionController;

Route::group(['prefix' => 'auth'], function () {
    Route::apiResource('schedules', ScheduleController::class);
    Route::apiResource('messages', ChatController::class); 
    Route::post('ask', [QuestionController::class, '__invoke']);
});

