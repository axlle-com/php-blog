<?php

namespace App\Providers;

use App\Exceptions\ApiExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Main\Analytic\Service\RequestLogger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[\Override]
    public function register(): void
    {
        $this->app->bind(ApiExceptionHandler::class, fn(): \App\Exceptions\ApiExceptionHandler => new ApiExceptionHandler());

        $this->app->singleton(RequestLogger::class, fn(): \Main\Analytic\Service\RequestLogger => new RequestLogger());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
