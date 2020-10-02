<?php

namespace Arquivei\Events\Sender\Exceptions;

use Throwable;

class PusherException extends \Exception
{

    /**
     * PusherException constructor.
     */
    public function __construct(Throwable $previous)
    {
        parent::__construct('Failed to push event', 0, $previous);
    }
}