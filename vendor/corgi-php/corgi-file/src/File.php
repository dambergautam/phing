<?php

namespace Corgi\File;

use Corgi\File\Base\FileSystemNode;
use Corgi\File\Constants\NodeType;
use Corgi\File\ContentManagers\FileContents;
use Corgi\File\Exceptions\CopyException;
use Corgi\File\Exceptions\CreateDirectoryException;
use Corgi\File\Exceptions\DeleteException;
use Corgi\File\Exceptions\NotWritableException;
use Corgi\File\Exceptions\OverwriteException;
use Corgi\File\Helpers\FileSystemHelper;

/**
 * Class File
 * @package Corgi\File
 * @author Gabor Zelei
 */
class File extends FileSystemNode
{
    /**
     * @var FileContents
     */
    private $contentManager;

    /**
     * Returns content manager object instance for the file
     * @return FileContents
     */
    public function contents()
    {
        if (is_null($this->contentManager)) {
            $this->contentManager = new FileContents($this);
        }

        return $this->contentManager;
    }

    /**
     * Copies a file/directory to a new parent directory
     * @param string $newPath
     * @param bool $overwrite
     * @return File
     * @throws CopyException
     * @throws OverwriteException
     */
    public function copy($newPath, $overwrite = false)
    {
        if (!$overwrite && FileSystemHelper::doesExist($newPath)) {
            throw new OverwriteException($newPath);
        }

        $success = copy($this, $newPath);

        if ($success) {
            return $this;
        } else {
            throw new CopyException($this, $newPath);
        }
    }

    /**
     * Permanently deletes a file
     * @param bool|false $failSilently
     * @return bool
     * @throws DeleteException
     */
    public function delete($failSilently = false)
    {
        $success = unlink($this);

        if (!$success && !$failSilently) {
            throw new DeleteException($this);
        }

        return $success;
    }

    /**
     * Returns "file" for node type
     * @return string
     */
    public function getNodeType()
    {
        return NodeType::FILE;
    }

    /**
     * Updates access date and time on a file
     * If the file does not exist, it gets created
     * @return File
     * @throws CreateDirectoryException
     * @throws NotWritableException
     */
    public function touch()
    {
        $baseDir = new Directory(dirname($this));

        if (!FileSystemHelper::isDirectory($baseDir)) {
            try {
                $baseDir->create(false);
            } catch (CreateDirectoryException $e) {
                throw $e;
            }
        }

        if (!FileSystemHelper::isWritable($baseDir)) {
            throw new NotWritableException($this);
        }

        touch($this);
        return $this;
    }
}
