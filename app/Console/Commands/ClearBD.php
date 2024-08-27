<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class ClearBD extends Command
{
    protected $signature = 'db:clear';

    public function handle(): void
    {
        Schema::dropAllTables();
    }
}
