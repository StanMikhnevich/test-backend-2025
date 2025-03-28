<?php

use App\Http\Controllers\Api\v1\ApiPositionController;
use App\Http\Controllers\Api\v1\ApiTokenController;
use App\Http\Controllers\Api\v1\ApiUserController;
use Illuminate\Support\Facades\Route;

Route::get('token', ApiTokenController::class);

Route::apiResource(
    'positions',
    ApiPositionController::class
)->only('index');

Route::apiResource(
    'users',
    ApiUserController::class
)->except('update', 'destroy');
