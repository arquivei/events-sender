<?php

namespace Arquivei\Events\Sender\Exceptions;

use Throwable;

class EmptyExportersException extends \Exception
{
    public function __construct(
        string $message = 'Do not has exporters configured',
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}