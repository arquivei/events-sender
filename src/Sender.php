<?php

namespace Arquivei\Events\Sender;

use Arquivei\Events\Sender\Interfaces\ExporterInterface;
use Arquivei\Events\Sender\Exceptions\SendEventException;
use Arquivei\Events\Sender\Exceptions\EmptyExportersException;

class Sender
{
    private $exporters;

    public function __construct(ExporterInterface ... $exporters)
    {
        $this->exporters = $exporters;
    }

    public function push(Message $message, string $stream, string $key = null): void
    {
        if (empty($this->exporters)) {
            throw new EmptyExportersException();
        }
        foreach ($this->exporters as $exporter) {
            try {
                $exporter->push($message, $stream, $key);
                return;
            } catch (\Exception $exception) {
                continue;
            }
        }

        throw new SendEventException();
    }
}
