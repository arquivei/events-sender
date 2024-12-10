<?php

namespace Arquivei\Events\Sender\Exporters;

use Arquivei\Events\Sender\Schemas\BaseSchema;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
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

    public function push(BaseSchema $schema, string $stream, ?string $key): void
    {
        try {
            $this->log->info('Arquivei events sender', [
                'Key' => $key,
                'EventPipelineStream' => $stream,
                'EventPipelineMessage' => $schema->getParser()->toArray(),
                'EventPipelineType' => $schema->getType(),
            ]);
        } catch (\Exception $exception) {
            throw new FailedSenderToLogException(
                'Failed to push message to Log: ' . $exception->getMessage(),
                $exception
            );
        }
    }
}
