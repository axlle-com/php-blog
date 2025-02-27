<?php

namespace App\Providers;

use App\Exceptions\ApiExceptionHandler;
use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Illuminate\Support\ServiceProvider;
use Main\Analytic\Service\RequestLogger;

class AppServiceProvider extends ServiceProvider
{
    #[\Override]
    public function register(): void
    {
        $this->app->bind(ApiExceptionHandler::class, fn(): ApiExceptionHandler => new ApiExceptionHandler());

        $this->app->singleton(RequestLogger::class, fn(): RequestLogger => new RequestLogger());
    }

    public function boot(): void
    {
        $factory = new RdKafkaConnectionFactory(['global' => [
            'metadata.broker.list' => config('kafka.dsn')
        ]]);

        $context = $factory->createContext();
        $topic = $context->createTopic(config('kafka.topic'));

        try {
            $context->createTopic($topic->getTopicName());
        } catch (\Exception $e) {
        }
    }
}
