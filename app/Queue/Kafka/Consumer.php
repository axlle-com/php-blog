<?php

namespace App\Queue\Kafka;

use Illuminate\Support\Facades\Log;
use Jobcloud\Kafka\Consumer\KafkaConsumerBuilderInterface;
use Jobcloud\Kafka\Exception\KafkaConsumerConsumeException;
use Jobcloud\Kafka\Exception\KafkaConsumerEndOfPartitionException;
use Jobcloud\Kafka\Exception\KafkaConsumerTimeoutException;
use Main\Analytic\Interface\Provider;
use Main\Analytic\Model\AnalyticData;

readonly class Consumer implements \App\Queue\Consumer
{
    public function __construct(
        private KafkaConsumerBuilderInterface $builder,
        private Provider $provider,
    )
    {
    }

    public function listen(string $topic, string $group): string
    {
        $consumer = $this->builder
            ->withConsumerGroup($group)
            ->withAdditionalSubscription($topic)
            ->build();

        $consumer->subscribe();

        $retryCount = 0;
        $maxRetries = 3;
        $message = '';

        while ($retryCount < $maxRetries) {
            try {
                $message = $consumer->consume();
                echo print_r($message->getOffset(), true) . PHP_EOL;

                $this->provider->create(
                    AnalyticData::fromArray(json_decode($message->getBody(), true))
                );

                $consumer->commit($message);
            } catch (KafkaConsumerTimeoutException $e) {
                Log::error('KafkaConsumerTimeoutException');
            } catch (KafkaConsumerEndOfPartitionException $e) {
                Log::error('KafkaConsumerEndOfPartitionException');
            } catch (KafkaConsumerConsumeException $e) {
                sleep(2);
                $retryCount++;
                $message = 'KafkaConsumerConsumeException';
            }
        }

        return $message ?: 'Consumer закончил работу';
    }
}
