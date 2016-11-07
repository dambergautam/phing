<?php

namespace Corgi\File\Exceptions;

class NotWritableException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Filesystem node not writable: %s', $message);
        parent::__construct($message, $code, $previous);
    }
}
