<?php

namespace Arquivei\Events\Sender\Exceptions;

use Throwable;

class FailedSenderToKinesisException extends \Exception
{
    public function __construct(
        string $message = 'Failed to push message to Kinesis',
        Throwable $previous = null,
        int $code = 0
    ) {
        parent::__construct($message, $code, $previous);
    }
}