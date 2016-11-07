<?php

namespace Corgi\File;

use Corgi\File\Base\FileSystemNode;
use Corgi\File\Constants\NodeType;
use Corgi\File\ContentManagers\DirectoryContents;
use Corgi\File\Exceptions\CopyException;
use Corgi\File\Exceptions\CreateDirectoryException;
use Corgi\File\Exceptions\DeleteException;
use Corgi\File\Exceptions\OverwriteException;
use Corgi\File\Helpers\FileSystemHelper;

/**
 * Class Directory
 * @package Corgi\File
 * @author Gabor Zelei
 */
class Directory extends FileSystemNode
{
    /**
     * @var DirectoryContents
     */
    private $contentManager;

    /**
     * Returns file/directory contents manager object
     * @return DirectoryContents
     */
    function contents()
    {
        if (is_null($this->contentManager)) {
            $this->contentManager = new DirectoryContents($this);
        }

        return $this->contentManager;
    }

    /**
     * Copies a directory to a new location
     * @param string $newPath
     * @param bool|false $overwrite
     * @param int $parentDirectoryFileMask
     * @return Directory
     * @throws CopyException
     * @throws CreateDirectoryException
     * @throws OverwriteException
     */
    public function copy($newPath, $overwrite = false, $parentDirectoryFileMask = 0755)
    {
        mkdir($newPath, $parentDirectoryFileMask, true);
        $directory = $this;

        /**
         * @param \SplFileInfo $currentItem
         * @param \RecursiveDirectoryIterator $iterator,
         * @throws CopyException
         * @throws CreateDirectoryException
         * @throws OverwriteException
         */
        $closure = function($currentItem, $iterator) use ($directory, $overwrite) {
            $targetPath = $directory . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

            if ($currentItem->isDir()) {

                if ((!FileSystemHelper::isDirectory($targetPath) || $overwrite) && !mkdir($targetPath)) {
                    throw new CreateDirectoryException($targetPath);
                }

            } else {
                $file = new File($currentItem->getRealPath());
                $file->copy($targetPath, $overwrite);
            }
        };

        try {
            $this->iterate($closure);
            $this->filePath = $newPath;
            return $this;
        } catch (CopyException $e) {
            throw $e;
        } catch (CreateDirectoryException $e) {
            throw $e;
        } catch (OverwriteException $e) {
            throw $e;
        }
    }

    /**
     * Creates or re-creates this directory
     * @param bool|false $overwrite
     * @param int $fileMask
     * @return Directory
     * @throws CreateDirectoryException
     */
    public function create($overwrite = false, $fileMask = 0755)
    {
        if (FileSystemHelper::isDirectory($this) && $overwrite) {
            $this->delete(true);
        }

        if (!mkdir($this, $fileMask, true)) {
            throw new CreateDirectoryException($this);
        }

        return $this;
    }

    /**
     * Permanently deletes a directory (recursive)
     * @param bool|false $failSilently
     * @return bool
     * @throws DeleteException
     */
    function delete($failSilently = false)
    {
        /**
         * @param \SplFileInfo $currentItem
         * @throws DeleteException
         */
        $closure = function($currentItem) use ($failSilently) {

            if ($currentItem->isDir()) {
                $success = rmdir($currentItem->getRealPath());

                if (!$success && !$failSilently) {
                    throw new DeleteException($currentItem->getRealPath());
                }

            } else {

                try {
                    $file = new File($currentItem->getRealPath());
                    $file->delete();
                } catch (DeleteException $e) {

                    if (!$failSilently) {
                        throw $e;
                    }

                }

            }

        };

        try {
            $this->iterate($closure, \RecursiveIteratorIterator::CHILD_FIRST);
            $success = rmdir($this);

            if (!$success && !$failSilently) {
                throw new DeleteException($this);
            }

            return $success;
        } catch (DeleteException $e) {
            throw $e;
        }

    }

    /**
     * Returns "directory" for node type
     * @return string
     */
    public function getNodeType()
    {
        return NodeType::DIRECTORY;
    }

    /**
     * Iterates through all items in a directory and calls
     * $callback on them.
     * @param \Closure $callback    params: (\RecursiveIteratorIterator $iterator, \SplFileInfo $currentItem)
     * @param int $iteratorMode
     */
    public function iterate(\Closure $callback, $iteratorMode = \RecursiveIteratorIterator::SELF_FIRST)
    {
        $directoryIterator = new \RecursiveDirectoryIterator($this, \RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($directoryIterator, $iteratorMode);

        foreach ($iterator as $currentItem) {
            $callback($currentItem, $iterator);
        }
    }

    /**
     * Deletes an empty directory
     * @return bool
     * @throws DeleteException
     */
    public function safeDelete()
    {
        if (!FileSystemHelper::isDirectory($this) || !rmdir($this)) {
            throw new DeleteException($this);
        }

        return true;
    }
}
