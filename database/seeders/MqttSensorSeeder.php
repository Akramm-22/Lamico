<?php

namespace Database\Seeders;

use App\Models\Sensor;
use Illuminate\Database\Seeder;

class MqttSensorSeeder extends Seeder
{
    public function run(): void
    {
        Sensor::updateOrCreate(
            ['type' => 'suhu'],
            [
                'nama_sensor' => 'Sensor Suhu DHT22',
                'data'        => 0,
                'type'        => 'suhu',
                'topic'       => 'iot/sensor/suhu',
                'last_value'  => 0,
            ]
        );

        Sensor::updateOrCreate(
            ['type' => 'kelembapan'],
            [
                'nama_sensor' => 'Sensor Kelembapan DHT22',
                'data'        => 0,
                'type'        => 'kelembapan',
                'topic'       => 'iot/sensor/kelembapan',
                'last_value'  => 0,
            ]
        );
    }
}