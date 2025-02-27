<?php

namespace Main\Analytic\Service;

use App\Queue\KafkaProducer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestLogger
{
    // Базовые данные запроса
    private ?string $method = null;
    private ?string $path = null;
    private ?string $fullUrl = null;
    private ?string $ip = null;
    private ?string $userAgent = null;
    private ?string $requestTime = null;
    private ?float $duration = null;

    // Дополнительные данные, которые можно извлечь из запроса
    private ?string $host = null;
    private ?string $scheme = null;
    private ?string $contentType = null;
    private ?int $contentLength = null;
    private ?string $referer = null;
    private ?array $queryParams = null;
    private ?array $requestBody = null;
    private ?array $headers = null;

    // Кастомные данные
    private ?array $data = [];

    public function setRequestData(Request $request): void
    {
        $this->method = $request->method();
        $this->path = $request->path();
        $this->fullUrl = $request->fullUrl();
        $this->ip = $request->ip();
        $this->userAgent = $request->userAgent();
        $this->requestTime = now()->toDateTimeString();

        // Дополнительные данные
        $this->host = $request->getHost();
        $this->scheme = $request->getScheme();
        $this->contentType = $request->header('Content-Type');
        $this->contentLength = $request->header('Content-Length');
        $this->referer = $request->header('Referer');
        $this->queryParams = $request->query();
        $this->requestBody = $request->all();
        $this->headers = $request->headers->all();
    }

    public function addData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function getLogData(): array
    {
        return $this->__serialize();
    }

    public function clear(): void
    {
        Log::info(json_encode($this->getLogData()));
        $producer = new KafkaProducer();
        $producer->send(json_encode($this->getLogData()));
        foreach (array_keys($this->getLogData()) as $key) {
            $this->$key = null;
        }
    }

    public function __serialize(): array
    {
        return get_object_vars($this);
    }

    public function duration(float $duration): void
    {
        $this->duration = $duration;
    }
}
