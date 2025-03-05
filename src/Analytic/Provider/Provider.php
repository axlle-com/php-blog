<?php

namespace Main\Analytic\Provider;

use Main\Analytic\Interface\Storage;
use Main\Analytic\Model\AnalyticData;

readonly class Provider implements \Main\Analytic\Interface\Provider
{
    public function __construct(private Storage $storage)
    {
    }

    public function create(AnalyticData $data): void
    {
        $this->storage->create($data);
    }
}
