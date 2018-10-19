<?php

namespace Arquivei\Events\Sender;

use Ulid\Ulid;
use Carbon\Carbon;

class Message
{
    const SCHEMA_VERSION = 2;

    protected $id;
    protected $data;
    protected $source;
    protected $dataType;
    protected $createdAt;
    protected $isTracking;
    protected $dataVersion;

    public function __construct(
        string $source,
        string $dataType,
        int $dataVersion,
        array $data,
        bool $isTracking
    ) {
        $this->data = $data;
        $this->source = $source;
        $this->dataType = $dataType;
        $this->id = (string)Ulid::generate();
        $this->isTracking = $isTracking;
        $this->dataVersion = $dataVersion;
        $this->createdAt = Carbon::now()->toRfc3339String();
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

    public function getDataType(): string
    {
        return $this->dataType;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function isTracking(): bool
    {
        return $this->isTracking;
    }

    public function getDataVersion(): int
    {
        return $this->dataVersion;
    }

    public function toArray(): array
    {
        return [
            "SchemaVersion" => self::SCHEMA_VERSION,
            "Source" => $this->source,
            "ID" => $this->id,
            "CreatedAt" => $this->createdAt,
            "Type" => $this->dataType,
            "IsTracking" => $this->isTracking,
            "DataVersion" => $this->dataVersion,
            "Data" => $this->data,
        ];
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}