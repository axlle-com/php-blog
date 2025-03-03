<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Consumer extends Command
{
    protected $signature = 'broker:consume
                            {--topic= : Kafka topic (default from config)}
                            {--group= : Consumer group (default from config)}';
    protected $description = 'Consume messages from Kafka';

    public function handle(\App\Queue\Consumer $consumer): void
    {
        $topic = $this->option('topic') ?: config('kafka.topic_name');
        $group = $this->option('group') ?: config('kafka.group_id');

        $this->info('Ожидание сообщений...');
        $this->info($consumer->listen($topic, $group));
        $this->info('Consumer закончил работу');
    }
}
