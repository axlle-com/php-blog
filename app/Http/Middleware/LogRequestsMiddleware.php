<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Main\Analytic\Service\RequestLogger;

readonly class LogRequestsMiddleware
{
    public function __construct(private RequestLogger $requestLogger)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $startTime = microtime(true);

        $this->requestLogger->setRequestData($request);

        // Продолжаем обработку запроса
        $response = $next($request);

        $endTime = microtime(true);
        $duration = $endTime - $startTime;

        // Добавляем время выполнения и статус ответа
        $this->requestLogger->duration($duration);
        $this->requestLogger->addData('status', $response->getStatusCode());

        // Отправляем данные в очередь
//        Queue::push(new LogRequestToClickHouse($logData));

        $this->requestLogger->clear();

        return $response;
    }
}
