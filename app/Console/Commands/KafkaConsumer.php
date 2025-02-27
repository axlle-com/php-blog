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

    public function handle(): void
    {
        $factory = new RdKafkaConnectionFactory([
            'global' => [
                'metadata.broker.list' => config('kafka.dsn'),
            ],
        ]);

        /** @var Context $context */
        $context = $factory->createContext();

        try {
            $topic = $context->createTopic(config('kafka.topic'));
        } catch (\Exception $e) {
            $this->error('Ошибка создания топика: ' . $e->getMessage());
            return;
        }

        // Используем createTopic вместо createQueue
        $consumer = $context->createConsumer($topic);
        $this->info(config('kafka.topic'));
        $this->info("Ожидание сообщений...");

        while (true) {
            try {
                $message = $consumer->receive(5000); // Таймаут 5 секунд

                if ($message instanceof Message) {
                    $this->processMessage($message);
                    $consumer->acknowledge($message);
                }

                // Пауза для снижения нагрузки на CPU
                usleep(100000); // 100ms

            } catch (\Exception $e) {
                $this->error('Прервано: ' . $e->getMessage());
                break;
            } catch (\Throwable $e) {
                $this->error('Ошибка: ' . $e->getMessage());
                sleep(1); // Пауза перед повторной попыткой
            }
        }
    }

    protected function processMessage(Message $message): void
    {
        try {
            $this->info("Получено: " . $message->getBody());
            // Здесь должна быть ваша бизнес-логика

        } catch (\Throwable $e) {
            $this->error("Ошибка обработки: " . $e->getMessage());
        }
    }
}
