<?php

namespace Main\Analytic\Model;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Spatie\LaravelData\Data;

class AnalyticData extends Data
{
    public ?string $method;
    public ?string $path;
    public ?string $fullUrl;
    public ?string $ip;
    public ?string $userAgent;
    public ?string $requestTime;
    public ?float $duration;
    public ?string $host;
    public ?string $scheme;
    public ?string $contentType;
    public ?int $contentLength;
    public ?string $referer;
    public ?string $userId;
    public ?string $requestUuid;

    public function __construct(
        ?string $method = null,
        ?string $path = null,
        ?string $fullUrl = null,
        ?string $ip = null,
        ?string $userAgent = null,
        ?string $requestTime = null,
        ?float $duration = null,
        ?string $host = null,
        ?string $scheme = null,
        ?string $contentType = null,
        ?int $contentLength = null,
        ?string $referer = null,
        ?string $userId = null,
        ?string $requestUuid = null
    )
    {
        $this->method = $method;
        $this->path = $path;
        $this->fullUrl = $fullUrl;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->requestTime = $requestTime;
        $this->duration = $duration;
        $this->host = $host;
        $this->scheme = $scheme;
        $this->contentType = $contentType;
        $this->contentLength = $contentLength;
        $this->referer = $referer;
        $this->userId = $userId;
        $this->requestUuid = $requestUuid;
    }

    public static function fromRequest(Request $request): self
    {
        $userId = $request->user()?->id ?? $request->header('X-User-ID');
        $requestUuid = $request->header('X-Request-UUID') ?: Uuid::uuid4()->toString();

        return new self(
            $request->method(),
            $request->path(),
            $request->fullUrl(),
            $request->ip(),
            $request->userAgent(),
            now()->toDateTimeString(),
            null,
            $request->getHost(),
            $request->getScheme(),
            $request->header('Content-Type'),
            $request->header('Content-Length') ? (int)$request->header('Content-Length') : null,
            $request->header('Referer'),
            $userId,
            $requestUuid
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['method'] ?? null,
            $data['path'] ?? null,
            $data['fullUrl'] ?? null,
            $data['ip'] ?? null,
            $data['userAgent'] ?? null,
            $data['requestTime'] ?? null,
            isset($data['duration']) ? (float)$data['duration'] : null,
            $data['host'] ?? null,
            $data['scheme'] ?? null,
            $data['contentType'] ?? null,
            isset($data['contentLength']) ? (int)$data['contentLength'] : null,
            $data['referer'] ?? null,
            $data['userId'] ?? null,
            $data['requestUuid'] ?? null
        );
    }
}
