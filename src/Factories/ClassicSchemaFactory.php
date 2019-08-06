<?php

namespace Arquivei\Events\Sender\Factories;

use Arquivei\Events\Sender\Schemas\ClassicSchema;
use Ulid\Ulid;

class ClassicSchemaFactory
{
    public function createFromParameters(
        string $source,
        string $type,
        bool $isTracking,
        int $dataVersion,
        array $data,
        int $schemaVersion = 2
    ) {
        return new ClassicSchema(
            $source,
            $id = (string)Ulid::generate(),
            $createdAt = (new \DateTime())->format(\DateTime::RFC3339),
            $type,
            $isTracking,
            $dataVersion,
            $data,
            $schemaVersion
        );
    }
}
