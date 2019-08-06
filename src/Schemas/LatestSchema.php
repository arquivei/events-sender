<?php

namespace Arquivei\Events\Sender\Schemas;

use Arquivei\Events\Sender\Parsers\ParserInterface;
use Arquivei\Events\Sender\Parsers\Schemas\LatestParser;

class LatestSchema extends BaseSchema
{
    public function __construct(
        string $source,
        string $id,
        string $createdAt,
        string $type,
        int $dataVersion,
        array $data,
        int $schemaVersion = 3
    ) {
        parent::__construct($schemaVersion, $source, $id, $createdAt, $type, $dataVersion, $data);
    }

    public function getParser(): ParserInterface
    {
        return (new LatestParser($this))->parse();
    }
}
