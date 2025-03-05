<?php

return [
    'host' => env('CLICKHOUSE_HOST', 'clickhouse'),
    'port' => env('CLICKHOUSE_PORT', 8123),
    'username' => env('CLICKHOUSE_USERNAME', 'default'),
    'password' => env('CLICKHOUSE_PASSWORD', 'secret'),
    'database' => env('CLICKHOUSE_DATABASE', 'default'),
];
