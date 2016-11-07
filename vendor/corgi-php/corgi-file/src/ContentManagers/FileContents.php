<?php

namespace Corgi\File\ContentManagers;

use Corgi\File\Constants\WriteMode;
use Corgi\File\Exceptions\FileWriteFailedException;
use Corgi\File\Exceptions\NotReadableException;
use Corgi\File\Exceptions\NotWritableException;
use Corgi\File\File;
use Corgi\File\Helpers\FileSystemHelper;
use Corgi\File\Interfaces\IContentManager;
use Corgi\File\Interfaces\IStringBehaviour;

/**
 * Class FileContents
 * @package Corgi\File\ContentManagers
 * @author Gabor Zelei
 */
class FileContents implements IContentManager, IStringBehaviour
{
    /**
     * @var File
     */
    private $file;

    /**
     * FileContents constructor.
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Dumps a file's contents directly to screen/cli, without
     * reading it to memory.
     * @throws NotReadableException
     */
    public function dump()
    {
        if (!FileSystemHelper::isReadableFile($this->getFile())) {
            throw new NotReadableException($this->getFile());
        }

        readfile($this->getFile());
    }

    /**
     * Returns file object this contents object is attached to
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Attempts to load a file as a piece of PHP code.
     * The file must be a text file and it must contain a "return"
     * statement in the global namespace. Otherwise, returns bool.
     * This method bypasses caching.
     * @return mixed|bool
     * @throws NotReadableException
     */
    public function load()
    {
        if (!FileSystemHelper::isReadableFile($this->getFile())) {
            throw new NotReadableException($this->getFile());
        }

        return @include($this->getFile());
    }

    /**
     * Returns file contents as string
     * @return string
     * @throws NotReadableException
     */
    public function toString()
    {
        if (!FileSystemHelper::isReadableFile($this->getFile())) {
            throw new NotReadableException($this->getFile());
        }

        return file_get_contents($this->getFile());
    }

    /**
     * Updates a file's contents
     * @param string $newStuff
     * @param int $writeMode
     * @return $this
     * @throws FileWriteFailedException
     * @throws NotReadableException
     * @throws NotWritableException
     */
    public function write($newStuff = '', $writeMode = WriteMode::OVERWRITE)
    {
        try {
            $this->getFile()->touch();
        } catch (NotWritableException $e) {
            throw $e;
        }

        $result = file_put_contents($this->getFile(), $newStuff, $writeMode);

        if ($result == false) {
            throw new FileWriteFailedException($this->getFile());
        }

        return $this;
    }

    /**
     * Returns file contents as string
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
