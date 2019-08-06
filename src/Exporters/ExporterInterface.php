<?php

namespace Arquivei\Events\Sender\Exporters;

use Arquivei\Events\Sender\Schemas\BaseSchema;

interface ExporterInterface
{
    public function push(BaseSchema $message, string $stream, ?string $key): void;
}
