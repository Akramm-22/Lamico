<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

Route::get('/', fn () => redirect('/sensor'));
Route::resource('sensor', SensorController::class);



