<?php

return [
    'dsn' => env('KAFKA_BROKERS', 'kafka:9092'),
    'topic' => env('KAFKA_TOPIC', 'default_topic'),
    'group_id' => env('KAFKA_GROUP', 'default_group'),
    'auto_create_topics' => env('KAFKA_AUTO_CREATE_TOPICS', true),
    'topic_config' => [
        'num_partitions' => (int)env('KAFKA_PARTITIONS', 3),
        'replication_factor' => (int)env('KAFKA_REPLICATION_FACTOR', 1)
    ]
];
