<?php

namespace Arquivei\Events\Sender\Parsers\Schemas;

use Arquivei\Events\Sender\Parsers\ParserInterface;
use Arquivei\Events\Sender\Schemas\ClassicSchema;

class ClassicParser implements ParserInterface
{
    private $schema;
    private $parse = array();

    public function __construct(ClassicSchema $schema)
    {
        $this->schema = $schema;
    }

    public function parse(): ClassicParser
    {
        $this->parse = [
            "SchemaVersion" => $this->schema->getSchemaVersion(),
            "Source" => $this->schema->getSource(),
            "ID" => $this->schema->getId(),
            "CreatedAt" => $this->schema->getCreatedAt(),
            "Type" => $this->schema->getType(),
            "IsTracking" => $this->schema->isTracking(),
            "DataVersion" => $this->schema->getDataVersion(),
            "Data" => $this->schema->getData(),
        ];

        return $this;
    }

    public function toArray(): array
    {
        return $this->parse;
    }

    public function toJson(): string
    {
        return json_encode($this->parse);
    }
}
