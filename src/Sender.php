<?php

namespace Arquivei\Events\Sender;

use Arquivei\Events\Sender\Exceptions\SendEventException;
use Arquivei\Events\Sender\Exceptions\EmptyExportersException;
use Arquivei\Events\Sender\Exporters\ExporterInterface;
use Arquivei\Events\Sender\Schemas\BaseSchema;

class Sender
{
    private $exporters;

    public function __construct(ExporterInterface ... $exporters)
    {
        $this->exporters = $exporters;
    }

    public function push(BaseSchema $schema, string $stream, string $key = null): void
    {
        if (empty($this->exporters)) {
            throw new EmptyExportersException();
        }

        foreach ($this->exporters as $exporter) {
            try {
                $exporter->push($schema, $stream, $key);
                return;
            } catch (\Exception $exception) {
                continue;
            }
        }

        throw new SendEventException();
    }
}
