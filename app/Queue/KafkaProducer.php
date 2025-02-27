<?php

namespace App\Queue;

use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Illuminate\Support\Facades\Log;
use Interop\Queue\Context;
use Interop\Queue\Exception;
use Interop\Queue\Topic;

class KafkaProducer
{
    protected Context $context;
    protected Topic $topic;

    public function __construct()
    {
        $factory = new RdKafkaConnectionFactory([
            'global' => [
                'metadata.broker.list' => config('kafka.dsn'),
                'group.id' => config('kafka.group_id'),
                'auto.offset.reset' => 'earliest',
                'enable.auto.commit' => 'false',
                'session.timeout.ms' => '30000',
            ],
            'topic' => [
                'auto.offset.reset' => 'earliest',
            ],
        ]);

        $this->context = $factory->createContext();
        $this->setupTopic();
    }

    protected function setupTopic(): void
    {
        if (config('kafka.auto_create_topics')) {
            $this->topic = $this->context->createTopic(config('kafka.topic'));
        }
    }

    public function send(string $messageText, string $key = null): void
    {
        $message = $this->context->createMessage($messageText);
        if ($key !== null) {
            $message->setKey($key);
        }

        $producer = $this->context->createProducer();
        try {
            $producer->send($this->topic, $message);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
