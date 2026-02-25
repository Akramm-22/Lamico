<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;

// redirect halaman utama
Route::get('/', function () {
    return redirect('/sensor');
});

// Sensor aja

// tampil data sensor
Route::get('/sensor', [SensorController::class, 'index'])->name('sensor.index');
// form tambah data
Route::get('/sensor/create', [SensorController::class, 'create'])->name('sensor.create');
// simpan data
Route::post('/sensor', [SensorController::class, 'store'])->name('sensor.store');
// form edit data
Route::get('/sensor/{id}/edit', [SensorController::class, 'edit'])->name('sensor.edit');
// update data
Route::put('/sensor/{id}', [SensorController::class, 'update'])->name('sensor.update');
// hapus data
Route::delete('/sensor/{id}', [SensorController::class, 'destroy'])->name('sensor.destroy');