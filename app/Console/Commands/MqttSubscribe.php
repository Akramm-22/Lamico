<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\Sensor;
use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttSubscribe extends Command
{
    protected $signature   = 'mqtt:subscribe';
    protected $description = 'Subscribe ke MQTT Shiftr.io';

    public function handle(): void
    {
        $host     = env('MQTT_HOST');
        $port     = (int) env('MQTT_PORT', 8883);
        $clientId = env('MQTT_CLIENT_ID', 'laravel-subscriber');
        $username = env('MQTT_USERNAME');
        $password = env('MQTT_PASSWORD');

        $this->info('╔══════════════════════════════════╗');
        $this->info('║   MQTT Subscriber — akram IoT    ║');
        $this->info('╚══════════════════════════════════╝');
        $this->info("Host     : {$host}:{$port}");
        $this->info("ClientID : {$clientId}");
        $this->line('──────────────────────────────────');

        while (true) {
            try {
                $mqtt = new MqttClient($host, $port, $clientId);

                $settings = (new ConnectionSettings)
                    ->setUsername($username)
                    ->setPassword($password)
                    ->setUseTls(true)
                    ->setTlsVerifyPeer(false)
                    ->setTlsVerifyPeerName(false)
                    ->setKeepAliveInterval(60)
                    ->setConnectTimeout(30);

                $mqtt->connect($settings, true);
                $this->info('✅ Konek ke broker berhasil!');
                $this->line('──────────────────────────────────');

                // ── Suhu ──────────────────────────────────
                $mqtt->subscribe('iot/sensor/suhu', function (string $topic, string $message) {
                    $value = (float) trim($message);
                    $this->line('🌡  [SUHU] ' . $value . '°C — ' . now()->format('H:i:s'));

                    Sensor::updateOrCreate(
                        ['type' => 'suhu'],
                        [
                            'nama_sensor'  => 'Sensor Suhu DHT22',
                            'data'         => $value,
                            'topic'        => $topic,
                            'last_value'   => $value,
                            'last_updated' => now(),
                        ]
                    );
                }, 0);

                // ── Kelembapan ────────────────────────────
                $mqtt->subscribe('iot/sensor/kelembapan', function (string $topic, string $message) {
                    $value = (float) trim($message);
                    $this->line('💧 [KELEMBAPAN] ' . $value . '% — ' . now()->format('H:i:s'));

                    Sensor::updateOrCreate(
                        ['type' => 'kelembapan'],
                        [
                            'nama_sensor'  => 'Sensor Kelembapan DHT22',
                            'data'         => $value,
                            'topic'        => $topic,
                            'last_value'   => $value,
                            'last_updated' => now(),
                        ]
                    );
                }, 0);

                // ── Device Status ─────────────────────────
                // HANYA simpan kalau ada device_id yang valid dari ESP32
                $mqtt->subscribe('iot/device/status', function (string $topic, string $message) {
                    $this->line('📡 [DEVICE] ' . $message . ' — ' . now()->format('H:i:s'));

                    $data = json_decode($message, true);

                    // Validasi: harus ada device_id dan bukan laravel
                    if (
                        isset($data['device_id']) &&
                        !str_contains($data['device_id'], 'laravel') &&
                        !str_contains($data['device_id'], 'test')
                    ) {
                        Device::updateOrCreate(
                            ['device_id' => $data['device_id']],
                            [
                                'serial_number' => $data['device_id'],
                                'status'        => $data['status'] ?? 'online',
                                'topic'         => $topic,
                                'last_activity' => now(),
                            ]
                        );
                        $this->info('   → Device disimpan: ' . $data['device_id']);
                    }
                }, 0);

                $this->info('📡 Menunggu data dari ESP32 Wokwi...');
                $this->line('──────────────────────────────────');

                $mqtt->loop(true);

            } catch (\Exception $e) {
                $this->error('❌ Error: ' . $e->getMessage());
                $this->warn('🔄 Reconnect dalam 5 detik...');
                sleep(5);
            }
        }
    }
}