<?php

namespace Corgi\File\ContentManagers;

use Corgi\File\Directory;
use Corgi\File\Exceptions\CreateDirectoryException;
use Corgi\File\Exceptions\NotReadableException;
use Corgi\File\Exceptions\NotWritableException;
use Corgi\File\Exceptions\OverwriteException;
use Corgi\File\File;
use Corgi\File\Helpers\FileSystemHelper;
use Corgi\File\Interfaces\IContentManager;
use Corgi\File\Interfaces\IStringBehaviour;

/**
 * Class DirectoryContents
 * @package Corgi\File\ContentManagers
 * @author Gabor Zelei
 */
class DirectoryContents implements IContentManager, IStringBehaviour
{
    /**
     * @var Directory
     */
    private $directory;

    /**
     * DirectoryContents constructor.
     * @param Directory $directory
     */
    public function __construct(Directory $directory)
    {
        $this->directory = $directory;
    }

    /**
     * Creates a new file in the current directory
     * @param string|IStringBehaviour|File $file
     * @return File
     * @throws CreateDirectoryException
     * @throws OverwriteException
     */
    public function addFile($file)
    {
        $newFile = $file instanceof File
            ? $file
            : new File($this->getDirectory() . DIRECTORY_SEPARATOR . $file);

        if (FileSystemHelper::isReadable($newFile)) {
            throw new OverwriteException($newFile);
        }

        return $newFile->touch();
    }

    /**
     * Creates a new subdirectory in the current directory
     * @param string|IStringBehaviour|Directory $directory
     * @param int $fileMask
     * @return Directory
     * @throws CreateDirectoryException
     * @throws NotWritableException
     * @throws OverwriteException
     */
    public function addSubDirectory($directory, $fileMask = 0755)
    {
        $newDirectory = $directory instanceof Directory
            ? $directory
            : new Directory($this->getDirectory() . DIRECTORY_SEPARATOR . $directory);

        if (FileSystemHelper::isReadable($newDirectory)) {
            throw new OverwriteException($newDirectory);
        }

        return $directory->create(false, $fileMask);
    }

    /**
     * Case-insensitive search in directory contents
     * @param string|IStringBehaviour $needle
     * @param bool|false $isNeedleRegex
     * @param bool|false $firstMatchOnly
     * @return array
     * @throws NotReadableException
     */
    public function find($needle, $isNeedleRegex = false, $firstMatchOnly = false)
    {
        $matches = [];

        try {
            $contents = $this->toArray();
        } catch (NotReadableException $e) {
            throw $e;
        }

        foreach ($contents as $entry) {

            if ($isNeedleRegex && boolval(preg_match($needle, $entry))) {

                if ($firstMatchOnly) {
                    return $entry;
                } else {
                    $matches[] = $entry;
                }

            } elseif (!$isNeedleRegex && (stripos($entry, $needle) !== false)) {

                if ($firstMatchOnly) {
                    return $entry;
                } else {
                    $matches[] = $entry;
                }

            }

        }

        return $matches;
    }

    /**
     * Returns directory object this contents object is attached to
     * @return Directory
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * Returns directory contents as an array of FileSystemNode objects
     * @return array
     * @throws NotReadableException
     */
    public function toArray()
    {
        if (!FileSystemHelper::isReadableDirectory($this->directory)) {
            throw new NotReadableException($this->directory);
        }

        $contents = new \stdClass();
        $contents->data = [];

        /**
         * @param \SplFileInfo $currentItem
         */
        $closure = function($currentItem) use ($contents) {
            $contents->data[] = $currentItem->isDir()
                ? new Directory($currentItem->getRealPath())
                : new File($currentItem->getRealPath());
        };

        $this->getDirectory()->iterate($closure, \RecursiveIteratorIterator::CHILD_FIRST);
        return $contents->data;
    }

    /**
     * Returns directory contents as string
     * @param string $separator
     * @return string
     * @throws NotReadableException
     */
    public function toString($separator = ', ')
    {
        try {
            return implode($separator, $this->toArray());
        } catch (NotReadableException $e) {
            throw $e;
        }
    }

    /**
     * Returns directory contents as string
     * @return string
     * @throws NotReadableException
     */
    public function __toString()
    {
        try {
            return $this->toString();
        } catch (NotReadableException $e) {
            throw $e;
        }
    }
}