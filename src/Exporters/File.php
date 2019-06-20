<?php

namespace Arquivei\Events\Sender\Exporters;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Arquivei\Events\Sender\Message;
use Monolog\Formatter\JsonFormatter;
use Arquivei\Events\Sender\Interfaces\ExporterInterface;
use Arquivei\Events\Sender\Exceptions\FailedSenderToLogException;

class File implements ExporterInterface
{
    private $log;

    public function __construct(string $filePath)
    {
        $handler = new StreamHandler($filePath);
        $handler->setFormatter(new JsonFormatter());
        $this->log = new Logger('arquivei_events_sender');
        $this->log->pushHandler($handler);
        $this->log->pushProcessor(function ($record) {
            $record['datetime'] = $record['datetime']->format('c');
            return $record;
        });
    }

    public function push(Message $message, string $stream, ?string $key): void
    {
        try {
            $this->log->addInfo('Arquivei events sender', [
                'Key' => $key,
                'EventPipelineStream' => $stream,
                'EventPipelineMessage' => $message->toArray(),
                'EventPipelineType' => $message->getDataType(),
            ]);
        } catch (\Exception $exception) {
            throw new FailedSenderToLogException(
                'Failed to push message to Log: ' . $exception->getMessage(),
                $exception
            );
        }
    }
}
