<?php

namespace Arquivei\Events\Sender\Exceptions;

use Throwable;

class SenderToLogException extends \Exception
{
    public function __construct(
        string $message = 'Failed to push message to Log',
        Throwable $previous = null,
        int $code = 0
    ) {
        parent::__construct($message, $code, $previous);
    }
}