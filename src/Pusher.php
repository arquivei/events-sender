<?php

namespace Arquivei\Events\Sender;

use Arquivei\Events\Sender\Exceptions\EmptyExportersException;
use Arquivei\Events\Sender\Exceptions\PusherException;
use Arquivei\Events\Sender\Exporters\ExporterInterface;
use Arquivei\Events\Sender\Schemas\BaseSchema;
use Throwable;

class Pusher
{
    private $exporter;

    /**
     * Pusher constructor.
     * @param ExporterInterface $exporter
     */
    public function __construct(ExporterInterface $exporter)
    {
        $this->exporter = $exporter;
    }

    /**
     * @param BaseSchema $schema
     * @param string $stream
     * @param string|null $key
     * @throws EmptyExportersException
     * @throws PusherException
     */
    public function push(BaseSchema $schema, string $stream, string $key = null): void
    {
        if (empty($this->exporter)) {
            throw new EmptyExportersException();
        }

        try {
            $this->exporter->push($schema, $stream, $key);
        } catch (Throwable $exception) {
            throw new PusherException($exception);
        }
    }
}
