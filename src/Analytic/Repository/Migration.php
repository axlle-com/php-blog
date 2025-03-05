<?php

namespace Main\Analytic\Repository;

use ClickHouseDB\Client;

readonly class Migration
{

    public function __construct(private Client $db)
    {
    }

    public function handle(): string
    {
        $this->createMigrationsTable();

        $migrationsPath = database_path('migrations/clickhouse');
        $migrationFiles = glob($migrationsPath . '/*.sql');

        if (empty($migrationFiles)) {
            return 'Нет файлов миграций в ' . $migrationsPath;
        }

        $appliedMigrations = $this->getAppliedMigrations();

        $batch = $this->getNextBatchNumber();
        $appliedCount = 0;
        $message = '';
        foreach ($migrationFiles as $file) {
            $migrationName = basename($file);

            if (in_array($migrationName, $appliedMigrations)) {
                $message .= 'Миграция ' . $migrationName . ' уже применена.' . PHP_EOL;
                continue;
            }

            $sql = file_get_contents($file);

            try {
                $this->db->write($sql);

                $this->recordMigration($migrationName, $batch);
                $message .= 'Миграция ' . $migrationName . ' применена успешно.' . PHP_EOL;
                $appliedCount++;
            } catch (\Exception $e) {
                return 'Ошибка при применении ' . $migrationName . ': ' . $e->getMessage();
            }
        }

        if ($appliedCount === 0) {
            return 'Нет новых миграций для применения.';
        }

        return $message ?: 'Прошло успешно';
    }

    protected function createMigrationsTable(): void
    {
        $sql = 'CREATE TABLE IF NOT EXISTS migration (
            migration String,
            batch UInt32,
            applied_at DateTime
        ) ENGINE = MergeTree()
        ORDER BY applied_at';

        $this->db->write($sql);
    }

    protected function getAppliedMigrations(): array
    {
        $result = $this->db->select('SELECT migration FROM migration');
        return array_column($result->rows(), 'migration');
    }

    protected function getNextBatchNumber(): int
    {
        $result = $this->db->select('SELECT max(batch) as max_batch FROM migration');
        $maxBatch = $result->rows()[0]['max_batch'] ?? 0;
        return (int)$maxBatch + 1;
    }

    protected function recordMigration(string $migrationName, int $batch): void
    {
        $appliedAt = date('Y-m-d H:i:s');
        $data = [
            [
                'migration' => $migrationName,
                'batch' => $batch,
                'applied_at' => $appliedAt,
            ]
        ];
        $this->db->insert('migration', $data);
    }
}
