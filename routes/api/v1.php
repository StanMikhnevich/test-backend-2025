<?php

use App\Http\Controllers\Api\v1\ApiTokenController;
use Illuminate\Support\Facades\Route;

Route::get('token', ApiTokenController::class);
