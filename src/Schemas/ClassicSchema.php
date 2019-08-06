<?php

namespace Arquivei\Events\Sender\Schemas;

use Arquivei\Events\Sender\Parsers\ParserInterface;
use Arquivei\Events\Sender\Parsers\Schemas\ClassicParser;

class ClassicSchema extends BaseSchema
{
    protected $isTracking;

    public function __construct(
        string $source,
        string $id,
        string $createdAt,
        string $type,
        bool $isTracking,
        int $dataVersion,
        array $data,
        int $schemaVersion = 2
    ) {
        $this->isTracking = $isTracking;
        parent::__construct($schemaVersion, $source, $id, $createdAt, $type, $dataVersion, $data);
    }

    public function isTracking(): bool
    {
        return $this->isTracking;
    }

    public function getParser(): ParserInterface
    {
        return (new ClassicParser($this))->parse();
    }
}
