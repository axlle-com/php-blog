<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Migration extends Command
{
    protected $signature = 'migrate:analytic';
    protected $description = 'Применить миграции для ClickHouse';

    public function handle(\Main\Analytic\Repository\Migration $migration): void
    {
        $this->info('Старт миграции...');
        $this->info($migration->handle());
        $this->info('Конец миграции');
    }
}
