<?php

namespace Arquivei\Events\Sender\Factories;

use Arquivei\Events\Sender\Schemas\LatestSchema;
use Ulid\Ulid;

class LatestSchemaFactory
{
    public function createFromParameters(
        string $source,
        string $type,
        int $dataVersion,
        array $data,
        int $schemaVersion = 3
    ) {
        return new LatestSchema(
            $source,
            $id = (string)Ulid::generate(),
            $createdAt = (new \DateTime())->format(\DateTime::RFC3339),
            $type,
            $dataVersion,
            $data,
            $schemaVersion
        );
    }
}
