<?php

namespace Arquivei\Events\Sender\Parsers\Schemas;

use Arquivei\Events\Sender\Parsers\ParserInterface;
use Arquivei\Events\Sender\Schemas\LatestSchema;

class LatestParser implements ParserInterface
{
    private $schema;
    private $parse = array();

    public function __construct(LatestSchema $schema)
    {
        $this->schema = $schema;
    }

    public function parse(): LatestParser
    {
        $this->parse = [
            "SchemaVersion" => $this->schema->getSchemaVersion(),
            "Source" => $this->schema->getSource(),
            "Id" => $this->schema->getId(),
            "CreatedAt" => $this->schema->getCreatedAt(),
            "Type" => $this->schema->getType(),
            "DataVersion" => $this->schema->getDataVersion(),
            "Data" => $this->schema->getData(),
        ];

        return $this;
    }

    public function toArray(): array
    {
        return $this->parse;
    }

    public function toJson()
    {
        return json_encode($this->parse);
    }
}
