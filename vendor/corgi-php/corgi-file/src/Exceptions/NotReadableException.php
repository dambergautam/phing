<?php

namespace Corgi\File\Exceptions;

class NotReadableException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Filesystem node not readable: %s', $message);
        parent::__construct($message, $code, $previous);
    }
}
