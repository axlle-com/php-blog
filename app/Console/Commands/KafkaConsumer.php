<?php

namespace App\Console\Commands;

use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Illuminate\Console\Command;
use Interop\Queue\Context;
use Interop\Queue\Message;

class KafkaConsumer extends Command
{
    protected $signature = 'kafka:consume';
    protected $description = 'Consume messages from Kafka';

    public function handle(RdKafkaConnectionFactory $factory): void
    {
        /** @var Context $context */
        $context = $factory->createContext();

        try {
            $topic = $context->createTopic(config('kafka.topic'));
            // Проверка доступности
            $testConsumer = $context->createConsumer($topic);
            $testConsumer->receive(100);
        } catch (\Exception $e) {
            $this->error('Ошибка создания топика: ' . $e->getMessage());
            return;
        }

        $consumer = $context->createConsumer($topic);
        $this->info('Ожидание сообщений...');

        $retryCount = 0;
        $maxRetries = 3;

        while ($retryCount < $maxRetries) {
            try {
                $message = $consumer->receive(5_000); // Таймаут 5 секунд

                if ($message instanceof Message) {
                    $this->processMessage($message);
                    $consumer->acknowledge($message);
                }

                // Пауза для снижения нагрузки на CPU
                usleep(100_000); // 100ms

            } catch (\Throwable $e) {
                $this->error('Ошибка: ' . $e->getMessage());
                sleep(2); // Пауза перед повторной попыткой
                $retryCount++;
            }
        }

        $this->info('Воркер закончил работу');
    }

    protected function processMessage(Message $message): void
    {
        try {
            $this->info('Получено: ' . $message->getBody());
            // Здесь должна быть ваша бизнес-логика

        } catch (\Throwable $e) {
            $this->error('Ошибка обработки: ' . $e->getMessage());
        }
    }
}
