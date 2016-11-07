<?php

namespace Corgi\File\Exceptions;

class MoveException extends \Exception
{
    public function __construct($oldPath = '', $newPath = '', $code = 0, \Exception $previous = null)
    {
        $message = sprintf('Cannot move from "%s" to new path: "%s"', $oldPath, $newPath);
        parent::__construct($message, $code, $previous);
    }
}
