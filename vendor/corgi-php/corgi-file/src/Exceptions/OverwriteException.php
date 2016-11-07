<?php

namespace Corgi\File\Exceptions;

class OverwriteException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Filesystem node exists: %s', $message);
        parent::__construct($message, $code, $previous);
    }
}
