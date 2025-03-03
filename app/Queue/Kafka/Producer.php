<?php

namespace App\Queue\Kafka;

use App\Queue\Queue;
use Illuminate\Support\Facades\Log;
use Jobcloud\Kafka\Message\KafkaProducerMessage;
use Jobcloud\Kafka\Producer\KafkaProducerInterface;
use RuntimeException;

readonly class Producer implements Queue
{
    public function __construct(private KafkaProducerInterface $producer)
    {
    }

    public function send(string $payload, ?array $params = null): void
    {
        $queue = $params['queue'] ?? config('kafka.topic_name');
        if (empty($queue)) {
            Log::error('error');
            return;
        }

        $kafkaMessage = KafkaProducerMessage::create($queue, $params['partition'] ?? 0);

        $key = $params['key'] ?? null;
        if (! empty($key)) {
            $kafkaMessage = $kafkaMessage->withKey($key);
        }

        $kafkaMessage = $kafkaMessage->withBody($payload);

        $headers = $params['headers'] ?? null;
        if (! empty($headers) && is_array($headers)) {
            $kafkaMessage = $kafkaMessage->withHeaders($headers);
        }

        $this->producer->produce($kafkaMessage);
        $result = $this->producer->flush(20000);

        if ($result !== 0) {
            Log::error('Failed to flush Kafka messages', ['remaining' => $result]);
            throw new RuntimeException('Message delivery failed');
        }

        Log::info('Message sent to Kafka', [
            'topic' => $queue,
            'key' => $key,
            'headers' => $headers
        ]);
    }
}
