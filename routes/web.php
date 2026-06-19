<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard & IoT Control
Route::get('/dashboard',          [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/lcd',     [DashboardController::class, 'sendLcd'])->name('dashboard.lcd');
Route::post('/dashboard/servo',   [DashboardController::class, 'sendServo'])->name('dashboard.servo');
Route::get('/api/sensor-data',    [DashboardController::class, 'sensorData'])->name('api.sensor');

// CRUD Sensor & Device (sudah ada sebelumnya)
Route::resource('sensor', SensorController::class)->except(['show']);
Route::resource('device', DeviceController::class)->except(['show']);