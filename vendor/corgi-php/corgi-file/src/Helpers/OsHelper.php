<?php

namespace Corgi\File\Helpers;

/**
 * Class OsHelper
 * @package Corgi\File\Helpers
 * @author Gabor Zelei
 */
class OsHelper
{
    /**
     * Returns true if running on a Windows Host
     *
     * @return bool
     */
    public static function isWindows()
    {
        return strtolower(substr(PHP_OS, 0, 3)) === 'win';
    }
}
