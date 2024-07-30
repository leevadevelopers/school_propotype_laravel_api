<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;



Route::group(['prefix' => 'auth'], function () {
    Route::apiResource('schedules', ScheduleController::class);
});