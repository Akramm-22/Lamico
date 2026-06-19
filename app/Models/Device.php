<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'serial_number',
        'meta_data',
        'device_id',       // ← tambah
        'topic',           // ← tambah
        'status',          // ← tambah
        'last_activity',   // ← tambah
    ];

    protected $casts = [
        'last_activity' => 'datetime',  // ← tambah agar otomatis jadi Carbon
    ];
}