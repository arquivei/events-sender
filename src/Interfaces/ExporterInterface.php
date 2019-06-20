<?php

namespace Arquivei\Events\Sender\Interfaces;

use Arquivei\Events\Sender\Message;

interface ExporterInterface
{
    public function push(Message $message, string $stream, ?string $key): void;
}
