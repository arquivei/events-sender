<?php

namespace Arquivei\Events\Sender\Exceptions;

use Throwable;

class FailedSenderToPubSubException extends \Exception
{
    public function __construct(Throwable $previous)
    {
        parent::__construct('Failed to push message to PubSub', 0, $previous);
    }
}