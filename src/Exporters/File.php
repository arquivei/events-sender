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

    public function __construct(array $config)
    {
        $handler = new StreamHandler($config['file_path']);
        $handler->setFormatter(new JsonFormatter());
        $this->log = new Logger('events_sender_file');
        $this->log->pushHandler($handler);
        $this->log->pushProcessor(function ($record) {
            $record['datetime'] = $record['datetime']->format('c');
            return $record;
        });
    }

    public function push(Message $message, string $stream): void
    {
        try {
            $this->log->addInfo('events_sender_file', [
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