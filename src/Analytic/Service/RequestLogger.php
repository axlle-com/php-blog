<?php

namespace Main\Analytic\Service;

use App\Queue\Queue;
use Illuminate\Http\Request;
use Main\Analytic\Model\AnalyticData;

class RequestLogger
{
    private ?AnalyticData $analyticData = null;

    public function __construct(private readonly ?Queue $queue)
    {
    }

    public function setRequestData(Request $request): void
    {
        $this->analyticData = AnalyticData::fromRequest($request);
    }

    public function getLogData(): array
    {
        return $this->analyticData ? $this->analyticData->toArray() : [];
    }

    public function reset(): void
    {
        if ($this->getLogData() !== []) {
            $this->queue->send(json_encode($this->getLogData()));
        }

        $this->analyticData = null;
    }

    public function duration(float $duration): void
    {
        $this->analyticData->duration = $duration;
    }
}
