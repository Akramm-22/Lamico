<?php

require __DIR__ . '/vendor/autoload.php';

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

// ── Isi sesuai .env kamu ──
$host     = 'akram.cloud.shiftr.io';
$port     = 8883;
$username = 'akram';
$password = 'amanaja';
$clientId = 'laravel-test-' . rand(1000, 9999);

echo "=================================\n";
echo "TEST KONEKSI MQTT SHIFTR.IO\n";
echo "=================================\n";
echo "Host     : $host:$port\n";
echo "Username : $username\n";
echo "ClientID : $clientId\n\n";

try {
    $mqtt = new MqttClient($host, $port, $clientId);

    $settings = (new ConnectionSettings)
        ->setUsername($username)
        ->setPassword($password)
        ->setUseTls(true)   
        ->setTlsVerifyPeer(false)
        ->setKeepAliveInterval(60)
        ->setConnectTimeout(15);

    $mqtt->connect($settings, true);
    echo "✅ KONEK BERHASIL!\n\n";

    // Test publish
    $mqtt->publish('iot/test', json_encode([
        'from'    => 'laravel-test',
        'message' => 'Test koneksi berhasil',
        'time'    => date('H:i:s'),
    ]));
    echo "✅ Publish ke iot/test berhasil\n\n";

    // Test subscribe sebentar
    echo "Listening 5 detik...\n";
    $mqtt->subscribe('iot/#', function($topic, $message) {
        echo "📨 TERIMA → [$topic]: $message\n";
    }, 0);

    $mqtt->loop(true, true, 5);
    $mqtt->disconnect();
    echo "\n✅ Test selesai — koneksi MQTT berfungsi!\n";

} catch (\Exception $e) {
    echo "❌ GAGAL: " . $e->getMessage() . "\n";
}