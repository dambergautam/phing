<?php

namespace Corgi\File\Exceptions;

class DeleteException extends \Exception
{
    public function __construct($path = '', $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Cannot delete "%s"', $path);
        parent::__construct($message, $code, $previous);
    }
}
