<?php

namespace Corgi\File\Exceptions;

class FileWriteFailedException extends \Exception
{
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        $message = sprintf('File write operation failed on "%s"', $message);
        parent::__construct($message, $code, $previous);
    }
}
