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
        $this->app->singleton(
            RdKafkaConnectionFactory::class,
            fn(): RdKafkaConnectionFactory => new RdKafkaConnectionFactory([
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
            ]));
    }

    public function boot(): void
    {
    }
}
