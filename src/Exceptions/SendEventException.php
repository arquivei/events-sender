<?php

namespace Arquivei\Events\Sender\Exceptions;

class SendEventException extends \Exception
{
    public function __construct() {
        parent::__construct('Error to send events, no more exporters');
    }
}
