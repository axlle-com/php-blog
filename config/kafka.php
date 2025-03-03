<?php

return [
    'brokers' => env('KAFKA_BROKERS', 'kafka:9092'),
    'group_id' => env('KAFKA_GROUP_ID', 'default_group'),
    'topic_name' => env('KAFKA_TOPIC_NAME', 'default_name'),
];
