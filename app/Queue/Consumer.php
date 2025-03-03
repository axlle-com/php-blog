<?php

namespace App\Queue;

interface Consumer
{
    public function listen(string $topic, string $group): string;
}
