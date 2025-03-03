<?php

namespace App\Queue;

interface Queue
{
    public function send(string $payload, ?array $params = null): void;
}
