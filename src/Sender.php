<?php

namespace Arquivei\Events\Sender;

use Arquivei\Events\Sender\Exporters\File;
use Arquivei\Events\Sender\Exporters\Kafka;
use Arquivei\Events\Sender\Exporters\Kinesis;
use Arquivei\Events\Sender\Interfaces\ExporterInterface;
use Arquivei\Events\Sender\Exceptions\EmptyExportersException;

class Sender
{
    private $exporters = [
        'file' => File::class,
        'kafka' => Kafka::class,
        'kinesis' => Kinesis::class,
    ];

    public function __construct(array $configs)
    {
        $exporters = [];
        foreach ($configs as $key => $config) {
            if ($this->validateExporter($key)) {
                $exporters[] = $this->buildExporter($key, $config['config']);
            }
        }
        $this->exporters = $exporters;
    }

    public function push(Message $message, string $stream): void
    {
        if (empty($this->exporters)) {
            throw new EmptyExportersException();
        }
        foreach ($this->exporters as $exporter) {
            try {
                $exporter->push($message, $stream);
                return;
            } catch (\Exception $exception) {
                continue;
            }
        }
    }

    private function buildExporter(string $exporterName, array $config): ExporterInterface
    {
        return new $this->exporters[$exporterName]($config);
    }

    private function validateExporter(string $name): bool
    {
        return array_key_exists($name, $this->exporters);
    }
}