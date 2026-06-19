<?php

namespace Database\Seeders;

use App\Models\Sensor;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SensorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Seed 104 sensors to match the screenshot
        for ($i = 0; $i < 104; $i++) {
            Sensor::create([
                'nama_sensor' => $faker->city(),
                'data'        => $faker->randomFloat(0, 1, 99999),
            ]);
        }
    }
}
