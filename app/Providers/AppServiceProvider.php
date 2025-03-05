<?php

namespace App\Providers;

use App\Exceptions\ApiExceptionHandler;
use App\Queue\Kafka\Consumer;
use App\Queue\Kafka\Producer;
use App\Queue\Queue;
use ClickHouseDB\Client;
use Illuminate\Support\ServiceProvider;
use Jobcloud\Kafka\Consumer\KafkaConsumerBuilder;
use Jobcloud\Kafka\Consumer\KafkaConsumerBuilderInterface;
use Jobcloud\Kafka\Producer\KafkaProducerBuilder;
use Jobcloud\Kafka\Producer\KafkaProducerInterface;
use Main\Analytic\Provider\Provider;
use Main\Analytic\Repository\Migration;
use Main\Analytic\Repository\Storage;
use Main\Analytic\Service\RequestLogger;

class AppServiceProvider extends ServiceProvider
{
    #[\Override]
    public function register(): void
    {
        $this->app->bind(ApiExceptionHandler::class);

        $this->app->bind(KafkaConsumerBuilderInterface::class,
            fn(): KafkaConsumerBuilderInterface => KafkaConsumerBuilder::create()->withAdditionalBroker(config('kafka.brokers'))
        );

        $this->app->bind(KafkaProducerInterface::class,
            fn(): KafkaProducerInterface => KafkaProducerBuilder::create()
                ->withAdditionalBroker(config('kafka.brokers'))
                ->build()
        );

        $this->app->singleton(\App\Queue\Consumer::class, Consumer::class);

        $this->app->singleton(Queue::class, Producer::class);

        $this->app->singleton(RequestLogger::class, RequestLogger::class);

        $this->app->bind(Client::class, fn(): Client => new Client(config('clickhouse')));

        $this->app->bind(Migration::class);
        $this->app->bind(\Main\Analytic\Interface\Storage::class, Storage::class);
        $this->app->bind(\Main\Analytic\Interface\Provider::class, Provider::class);
    }

    public function boot(): void
    {
    }
}
