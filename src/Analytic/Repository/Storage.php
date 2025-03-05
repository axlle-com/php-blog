<?php

namespace Main\Analytic\Repository;

use ClickHouseDB\Client;
use Main\Analytic\Model\AnalyticData;

readonly class Storage implements \Main\Analytic\Interface\Storage
{
    private string $table;

    public function __construct(private Client $client)
    {
        $this->table = 'logs';
    }

    public function create(AnalyticData $data): void
    {
        $this->client->insert($this->table, [$data->toArray()]);
    }
}
