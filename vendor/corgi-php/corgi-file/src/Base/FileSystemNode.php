<?php

namespace Corgi\File\Base;

use Corgi\File\Exceptions\MoveException;
use Corgi\File\Exceptions\OverwriteException;
use Corgi\File\Helpers\FileSystemHelper;
use Corgi\File\Interfaces\IFileSystemNode;
use Corgi\File\Interfaces\IStringBehaviour;

/**
 * Class Node
 * @package Corgi\File
 * @author Gabor Zelei
 */
abstract class FileSystemNode implements IFileSystemNode, IStringBehaviour
{
    /**
     * @var string
     */
    protected $filePath;

    /**
     * Node constructor.
     * @param $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = FileSystemHelper::toFullPath($filePath);
    }

    /**
     * Returns the path to this FS node
     * @return string
     */
    public function getPath()
    {
        return $this->filePath;
    }

    /**
     * Renames a file/directory and returns a new file/directory
     * Also moves the file/directory if necessary
     * @param string $newPath
     * @param bool|false $overwrite
     * @return bool
     * @throws MoveException
     * @throws OverwriteException
     */
    public function rename($newPath, $overwrite = false)
    {
        if (!$overwrite && FileSystemHelper::doesExist($newPath)) {
            throw new OverwriteException($newPath);
        }

        $success = rename($this->getPath(), $newPath);

        if ($success) {
            $this->filePath = FileSystemHelper::toFullPath($newPath);
        } else {
            throw new MoveException($this->getPath(), $newPath);
        }

        return $success;
    }

    /**
     * Return full path when treated as string
     * @return string
     */
    public function __toString()
    {
        return $this->getPath();
    }
}
