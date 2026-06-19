<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Sensor;
use Illuminate\Http\Request;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class DashboardController extends Controller
{
    public function index()
    {
        $devices    = Device::latest('last_activity')->get();
        $suhu       = Sensor::where('type', 'suhu')->first();
        $kelembapan = Sensor::where('type', 'kelembapan')->first();

        return view('dashboard.index', compact('devices', 'suhu', 'kelembapan'));
    }

    public function sendLcd(Request $request)
    {
        $request->validate(['message' => 'required|string|max:32']);

        try {
            $this->publishMqtt('iot/lcd/message', $request->message);
            return back()->with('success', 'Pesan "' . $request->message . '" terkirim ke LCD!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal kirim LCD: ' . $e->getMessage());
        }
    }

    public function sendServo(Request $request)
    {
        $request->validate(['angle' => 'required|integer|min:0|max:180']);

        try {
            $this->publishMqtt('iot/servo/control', (string) $request->angle);
            return back()->with('success', 'Servo bergerak ke ' . $request->angle . '°');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal kontrol servo: ' . $e->getMessage());
        }
    }

    public function sensorData()
    {
        $suhu       = Sensor::where('type', 'suhu')->first();
        $kelembapan = Sensor::where('type', 'kelembapan')->first();

        return response()->json([
            'suhu'         => $suhu?->last_value ?? '--',
            'kelembapan'   => $kelembapan?->last_value ?? '--',
            'suhu_time'    => $suhu?->last_updated?->diffForHumans() ?? '-',
            'hum_time'     => $kelembapan?->last_updated?->diffForHumans() ?? '-',
            'devices'      => Device::select('device_id','status','topic','last_activity')
                                    ->latest('last_activity')->get(),
            'last_refresh' => now()->format('H:i:s'),
        ]);
    }

    // ── Helper publish ke MQTT ────────────────────────
    private function publishMqtt(string $topic, string $message): void
    {
        $host     = env('MQTT_HOST');
        $port     = (int) env('MQTT_PORT', 8883);
        $username = env('MQTT_USERNAME');
        $password = env('MQTT_PASSWORD');
        $clientId = 'laravel-pub-' . uniqid();

        $mqtt = new MqttClient($host, $port, $clientId);

        $settings = (new ConnectionSettings)
            ->setUsername($username)
            ->setPassword($password)
            ->setUseTls(true)
            ->setTlsVerifyPeer(false)
            ->setTlsVerifyPeerName(false)
            ->setKeepAliveInterval(10)
            ->setConnectTimeout(15);

        $mqtt->connect($settings, true);
        $mqtt->publish($topic, $message, 0);
        $mqtt->disconnect();
    }
}