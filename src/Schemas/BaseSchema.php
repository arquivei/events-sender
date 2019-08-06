<?php

namespace Arquivei\Events\Sender\Schemas;

use Arquivei\Events\Sender\Parsers\ParserInterface;

abstract class BaseSchema
{
    protected $id;
    protected $data;
    protected $source;
    protected $type;
    protected $createdAt;
    protected $dataVersion;
    protected $schemaVersion;

    public function __construct(
        int $schemaVersion,
        string $source,
        string $id,
        string $createdAt,
        string $type,
        int $dataVersion,
        array $data
    ) {
        $this->schemaVersion = $schemaVersion;
        $this->source = $source;
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->type = $type;
        $this->dataVersion = $dataVersion;
        $this->data = $data;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getDataVersion(): int
    {
        return $this->dataVersion;
    }

    public function getSchemaVersion(): int
    {
        return $this->schemaVersion;
    }

    abstract public function getParser(): ParserInterface;
}
