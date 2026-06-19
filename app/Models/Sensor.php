<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'nama_sensor',
        'data',
        'type',          // ← tambah
        'topic',         // ← tambah
        'last_value',    // ← tambah
        'last_updated',  // ← tambah
    ];

    protected $casts = [
        'last_updated' => 'datetime',  // ← tambah
        'last_value'   => 'float',     // ← tambah
    ];
}