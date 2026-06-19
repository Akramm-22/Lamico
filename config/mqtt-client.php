<?php

return [
    'default_connection' => 'default',

    'connections' => [
        'default' => [
            'host'                => env('MQTT_HOST', 'localhost'),
            'port'                => (int) env('MQTT_PORT', 8883),
            'client_id'           => env('MQTT_CLIENT_ID', 'laravel-subscriber'),
            'username'            => env('MQTT_USERNAME', null),
            'password'            => env('MQTT_PASSWORD', null),
            'use_tls'             => true,
            'tls_verify_peer'     => false,
            'tls_verify_peer_name'=> false,
            'tls_ca_file'         => null,
            'tls_client_cert_file'=> null,
            'tls_client_key_file' => null,
            'clean_session'       => true,
            'keep_alive_interval' => 60,
            'connect_timeout'     => 30,
            'socket_timeout'      => 5,
            'resend_timeout'      => 10,
            'last_will_topic'     => null,
            'last_will_message'   => null,
            'last_will_quality_of_service' => 0,
            'last_will_retain'    => false,
        ],
    ],
];