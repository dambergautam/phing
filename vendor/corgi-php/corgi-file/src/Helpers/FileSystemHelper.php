<?php

namespace Corgi\File\Helpers;

/**
 * Class FileSystemHelper
 * @package Corgi\File\Helpers
 * @author Gabor Zelei
 */
class FileSystemHelper
{
    /**
     * Returns true if $filePath exists, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function doesExist($filePath = '.')
    {
        return file_exists($filePath);
    }

    /**
     * Returns true if $filePath is a directory, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function isDirectory($filePath = '.')
    {
        return is_dir($filePath);
    }

    /**
     * Returns true if $filePath is file, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function isFile($filePath = '.')
    {
        return is_file($filePath);
    }

    /**
     * Returns true if $filePath is a link, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function isLink($filePath = '.')
    {
        return is_link($filePath);
    }

    /**
     * Returns true if $filePath is readable, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function isReadable($filePath = '.')
    {
        return is_readable($filePath);
    }

    /**
     * Returns true if $filePath is a readable directory, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function isReadableDirectory($filePath = '.')
    {
        return static::isReadable($filePath) && static::isDirectory($filePath);
    }

    /**
     * Returns true if $filePath is a readable file, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function isReadableFile($filePath = '.')
    {
        return static::isReadable($filePath) && static::isFile($filePath);
    }

    /**
     * Returns true if $filePath is writable, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function isWritable($filePath = '.')
    {
        return is_writable($filePath) || is_writable(dirname($filePath));
    }

    /**
     * Returns true if $filePath is a writable directory, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function isWritableDirectory($filePath = '.')
    {
        return static::isWritable($filePath) && static::isDirectory($filePath);
    }

    /**
     * Returns true if $filePath is a writable file, false otherwise
     *
     * @param string $filePath
     * @return bool
     */
    public static function isWritableFile($filePath = '.')
    {
        return static::isWritable($filePath) && static::isFile($filePath);
    }

    /**
     * Attempts to convert any file path to the fullest possible
     * path. (~Converts relative paths to absolute paths.)
     * @param string $filePath
     * @return string
     */
    public static function toFullPath($filePath)
    {
        $baseDir = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, dirname($filePath));
        return $baseDir . DIRECTORY_SEPARATOR . basename($filePath);
    }
}
