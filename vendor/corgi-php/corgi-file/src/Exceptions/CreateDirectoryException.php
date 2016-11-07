<?php

namespace Corgi\File\Exceptions;

class CreateDirectoryException extends \Exception
{
    public function __construct($path = '', $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Cannot create directory "%s"', $path);
        parent::__construct($message, $code, $previous);
    }
}
