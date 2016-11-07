<?php

namespace Corgi\File\Interfaces;

use Corgi\File\ContentManagers\DirectoryContents;
use Corgi\File\ContentManagers\FileContents;

/**
 * Interface IFileSystemNode
 * @package Corgi\File\Interfaces
 * @author Gabor Zelei
 */
interface IFileSystemNode
{
    /**
     * Copies a file/directory to a new parent directory
     * @param string $newPath
     * @param bool|false $overwrite
     * @return IFileSystemNode
     */
    function copy($newPath, $overwrite = false);

    /**
     * Permanently deletes a file/directory on the FS
     * @return bool
     */
    function delete();

    /**
     * Returns file/directory contents manager object
     * @return FileContents|DirectoryContents
     */
    function contents();

    /**
     * Returns a string constant denoting whether this FS node is a file or directory
     * @return string
     */
    function getNodeType();

    /**
     * Returns the path to this FS node
     * @return string
     */
    function getPath();

    /**
     * Renames a file/directory and returns a new file/directory
     * Also moves the file/directory if necessary
     * @param string $newPath
     * @param bool $overwrite
     * @return IFileSystemNode
     */
    function rename($newPath, $overwrite = false);
}
